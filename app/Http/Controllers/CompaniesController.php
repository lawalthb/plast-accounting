<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompaniesAddRequest;
use App\Http\Requests\CompaniesEditRequest;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class CompaniesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.companies.list";
		$query = Companies::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Companies::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "companies.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Companies::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Companies::query();
		$record = $query->findOrFail($rec_id, Companies::viewFields());
		return $this->renderView("pages.companies.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.companies.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.companies.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(CompaniesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("logo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['logo'], "logo");
			$modeldata['logo'] = $fileInfo['filepath'];
		}
		
		if( array_key_exists("favicon", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['favicon'], "favicon");
			$modeldata['favicon'] = $fileInfo['filepath'];
		}
		
		//Validate Users form data
		$usersPostData = $request->users;
		$usersValidator = validator()->make($usersPostData, ["firstname" => "required|string",
				"lastname" => "required|string",
				"email" => "required|email|unique:users,email",
				"username" => "required|string|unique:users,username",
				"phone" => "nullable|string",
				"photo" => "nullable",
				"company_id" => "nullable",
				"user_role_id" => "required"]);
		if ($usersValidator->fails()) {
			return $usersValidator->errors();
		}
		$usersModeldata = $this->normalizeFormData($usersValidator->valid());

		if( array_key_exists("photo", $usersModeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($usersModeldata['photo'], "photo");
			 $usersModeldata['photo'] = $fileInfo['filepath'];
		}
		
		//save Companies record
		$record = Companies::create($modeldata);
		$rec_id = $record->id;
		
        // set users.company_id to companies.id
		$usersModeldata['company_id'] = $rec_id;
		//save Users record
		$usersRecord = \App\Models\Users::create($usersModeldata);
		$this->afterAdd($record);
		return $this->redirect("companies", __('recordAddedSuccessfully'));
	}
    /**
     * After new record created
     * @param array $record // newly created record
     */
    private function afterAdd($record){
        //enter statement here
         $comp_id = $record['id'];
        $user      = DB::table('users')->where('company_id', $comp_id)->first();
        $user_id   = $user->id ;
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 1, 'name' => 'Bank Accounts', 'code' => '2001', 'description' => 'Bank Accounts', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 2, 'name' => 'Bank OD Ac', 'code' => '2002', 'description' => 'Bank Overdraft Account', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 1, 'name' => 'Cash-in-hand', 'code' => '2003', 'description' => 'Cash at hand', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 1, 'name' => 'Deposits (Asset)', 'code' => '2004', 'description' => 'Money received', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 2, 'name' => 'Duties & Taxes', 'code' => '2005', 'description' => 'Govt Tax', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 1, 'name' => 'Loans & Advances (Asset)', 'code' => '2006', 'description' => 'Workers loan or IOU', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 2, 'name' => 'Provisions', 'code' => '2007', 'description' => 'Provisions - items bought for company', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 6, 'name' => 'Reserves & Surplus', 'code' => '2008', 'description' => 'Owner money - capital', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 2, 'name' => 'Secured Loans', 'code' => '2009', 'description' => 'Loan collected from Bank', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 1, 'name' => 'Stock-in-hand', 'code' => '2010', 'description' => 'Inventory total stock amount', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 2, 'name' => 'Sundry Creditors', 'code' => '2011', 'description' => 'Vendors or suppliers', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 1, 'name' => 'Sundry Debtors', 'code' => '2012', 'description' => 'Customers, buyers', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 2, 'name' => 'Unsecured Loans', 'code' => '2013', 'description' => 'Loans that are not from bank', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 3, 'name' => 'Purchase Accounts', 'code' => '2014', 'description' => 'Purchase Accounts', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 4, 'name' => 'Sales Accounts', 'code' => '2015', 'description' => 'Sales Accounts', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 7, 'name' => 'Suspense Ac', 'code' => '2016', 'description' => 'Unknow account', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 2, 'name' => 'Capital Account', 'code' => '2017', 'description' => 'Capital Account', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 2, 'name' => 'Branch/Divisions', 'code' => '2018', 'description' => 'Branch, another location', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 3, 'name' => 'Direct Expenses', 'code' => '2019', 'description' => 'Expenses that contributed to product', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 4, 'name' => 'Direct Incomes', 'code' => '2020', 'description' => 'Other revenue from services or contract', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 3, 'name' => 'Indirect Expenses', 'code' => '2021', 'description' => 'Expenses that did not contribute to product eg. salary', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
        $modeldata = ['company_id' => $comp_id , 'account_group_id' => 4, 'name' => 'Indirect Incomes', 'code' => '2022', 'description' => 'Other revenue, like rent or intrest', 'total_amount' => '0.00', 'user_id' => $user_id ]; DB::table('sub_account_group')->insert($modeldata);
    $modeldata = ['company_id' => $comp_id , 'name' => 'None', 'user_id' => $user_id ]; DB::table('marketers')->insert($modeldata);
     $modeldata = ['company_id' => $comp_id , 'name' => 'Main Location', 'created_by' => $user_id ]; DB::table('locations')->insert($modeldata);
     $modeldata = ['company_id'=>$comp_id,'name'=>'Sales Invoice','method_numbering'=>'Automatic','document_code'=>'5001','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'Purchase Invoice','method_numbering'=>'Manual','document_code'=>'5002','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'Quotation','method_numbering'=>'Automatic','document_code'=>'5003','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'LocalPurchase','method_numbering'=>'Manual','document_code'=>'5004','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'Contra','method_numbering'=>'Automatic','document_code'=>'5005','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'Credit Note','method_numbering'=>'Automatic','document_code'=>'5006','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'Debit Note','method_numbering'=>'Automatic','document_code'=>'5007','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'DeliveryNote','method_numbering'=>'Automatic','document_code'=>'5008','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'Journal','method_numbering'=>'Automatic','document_code'=>'5009','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'Memorandum','method_numbering'=>'Automatic','document_code'=>'5010','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'Payment','method_numbering'=>'Automatic','document_code'=>'5011','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'Physical Stock','method_numbering'=>'Automatic','document_code'=>'5012','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'Attendance','method_numbering'=>'Automatic','document_code'=>'5013','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'Receipt','method_numbering'=>'Automatic','document_code'=>'5014','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'Goods Received Note','method_numbering'=>'Automatic','document_code'=>'5015','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'RejectionIn','method_numbering'=>'Automatic','document_code'=>'5016','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'RejectionOut','method_numbering'=>'Automatic','document_code'=>'5017','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);$modeldata=['company_id'=>$comp_id,'name'=>'Stock Journal','method_numbering'=>'Automatic','document_code'=>'5018','created_by'=>$user_id];DB::table('document_types')->insert($modeldata);
 }
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(CompaniesEditRequest $request, $rec_id = null){
		$query = Companies::query();
		$record = $query->findOrFail($rec_id, Companies::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("logo", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['logo'], "logo");
			$modeldata['logo'] = $fileInfo['filepath'];
		}
		
		if( array_key_exists("favicon", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['favicon'], "favicon");
			$modeldata['favicon'] = $fileInfo['filepath'];
		}
		
		if( array_key_exists("signature", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['signature'], "signature");
			$modeldata['signature'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("companies", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.companies.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Companies::query();
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
	function dashboardlist(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.companies.dashboardlist";
		$query = Companies::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Companies::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "companies.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Companies::dashboardlistFields());
		return $this->renderView($view, compact("records"));
	}
}
