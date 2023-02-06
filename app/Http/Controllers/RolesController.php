<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolesAddRequest;
use App\Http\Requests\RolesEditRequest;
use App\Models\Roles;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RolesViewExport;
use Illuminate\Support\Facades\DB;
use Exception;
class RolesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.roles.list";
		$query = Roles::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Roles::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "roles.role_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->roles_company_id){
			$val = $request->roles_company_id;
			$query->where(DB::raw("roles.company_id"), "=", $val);
		}
		$records = $query->paginate($limit, Roles::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Roles::query();
		// if request format is for export example:- product/view/344?export=pdf
		if($this->getExportFormat()){
			return $this->ExportView($query, $rec_id);
		}
		$record = $query->findOrFail($rec_id, Roles::viewFields());
		return $this->renderView("pages.roles.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.roles.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.roles.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(RolesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//Validate Permissions form data
		$permissionsPostData = $request->permissions;
		$permissionsValidator = validator()->make($permissionsPostData, ["*.permission" => "required",
				"*.company_id" => "required"]);
		if ($permissionsValidator->fails()) {
			return $permissionsValidator->errors();
		}
		$permissionsModeldata = $this->normalizeFormData($permissionsValidator->valid());
		
		//save Roles record
		$record = Roles::create($modeldata);
		$rec_id = $record->role_id;
		
        // set permissions.role_id to roles.permission_id
		$permissionsModeldata['role_id'] = $rec_id;
		//save Permissions record
		$permissionsRecord = \App\Models\Permissions::create($permissionsModeldata);
		return $this->redirect("roles", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(RolesEditRequest $request, $rec_id = null){
		$query = Roles::query();
		$record = $query->findOrFail($rec_id, Roles::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("roles", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.roles.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Roles::query();
		$query->whereIn("role_id", $arr_id);
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
	function adminlist(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.roles.adminlist";
		$query = Roles::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Roles::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "roles.role_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("company_id", "=" , auth()->user()->company_id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->roles_company_id){
			$val = $request->roles_company_id;
			$query->where(DB::raw("roles.company_id"), "=", $val);
		}
		$records = $query->paginate($limit, Roles::adminlistFields());
		return $this->renderView($view, compact("records"));
	}
	private function getNextRecordId($rec_id){
		$query = Roles::query();
		$query->where('role_id', '>', $rec_id);
		$query->orderBy('role_id', 'asc');
		$record = $query->first(['role_id']);
		if($record){
			return $record['role_id'];
		}
		return null;
	}
	private function getPreviousRecordId($rec_id){
		$query = Roles::query();
		$query->where('role_id', '<', $rec_id);
		$query->orderBy('role_id', 'desc');
		$record = $query->first(['role_id']);
		if($record){
			return $record['role_id'];
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
		$filename ="ViewRolesReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$record = $query->findOrFail($rec_id, Roles::exportViewFields());
			return view("reports.roles-view", ["record" => $record]);
		}
		elseif($format == "pdf"){
			$record = $query->findOrFail($rec_id, Roles::exportViewFields());
			$pdf = PDF::loadView("reports.roles-view", ["record" => $record]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new RolesViewExport($query, $rec_id), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new RolesViewExport($query, $rec_id), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
