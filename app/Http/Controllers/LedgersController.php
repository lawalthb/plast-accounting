<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\LedgersAddRequest;
use App\Http\Requests\LedgersEditRequest;
use App\Http\Requests\LedgersaddCustomerRequest;
use App\Http\Requests\LedgersaddSupplierRequest;
use App\Http\Requests\LedgersaddOtherLedgerRequest;
use App\Models\Ledgers;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LedgersListExport;
use App\Exports\LedgersAdminlistExport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
class LedgersController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.ledgers.list";
		$query = Ledgers::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Ledgers::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "ledgers.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->ledgers_sub_account_group_id){
			$val = $request->ledgers_sub_account_group_id;
			$query->where(DB::raw("ledgers.sub_account_group_id"), "=", $val);
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $query->paginate($limit, Ledgers::listFields());
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
		Ledgers::insert($modeldata);
		return $this->redirect(url()->previous(), __('dataImportedSuccessfully'));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Ledgers::query();
		$record = $query->findOrFail($rec_id, Ledgers::viewFields());
		return $this->renderView("pages.ledgers.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.ledgers.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.ledgers.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(LedgersAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['company_id'] = auth()->user()->company_id;
		$modeldata['user_id'] = auth()->user()->id;
		
		//save Ledgers record
		$record = Ledgers::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("ledgers", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(LedgersEditRequest $request, $rec_id = null){
		$query = Ledgers::query();
		$record = $query->findOrFail($rec_id, Ledgers::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("ledgers/adminlist", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.ledgers.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Ledgers::query();
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
	function addcustomer(){
		return $this->renderView("pages.ledgers.addcustomer");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function addcustomer_store(LedgersaddCustomerRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['company_id'] = auth()->user()->company_id;
		$modeldata['user_id'] = auth()->user()->id;
		
		//save Ledgers record
		$record = Ledgers::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("ledgers/adminlist", __('recordAddedSuccessfully'));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function addsupplier(){
		return $this->renderView("pages.ledgers.addsupplier");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function addsupplier_store(LedgersaddSupplierRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['company_id'] = auth()->user()->company_id;
		$modeldata['user_id'] = auth()->user()->id;
		
		//save Ledgers record
		$record = Ledgers::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("ledgers/adminlist", __('recordAddedSuccessfully'));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function addotherledger(){
		return $this->renderView("pages.ledgers.addotherledger");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function addotherledger_store(LedgersaddOtherLedgerRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['company_id'] = auth()->user()->company_id;
		$modeldata['user_id'] = auth()->user()->id;
		
		//save Ledgers record
		$record = Ledgers::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("ledgers/adminlist", __('recordAddedSuccessfully'));
	}
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function adminlist(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.ledgers.adminlist";
		$query = Ledgers::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Ledgers::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "ledgers.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("company_id", "=" , auth()->user()->company_id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->ledgers_sub_account_group_id){
			$val = $request->ledgers_sub_account_group_id;
			$query->where(DB::raw("ledgers.sub_account_group_id"), "=", $val);
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportAdminlist($query); // export current query
		}
		$records = $query->paginate($limit, Ledgers::adminlistFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportList($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "ListLedgersReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Ledgers::exportListFields());
			return view("reports.ledgers-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Ledgers::exportListFields());
			$pdf = PDF::loadView("reports.ledgers-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new LedgersListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new LedgersListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
	

	/**
     * Export table records to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $query
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportAdminlist($query){
		ob_end_clean(); // clean any output to allow file download
		$filename = "AdminlistLedgersReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Ledgers::exportAdminlistFields());
			return view("reports.ledgers-adminlist", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Ledgers::exportAdminlistFields());
			$pdf = PDF::loadView("reports.ledgers-adminlist", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new LedgersAdminlistExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new LedgersAdminlistExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
