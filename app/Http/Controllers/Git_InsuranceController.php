<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Git_InsuranceAddRequest;
use App\Http\Requests\Git_InsuranceEditRequest;
use App\Models\Git_Insurance;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GitInsuranceViewExport;
use Illuminate\Support\Facades\DB;
use Exception;
class Git_InsuranceController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.git_insurance.list";
		$query = Git_Insurance::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Git_Insurance::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "git_insurance.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->git_insurance_company_id){
			$val = $request->git_insurance_company_id;
			$query->where(DB::raw("git_insurance.company_id"), "=", $val);
		}
		$records = $query->paginate($limit, Git_Insurance::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Git_Insurance::query();
		// if request format is for export example:- product/view/344?export=pdf
		if($this->getExportFormat()){
			return $this->ExportView($query, $rec_id);
		}
		$record = $query->findOrFail($rec_id, Git_Insurance::viewFields());
		return $this->renderView("pages.git_insurance.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.git_insurance.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Git_InsuranceAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//Validate Git_Customers form data
		$gitCustomersPostData = $request->git_customers;
		$gitCustomersValidator = validator()->make($gitCustomersPostData, ["*.customer_name" => "required|string",
				"*.invoice_no" => "required|string",
				"*.amount" => "required|numeric",
				"*.comment" => "nullable|string"]);
		if ($gitCustomersValidator->fails()) {
			return $gitCustomersValidator->errors();
		}
		$gitCustomersValidData = $gitCustomersValidator->valid();
		$gitCustomersModeldata = array_values($gitCustomersValidData);
		$modeldata['company_id'] = auth()->user()->company_id;
		
		//save Git_Insurance record
		$record = Git_Insurance::create($modeldata);
		$rec_id = $record->id;
		
		// set git_customers.git_insurance_id to git_insurance $rec_id
		foreach ($gitCustomersModeldata as &$data) {
			$data['git_insurance_id'] = $rec_id;
		}
		
		//Save Git_Customers record
		\App\Models\Git_Customers::insert($gitCustomersModeldata);
	$this->sendMailOnRecordAdd($record);
		return $this->redirect("git_insurance", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Git_InsuranceEditRequest $request, $rec_id = null){
		$query = Git_Insurance::query();
		$record = $query->findOrFail($rec_id, Git_Insurance::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("git_insurance", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.git_insurance.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Git_Insurance::query();
		$query->whereIn("id", $arr_id);
		//to raise audit trail delete event, use Eloquent 'get' before delete
		$query->get()->each(function ($record, $key) {
			$record->delete();
		});
		$redirectUrl = $request->redirect ?? url()->previous();
		return $this->redirect($redirectUrl, __('recordDeletedSuccessfully'));
	}
	private function getNextRecordId($rec_id){
		$query = Git_Insurance::query();
		$query->where('id', '>', $rec_id);
		$query->orderBy('id', 'asc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
	private function getPreviousRecordId($rec_id){
		$query = Git_Insurance::query();
		$query->where('id', '<', $rec_id);
		$query->orderBy('id', 'desc');
		$record = $query->first(['id']);
		if($record){
			return $record['id'];
		}
		return null;
	}
	

	/**
     * Export single record to different format
	 * supported format:- PDF, CSV, EXCEL, HTML
	 * @param \Illuminate\Database\Eloquent\Model $record
	 * @param string $rec_id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
	private function ExportView($query, $rec_id){
		ob_end_clean();// clean any output to allow file download
		$filename ="ViewGit_InsuranceReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$record = $query->findOrFail($rec_id, Git_Insurance::exportViewFields());
			return view("reports.git_insurance-view", ["record" => $record]);
		}
		elseif($format == "pdf"){
			$record = $query->findOrFail($rec_id, Git_Insurance::exportViewFields());
			$pdf = PDF::loadView("reports.git_insurance-view", ["record" => $record]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new GitInsuranceViewExport($query, $rec_id), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new GitInsuranceViewExport($query, $rec_id), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
	private function sendMailOnRecordAdd($record = null){
		try{
			$subject = "New Git Insurance Record Added";
			$message = "New Git Insurance record has been added.";	
			$receiver = "admin@plast_accounting.com";
			$recid = $record->id;
			$recordLink = url("git_insurance/view/$recid");
			$this->sendRecordActionMail($receiver, $subject, $message, $recordLink);
		}
		catch(Exception $ex){
			throw $ex;
		}
	}
}
