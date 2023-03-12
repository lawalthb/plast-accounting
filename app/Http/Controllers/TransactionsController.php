<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionsAddRequest;
use App\Http\Requests\TransactionsEditRequest;
use App\Http\Requests\TransactionsadminEditRequest;
use App\Http\Requests\TransactionsaddReceiptRequest;
use App\Http\Requests\Transactionsadd5014Request;
use App\Http\Requests\Transactionsadd5011Request;
use App\Http\Requests\Transactionsadd5005Request;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class TransactionsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.transactions.list";
		$query = Transactions::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Transactions::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "transactions.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->transactions_id){
			$val = $request->transactions_id;
			$query->where(DB::raw("transactions.id"), "=", $val);
		}
		if($request->transactions_document_type_id){
			$val = $request->transactions_document_type_id;
			$query->where(DB::raw("transactions.document_type_id"), "=", $val);
		}
		if($request->transactions_trans_date){
			$vals = explode("-to-",$request->transactions_trans_date);
			$fromDate = $vals[0] ?? null;
			$toDate = $vals[1] ?? null;
			if($fromDate && $toDate){
				$query->whereRaw("transactions.trans_date BETWEEN ? AND ?", [$fromDate, $toDate]);
			}
			elseif($fromDate){
				$query->whereRaw("transactions.trans_date >= ?", [$fromDate]);
			}
			elseif($toDate){
				$query->whereRaw("transactions.trans_date <= ?", [$toDate]);
			}
		}
		$records = $query->paginate($limit, Transactions::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Transactions::query();
		$record = $query->findOrFail($rec_id, Transactions::viewFields());
		return $this->renderView("pages.transactions.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.transactions.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.transactions.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(TransactionsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//Validate Transaction_Products form data
		$transactionProductsPostData = $request->transaction_products;
		$transactionProductsValidator = validator()->make($transactionProductsPostData, ["*.product_id" => "required|numeric",
				"*.quantity" => "required|numeric",
				"*.rate" => "required|numeric",
				"*.amount" => "required|numeric",
				"*.comment" => "nullable|string",
				"*.location_id" => "required|numeric",
				"*.company_id" => "required|numeric"]);
		if ($transactionProductsValidator->fails()) {
			return $transactionProductsValidator->errors();
		}
		$transactionProductsModeldata = $this->normalizeFormData($transactionProductsValidator->valid());
		
		//Validate Transaction_Ledgers form data
		$transactionLedgersPostData = $request->transaction_ledgers;
		$transactionLedgersValidator = validator()->make($transactionLedgersPostData, ["ledger_id" => "required|numeric",
				"debit_id" => "required|numeric",
				"credit_id" => "required|numeric",
				"comment" => "nullable|numeric",
				"company_id" => "required"]);
		if ($transactionLedgersValidator->fails()) {
			return $transactionLedgersValidator->errors();
		}
		$transactionLedgersModeldata = $this->normalizeFormData($transactionLedgersValidator->valid());
		
		//Validate Narrations form data
		$narrationsPostData = $request->narrations;
		$narrationsValidator = validator()->make($narrationsPostData, ["narration" => "nullable"]);
		if ($narrationsValidator->fails()) {
			return $narrationsValidator->errors();
		}
		$narrationsModeldata = $this->normalizeFormData($narrationsValidator->valid());
		$modeldata['created_by'] = auth()->user()->id;
		$modeldata['company_id'] = auth()->user()->company_id;
		
		//save Transactions record
		$record = Transactions::create($modeldata);
		$rec_id = $record->id;
		
        // set transaction_products.transactions_id to transactions.id
		$transactionProductsModeldata['transactions_id'] = $rec_id;
		//save Transaction_Products record
		$transactionProductsRecord = \App\Models\Transaction_Products::create($transactionProductsModeldata);
		
        // set transaction_ledgers.transactions_id to transactions.id
		$transactionLedgersModeldata['transactions_id'] = $rec_id;
		//save Transaction_Ledgers record
		$transactionLedgersRecord = \App\Models\Transaction_Ledgers::create($transactionLedgersModeldata);
		
        // set narrations.trans_id to transactions.id
		$narrationsModeldata['trans_id'] = $rec_id;
		//save Narrations record
		$narrationsRecord = \App\Models\Narrations::create($narrationsModeldata);
		return $this->redirect("transactions/adminlist", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(TransactionsEditRequest $request, $rec_id = null){
		$query = Transactions::query();
		$record = $query->findOrFail($rec_id, Transactions::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("transactions/adminlist", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.transactions.edit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
	 * @param  \Illuminate\Http\Request
	 * @param string $rec_id //can be separated by comma 
     * @return \Illuminate\Http\Response
     */
	function delete(Request $request, $rec_id = null){
		$arr_id = explode(",", $rec_id);
		$query = Transactions::query();
		$query->whereIn("id", $arr_id);
		//to raise audit trail delete event, use Eloquent 'get' before delete
		$query->get()->each(function ($record, $key) {
			$record->delete();
		});
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function superdashboardlist(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.transactions.superdashboardlist";
		$query = Transactions::query();
		$limit = $request->limit ?? 10;
		if($request->search){
			$search = trim($request->search);
			Transactions::search($query, $search); // search table records
		}
		$query->join("ledgers", "transactions.party_ledger_id", "=", "ledgers.id");
		$query->join("ledgers", "transactions.against_ledger_id", "=", "ledgers.id");
		$orderby = $request->orderby ?? "transactions.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Transactions::superdashboardlistFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function adminlist(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.transactions.adminlist";
		$query = Transactions::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Transactions::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "transactions.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("company_id", "=" , auth()->user()->company_id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->transactions_id){
			$val = $request->transactions_id;
			$query->where(DB::raw("transactions.id"), "=", $val);
		}
		if($request->transactions_document_type_id){
			$val = $request->transactions_document_type_id;
			$query->where(DB::raw("transactions.document_type_id"), "=", $val);
		}
		if($request->transactions_trans_date){
			$vals = explode("-to-",$request->transactions_trans_date);
			$fromDate = $vals[0] ?? null;
			$toDate = $vals[1] ?? null;
			if($fromDate && $toDate){
				$query->whereRaw("transactions.trans_date BETWEEN ? AND ?", [$fromDate, $toDate]);
			}
			elseif($fromDate){
				$query->whereRaw("transactions.trans_date >= ?", [$fromDate]);
			}
			elseif($toDate){
				$query->whereRaw("transactions.trans_date <= ?", [$toDate]);
			}
		}
		$records = $query->paginate($limit, Transactions::adminlistFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function adminedit(TransactionsadminEditRequest $request, $rec_id = null){
		$query = Transactions::query();
		$record = $query->findOrFail($rec_id, Transactions::admineditFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("transactions", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.transactions.adminedit", ["data" => $record, "rec_id" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function addreceipt(){
		return $this->renderView("pages.transactions.addreceipt");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function addreceipt_store(TransactionsaddReceiptRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//Validate Transaction_Ledgers form data
		$transactionLedgersPostData = $request->transaction_ledgers;
		$transactionLedgersValidator = validator()->make($transactionLedgersPostData, ["*.ledger_id" => "required",
				"*.credit_id" => "required|string",
				"*.comment" => "nullable|string",
				"*.company_id" => "required"]);
		if ($transactionLedgersValidator->fails()) {
			return $transactionLedgersValidator->errors();
		}
		$transactionLedgersValidData = $transactionLedgersValidator->valid();
		$transactionLedgersModeldata = array_values($transactionLedgersValidData);
		
		//Validate Narrations form data
		$narrationsPostData = $request->narrations;
		$narrationsValidator = validator()->make($narrationsPostData, ["narration" => "nullable"]);
		if ($narrationsValidator->fails()) {
			return $narrationsValidator->errors();
		}
		$narrationsModeldata = $this->normalizeFormData($narrationsValidator->valid());
		$modeldata['created_by'] = auth()->user()->id;
		$modeldata['company_id'] = auth()->user()->company_id;
		$this->beforeAddreceipt($modeldata);
		
		//save Transactions record
		$record = Transactions::create($modeldata);
		$rec_id = $record->id;
		
		// set transaction_ledgers.transactions_id to transactions $rec_id
		foreach ($transactionLedgersModeldata as &$data) {
			$data['transactions_id'] = $rec_id;
		}
		
		//Save Transaction_Ledgers record
		\App\Models\Transaction_Ledgers::insert($transactionLedgersModeldata);
		
        // set narrations.trans_id to transactions.id
		$narrationsModeldata['trans_id'] = $rec_id;
		//save Narrations record
		$narrationsRecord = \App\Models\Narrations::create($narrationsModeldata);
		$this->afterAddreceipt($record);
		return $this->redirect("transactions/adminlist", __('recordAddedSuccessfully'));
	}
    /**
     * Before create new record
     * @param array $modeldata // validated form data used to create new record
     */
    private function beforeAddreceipt($modeldata){
        //enter statement here
        echo "<script>
        alert('i will run before page load finish');
        </script>";
    }
    /**
     * After new record created
     * @param array $record // newly created record
     */
    private function afterAddreceipt($record){
        //enter statement here
        $rec_id            = $record['id'];
        $transactions = DB::table('transactions')->where('id', $rec_id )->first();
        //var_dump($user->name);
        $party_Ledger_id   = $transactions->party_Ledger_id;
        $against_ledger_id = $transactions->against_ledger_id;
        $total_debit       = $transactions->total_debit;
        $company_id        = $transactions->company_id;
        $document_type_code        = $transactions->document_type_code;
        $modeldata         = [
                            'transactions_id' =>  $rec_id, 
                            'ledger_id' => $party_Ledger_id,
                            'debit_id' => $total_debit,
                            'company_id' => $company_id         
                            ];
        DB::table('transaction_ledgers')->insert($modeldata);
           $modeldata         = [
                            'transactions_id' =>  $rec_id , 
                            'ledger_id' => $against_ledger_id,
                            'credit_id' => $total_debit,
                            'company_id' => $company_id       
                            ];
        DB::table('transaction_ledgers')->insert($modeldata);
           DB::table('document_types')->where('id', $rec_id)->update(['no_view' =>
        DB::raw('no_view + 1')
        ]);
    }
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add5014(){
		return $this->renderView("pages.transactions.add5014");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add5014_store(Transactionsadd5014Request $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//Validate Transaction_Ledgers form data
		$transactionLedgersPostData = $request->transaction_ledgers;
		$transactionLedgersValidator = validator()->make($transactionLedgersPostData, ["*.ledger_id" => "required",
				"*.credit_id" => "required|string",
				"*.comment" => "nullable|string",
				"*.company_id" => "required"]);
		if ($transactionLedgersValidator->fails()) {
			return $transactionLedgersValidator->errors();
		}
		$transactionLedgersValidData = $transactionLedgersValidator->valid();
		$transactionLedgersModeldata = array_values($transactionLedgersValidData);
		
		//Validate Narrations form data
		$narrationsPostData = $request->narrations;
		$narrationsValidator = validator()->make($narrationsPostData, ["narration" => "nullable"]);
		if ($narrationsValidator->fails()) {
			return $narrationsValidator->errors();
		}
		$narrationsModeldata = $this->normalizeFormData($narrationsValidator->valid());
		$modeldata['created_by'] = auth()->user()->id;
		$modeldata['company_id'] = auth()->user()->company_id;
		
		//save Transactions record
		$record = Transactions::create($modeldata);
		$rec_id = $record->id;
		
		// set transaction_ledgers.transactions_id to transactions $rec_id
		foreach ($transactionLedgersModeldata as &$data) {
			$data['transactions_id'] = $rec_id;
		}
		
		//Save Transaction_Ledgers record
		\App\Models\Transaction_Ledgers::insert($transactionLedgersModeldata);
		
        // set narrations.trans_id to transactions.id
		$narrationsModeldata['trans_id'] = $rec_id;
		//save Narrations record
		$narrationsRecord = \App\Models\Narrations::create($narrationsModeldata);
		$this->afterAdd5014($record);
		return $this->redirect("transactions/adminlist", __('recordAddedSuccessfully'));
	}
    /**
     * After new record created
     * @param array $record // newly created record
     */
     private function afterAdd5014($record){
        //enter statement here
        $rec_id            = $record['id'];
        $transactions = DB::table('transactions')->where('id', $rec_id )->first();
        //var_dump($user->name);
        $party_Ledger_id   = $transactions->party_Ledger_id;
        $against_ledger_id = $transactions->against_ledger_id;
        $total_debit       = $transactions->total_debit;
        $company_id        = $transactions->company_id;
        $document_type_code        = $transactions->document_type_code;
        $modeldata         = [
                            'transactions_id' =>  $rec_id, 
                            'ledger_id' => $party_Ledger_id,
                            'debit_id' => $total_debit,
                            'company_id' => $company_id         
                            ];
        DB::table('transaction_ledgers')->insert($modeldata);
           $modeldata         = [
                            'transactions_id' =>  $rec_id , 
                            'ledger_id' => $against_ledger_id,
                            'credit_id' => $total_debit,
                            'company_id' => $company_id       
                            ];
        DB::table('transaction_ledgers')->insert($modeldata);
         DB::table('document_types')
           ->where('document_code', $document_type_code)
            ->where('company_id', $company_id)           
           ->update(['no_view' =>
        DB::raw('no_view + 1')
        ]);
    }
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add5011(){
		return $this->renderView("pages.transactions.add5011");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add5011_store(Transactionsadd5011Request $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//Validate Transaction_Ledgers form data
		$transactionLedgersPostData = $request->transaction_ledgers;
		$transactionLedgersValidator = validator()->make($transactionLedgersPostData, ["*.ledger_id" => "required",
				"*.debit_id" => "required|numeric",
				"*.comment" => "nullable|string",
				"*.company_id" => "required"]);
		if ($transactionLedgersValidator->fails()) {
			return $transactionLedgersValidator->errors();
		}
		$transactionLedgersValidData = $transactionLedgersValidator->valid();
		$transactionLedgersModeldata = array_values($transactionLedgersValidData);
		
		//Validate Narrations form data
		$narrationsPostData = $request->narrations;
		$narrationsValidator = validator()->make($narrationsPostData, ["narration" => "nullable"]);
		if ($narrationsValidator->fails()) {
			return $narrationsValidator->errors();
		}
		$narrationsModeldata = $this->normalizeFormData($narrationsValidator->valid());
		$modeldata['created_by'] = auth()->user()->id;
		$modeldata['company_id'] = auth()->user()->company_id;
		
		//save Transactions record
		$record = Transactions::create($modeldata);
		$rec_id = $record->id;
		
		// set transaction_ledgers.transactions_id to transactions $rec_id
		foreach ($transactionLedgersModeldata as &$data) {
			$data['transactions_id'] = $rec_id;
		}
		
		//Save Transaction_Ledgers record
		\App\Models\Transaction_Ledgers::insert($transactionLedgersModeldata);
		
        // set narrations.trans_id to transactions.id
		$narrationsModeldata['trans_id'] = $rec_id;
		//save Narrations record
		$narrationsRecord = \App\Models\Narrations::create($narrationsModeldata);
		$this->afterAdd5011($record);
		return $this->redirect("transactions/adminlist", __('recordAddedSuccessfully'));
	}
    /**
     * After new record created
     * @param array $record // newly created record
     */
     private function afterAdd5011($record){
        //enter statement here
        $rec_id            = $record['id'];
        $transactions = DB::table('transactions')->where('id', $rec_id )->first();
        //var_dump($user->name);
        $party_Ledger_id   = $transactions->party_Ledger_id;
        $against_ledger_id = $transactions->against_ledger_id;
        $total_credit       = $transactions->total_credit;
        $company_id        = $transactions->company_id;
        $document_type_code        = $transactions->document_type_code;
        $modeldata         = [
                            'transactions_id' =>  $rec_id, 
                            'ledger_id' => $party_Ledger_id,
                            'credit_id' => $total_credit,
                            'company_id' => $company_id         
                            ];
        DB::table('transaction_ledgers')->insert($modeldata);
           $modeldata         = [
                            'transactions_id' =>  $rec_id , 
                            'ledger_id' => $against_ledger_id,
                            'debit_id' => $total_credit,
                            'company_id' => $company_id       
                            ];
        DB::table('transaction_ledgers')->insert($modeldata);
         DB::table('document_types')
           ->where('document_code', $document_type_code)
            ->where('company_id', $company_id)           
           ->update(['no_view' =>
        DB::raw('no_view + 1')
        ]);
    }
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add5005(){
		return $this->renderView("pages.transactions.add5005");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function add5005_store(Transactionsadd5005Request $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//Validate Transaction_Ledgers form data
		$transactionLedgersPostData = $request->transaction_ledgers;
		$transactionLedgersValidator = validator()->make($transactionLedgersPostData, ["*.ledger_id" => "required",
				"*.debit_id" => "required|numeric",
				"*.comment" => "nullable|string",
				"*.company_id" => "required"]);
		if ($transactionLedgersValidator->fails()) {
			return $transactionLedgersValidator->errors();
		}
		$transactionLedgersValidData = $transactionLedgersValidator->valid();
		$transactionLedgersModeldata = array_values($transactionLedgersValidData);
		
		//Validate Narrations form data
		$narrationsPostData = $request->narrations;
		$narrationsValidator = validator()->make($narrationsPostData, ["narration" => "nullable"]);
		if ($narrationsValidator->fails()) {
			return $narrationsValidator->errors();
		}
		$narrationsModeldata = $this->normalizeFormData($narrationsValidator->valid());
		$modeldata['created_by'] = auth()->user()->id;
		$modeldata['company_id'] = auth()->user()->company_id;
		
		//save Transactions record
		$record = Transactions::create($modeldata);
		$rec_id = $record->id;
		
		// set transaction_ledgers.transactions_id to transactions $rec_id
		foreach ($transactionLedgersModeldata as &$data) {
			$data['transactions_id'] = $rec_id;
		}
		
		//Save Transaction_Ledgers record
		\App\Models\Transaction_Ledgers::insert($transactionLedgersModeldata);
		
        // set narrations.trans_id to transactions.id
		$narrationsModeldata['trans_id'] = $rec_id;
		//save Narrations record
		$narrationsRecord = \App\Models\Narrations::create($narrationsModeldata);
		$this->afterAdd5005($record);
		return $this->redirect("transactions/adminlist", __('recordAddedSuccessfully'));
	}
    /**
     * After new record created
     * @param array $record // newly created record
     */
     private function afterAdd5005($record){
        //enter statement here
        $rec_id            = $record['id'];
        $transactions = DB::table('transactions')->where('id', $rec_id )->first();
        //var_dump($user->name);
        $party_Ledger_id   = $transactions->party_Ledger_id;
        $against_ledger_id = $transactions->against_ledger_id;
        $total_credit       = $transactions->total_credit;
        $company_id        = $transactions->company_id;
        $document_type_code        = $transactions->document_type_code;
        $modeldata         = [
                            'transactions_id' =>  $rec_id, 
                            'ledger_id' => $party_Ledger_id,
                            'credit_id' => $total_credit,
                            'company_id' => $company_id         
                            ];
        DB::table('transaction_ledgers')->insert($modeldata);
           $modeldata         = [
                            'transactions_id' =>  $rec_id , 
                            'ledger_id' => $against_ledger_id,
                            'debit_id' => $total_credit,
                            'company_id' => $company_id       
                            ];
        DB::table('transaction_ledgers')->insert($modeldata);
           DB::table('document_types')
           ->where('document_code', $document_type_code)
            ->where('company_id', $company_id)           
           ->update(['no_view' =>
        DB::raw('no_view + 1')
        ]);
    }
}
