<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Document_TypesAddRequest;
use App\Http\Requests\Document_TypesEditRequest;
use App\Models\Document_Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class Document_TypesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.document_types.list";
		$query = Document_Types::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Document_Types::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "document_types.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->document_types_company_id){
			$val = $request->document_types_company_id;
			$query->where(DB::raw("document_types.company_id"), "=", $val);
		}
		$records = $query->paginate($limit, Document_Types::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Document_Types::query();
		$record = $query->findOrFail($rec_id, Document_Types::viewFields());
		return $this->renderView("pages.document_types.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.document_types.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.document_types.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Document_TypesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		$modeldata['company_id'] = auth()->user()->company_id;
		
		//save Document_Types record
		$record = Document_Types::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("document_types", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Document_TypesEditRequest $request, $rec_id = null){
		$query = Document_Types::query();
		$record = $query->findOrFail($rec_id, Document_Types::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("document_types", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.document_types.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Document_Types::query();
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
	function adminlist(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.document_types.adminlist";
		$query = Document_Types::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Document_Types::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "document_types.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("company_id", "=" , auth()->user()->company_id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Document_Types::adminlistFields());
		return $this->renderView($view, compact("records"));
	}
}
