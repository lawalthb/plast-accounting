<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction_LedgersAddRequest;
use App\Http\Requests\Transaction_LedgersEditRequest;
use App\Http\Requests\Transaction_Ledgersadd4receiptRequest;
use App\Http\Requests\Transaction_Ledgersadd4paymentRequest;
use App\Models\Transaction_Ledgers;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionLedgersListExport;
use Illuminate\Support\Facades\Validator;
use Exception;
class Transaction_LedgersController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.transaction_ledgers.list";
		$query = Transaction_Ledgers::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Transaction_Ledgers::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "transaction_ledgers.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $query->paginate($limit, Transaction_Ledgers::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Import csv file data into a table 
     * @return data
     */
	function importdata(Request $request){
		$importSettings = config("upload.import");
		$maxFileSize = intval($importSettings["max_file_size"]) * 1000; //in kilobyte
		$validator = Validator::make($request->all(), 
			[
				"file" => "file|required|max:$maxFileSize|mimes:csv,txt",
			]
		);
		if ($validator->fails()) {
			return back()->withErrors($validator->errors());
		}
		$csvOptions = array(
			'fields' => '', //leave empty to use the first row as the columns
			'delimiter' => ',', 
			'quote' => '"'
		);
		$filePath = $request->file('file')->getRealPath();
		$modeldata = parse_csv_file($filePath, $csvOptions);
		Transaction_Ledgers::insert($modeldata);
		return $this->redirect(url()->previous(), __('dataImportedSuccessfully'));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Transaction_Ledgers::query();
		$record = $query->findOrFail($rec_id, Transaction_Ledgers::viewFields());
		return $this->renderView("pages.transaction_ledgers.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.transaction_ledgers.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Transaction_LedgersAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Transaction_Ledgers record
		$record = Transaction_Ledgers::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("transaction_ledgers", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Transaction_LedgersEditRequest $request, $rec_id = null){
		$query = Transaction_Ledgers::query();
		$record = $query->findOrFail($rec_id, Transaction_Ledgers::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("transaction_ledgers", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.transaction_ledgers.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Transaction_Ledgers::query();
		$query->whereIn("id", $arr_id);
		//to raise audit trail delete event, use Eloquent 'get' before delete
		$query->get()->each(function ($record, $key) {
			$record->delete();
		});
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add4receipt(){
		return view("pages.transaction_ledgers.add4receipt");
	}
	

	/**
     * Insert multiple record into the database table
     * @return \Illuminate\Http\Response
     */
	function add4receipt_store(Transaction_Ledgersadd4receiptRequest $request){
		$postdata = $request->input("row");
		$modeldata = array_values($postdata);
		Transaction_Ledgers::insert($modeldata);
		return $this->redirect("transaction_ledgers", __('recordAddedSuccessfully'));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add4payment(){
		return view("pages.transaction_ledgers.add4payment");
	}
	

	/**
     * Insert multiple record into the database table
     * @return \Illuminate\Http\Response
     */
	function add4payment_store(Transaction_Ledgersadd4paymentRequest $request){
		$postdata = $request->input("row");
		$modeldata = array_values($postdata);
		Transaction_Ledgers::insert($modeldata);
		return $this->redirect("transaction_ledgers", __('recordAddedSuccessfully'));
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportList($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "ListTransaction_LedgersReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Transaction_Ledgers::exportListFields());
			return view("reports.transaction_ledgers-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Transaction_Ledgers::exportListFields());
			$pdf = PDF::loadView("reports.transaction_ledgers-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new TransactionLedgersListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new TransactionLedgersListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
