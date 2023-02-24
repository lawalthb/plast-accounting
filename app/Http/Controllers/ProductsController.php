<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsAddRequest;
use App\Http\Requests\ProductsEditRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
class ProductsController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.products.list";
		$query = Products::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Products::search($query, $search); // search table records
		}
		$query->join("companies", "products.company_id", "=", "companies.id");
		$query->join("product_categories", "products.category", "=", "product_categories.id");
		$query->join("users", "products.user_id", "=", "users.id");
		$query->join("units", "products.unit", "=", "units.id");
		$orderby = $request->orderby ?? "products.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->products_category){
			$val = $request->products_category;
			$query->where(DB::raw("products.category"), "=", $val);
		}
		$records = $query->paginate($limit, Products::listFields());
		return $this->renderView($view, compact("records"));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Products::query();
		$record = $query->findOrFail($rec_id, Products::viewFields());
		return $this->renderView("pages.products.view", ["data" => $record]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.products.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(ProductsAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
		$modeldata['company_id'] = auth()->user()->company_id;
		$modeldata['user_id'] = auth()->user()->id;
		
		//save Products record
		$record = Products::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("products", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(ProductsEditRequest $request, $rec_id = null){
		$query = Products::query();
		$record = $query->findOrFail($rec_id, Products::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
		
		if( array_key_exists("image", $modeldata) ){
			//move uploaded file from temp directory to destination directory
			$fileInfo = $this->moveUploadedFiles($modeldata['image'], "image");
			$modeldata['image'] = $fileInfo['filepath'];
		}
			$record->update($modeldata);
			return $this->redirect("products", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.products.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Products::query();
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
		$view = "pages.products.superdashboardlist";
		$query = Products::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Products::search($query, $search); // search table records
		}
		$query->join("product_categories", "products.category", "=", "product_categories.id");
		$query->join("users", "products.user_id", "=", "users.id");
		$query->join("companies", "products.company_id", "=", "companies.id");
		$query->join("units", "products.unit", "=", "units.id");
		$orderby = $request->orderby ?? "products.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		$records = $query->paginate($limit, Products::superdashboardlistFields());
		return $this->renderView($view, compact("records"));
	}
}
