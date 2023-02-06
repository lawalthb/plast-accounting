<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionsAddRequest;
use App\Http\Requests\PermissionsEditRequest;
use App\Http\Requests\PermissionsroleAddPermissionRequest;
use App\Models\Permissions;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PermissionsViewExport;
use App\Exports\PermissionsAdminlistExport;
use Illuminate\Support\Facades\DB;
use Exception;
class PermissionsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.permissions.list";
		$query = Permissions::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Permissions::search($query, $search); // search table records
		}
		$query->join("roles", "permissions.role_id", "=", "roles.role_id");
		$orderby = $request->orderby ?? "permissions.permission_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->permissions_role_id){
			$val = $request->permissions_role_id;
			$query->where(DB::raw("permissions.role_id"), "=", $val);
		}
		if($request->permissions_permission){
			$val = $request->permissions_permission;
			$query->where(DB::raw("permissions.permission"), "=", $val);
		}
		if($request->permissions_company_id){
			$val = $request->permissions_company_id;
			$query->where(DB::raw("permissions.company_id"), "=", $val);
		}
		$records = $query->paginate($limit, Permissions::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Permissions::query();
		// if request format is for export example:- product/view/344?export=pdf
		if($this->getExportFormat()){
			return $this->ExportView($query, $rec_id);
		}
		$record = $query->findOrFail($rec_id, Permissions::viewFields());
		return $this->renderView("pages.permissions.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return view("pages.permissions.add");
	}
	

	/**
     * Insert multiple record into the database table
     * @return \Illuminate\Http\Response
     */
	function store(PermissionsAddRequest $request){
		$postdata = $request->input("row");
		$modeldata = array_values($postdata);
		Permissions::insert($modeldata);
		return $this->redirect("permissions", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(PermissionsEditRequest $request, $rec_id = null){
		$query = Permissions::query();
		$record = $query->findOrFail($rec_id, Permissions::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("permissions", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.permissions.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Permissions::query();
		$query->whereIn("permission_id", $arr_id);
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
		$view = "pages.permissions.adminlist";
		$query = Permissions::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Permissions::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "permissions.permission_id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("role_id", "!=" , 3);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->permissions_role_id){
			$val = $request->permissions_role_id;
			$query->where(DB::raw("permissions.role_id"), "=", $val);
		}
		if($request->permissions_permission){
			$val = $request->permissions_permission;
			$query->where(DB::raw("permissions.permission"), "=", $val);
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportAdminlist($query); // export current query
		}
		$records = $query->paginate($limit, Permissions::adminlistFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function roleaddpermission(){
		return view("pages.permissions.roleaddpermission");
	}
	

	/**
     * Insert multiple record into the database table
     * @return \Illuminate\Http\Response
     */
	function roleaddpermission_store(PermissionsroleAddPermissionRequest $request){
		$postdata = $request->input("row");
		$modeldata = array_values($postdata);
		Permissions::insert($modeldata);
		return $this->redirect("permissions", __('recordAddedSuccessfully'));
	}
	private function getNextRecordId($rec_id){
		$query = Permissions::query();
		$query->where('permission_id', '>', $rec_id);
		$query->orderBy('permission_id', 'asc');
		$record = $query->first(['permission_id']);
		if($record){
			return $record['permission_id'];
		}
		return null;
	}
	private function getPreviousRecordId($rec_id){
		$query = Permissions::query();
		$query->where('permission_id', '<', $rec_id);
		$query->orderBy('permission_id', 'desc');
		$record = $query->first(['permission_id']);
		if($record){
			return $record['permission_id'];
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
		$filename ="ViewPermissionsReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$record = $query->findOrFail($rec_id, Permissions::exportViewFields());
			return view("reports.permissions-view", ["record" => $record]);
		}
		elseif($format == "pdf"){
			$record = $query->findOrFail($rec_id, Permissions::exportViewFields());
			$pdf = PDF::loadView("reports.permissions-view", ["record" => $record]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new PermissionsViewExport($query, $rec_id), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new PermissionsViewExport($query, $rec_id), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
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
		$filename = "AdminlistPermissionsReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Permissions::exportAdminlistFields());
			return view("reports.permissions-adminlist", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Permissions::exportAdminlistFields());
			$pdf = PDF::loadView("reports.permissions-adminlist", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new PermissionsAdminlistExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new PermissionsAdminlistExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
