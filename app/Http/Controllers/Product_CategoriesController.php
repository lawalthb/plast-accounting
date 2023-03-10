<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product_CategoriesAddRequest;
use App\Http\Requests\Product_CategoriesEditRequest;
use App\Models\Product_Categories;
use Illuminate\Http\Request;
use \PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductCategoriesListExport;
use App\Exports\ProductCategoriesAdminlistExport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
class Product_CategoriesController extends Controller
{
	

	/**
     * List table records
	 * @param  \Illuminate\Http\Request
     * @param string $fieldname //filter records by a table field
     * @param string $fieldvalue //filter value
     * @return \Illuminate\View\View
     */
	function index(Request $request, $fieldname = null , $fieldvalue = null){
		$view = "pages.product_categories.list";
		$query = Product_Categories::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Product_Categories::search($query, $search); // search table records
		}
		$query->join("users", "product_categories.user_id", "=", "users.id");
		$orderby = $request->orderby ?? "product_categories.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		if($request->product_categories_id){
			$val = $request->product_categories_id;
			$query->where(DB::raw("product_categories.id"), "=", $val);
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportList($query); // export current query
		}
		$records = $query->paginate($limit, Product_Categories::listFields());
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
		Product_Categories::insert($modeldata);
		return $this->redirect(url()->previous(), __('dataImportedSuccessfully'));
	}
	

	/**
     * Select table record by ID
	 * @param string $rec_id
     * @return \Illuminate\View\View
     */
	function view($rec_id = null){
		$query = Product_Categories::query();
		$record = $query->findOrFail($rec_id, Product_Categories::viewFields());
		return $this->renderView("pages.product_categories.view", ["data" => $record]);
	}
	

	/**
     * Display Master Detail Pages
	 * @param string $rec_id //master record id
     * @return \Illuminate\View\View
     */
	function masterDetail($rec_id = null){
		return View("pages.product_categories.detail-pages", ["masterRecordId" => $rec_id]);
	}
	

	/**
     * Display form page
     * @return \Illuminate\View\View
     */
	function add(){
		return $this->renderView("pages.product_categories.add");
	}
	

	/**
     * Save form record to the table
     * @return \Illuminate\Http\Response
     */
	function store(Product_CategoriesAddRequest $request){
		$modeldata = $this->normalizeFormData($request->validated());
		
		//save Product_Categories record
		$record = Product_Categories::create($modeldata);
		$rec_id = $record->id;
		return $this->redirect("product_categories/adminlist", __('recordAddedSuccessfully'));
	}
	

	/**
     * Update table record with form data
	 * @param string $rec_id //select record by table primary key
     * @return \Illuminate\View\View;
     */
	function edit(Product_CategoriesEditRequest $request, $rec_id = null){
		$query = Product_Categories::query();
		$record = $query->findOrFail($rec_id, Product_Categories::editFields());
		if ($request->isMethod('post')) {
			$modeldata = $this->normalizeFormData($request->validated());
			$record->update($modeldata);
			return $this->redirect("product_categories", __('recordUpdatedSuccessfully'));
		}
		return $this->renderView("pages.product_categories.edit", ["data" => $record, "rec_id" => $rec_id]);
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
		$query = Product_Categories::query();
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
		$view = "pages.product_categories.adminlist";
		$query = Product_Categories::query();
		$limit = $request->limit ?? 20;
		if($request->search){
			$search = trim($request->search);
			Product_Categories::search($query, $search); // search table records
		}
		$orderby = $request->orderby ?? "product_categories.id";
		$ordertype = $request->ordertype ?? "desc";
		$query->orderBy($orderby, $ordertype);
		$query->where("company_id", "=" , auth()->user()->company_id);
		if($fieldname){
			$query->where($fieldname , $fieldvalue); //filter by a table field
		}
		// if request format is for export example:- product/index?export=pdf
		if($this->getExportFormat()){
			return $this->ExportAdminlist($query); // export current query
		}
		$records = $query->paginate($limit, Product_Categories::adminlistFields());
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
		$filename = "ListProduct_CategoriesReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Product_Categories::exportListFields());
			return view("reports.product_categories-list", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Product_Categories::exportListFields());
			$pdf = PDF::loadView("reports.product_categories-list", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new ProductCategoriesListExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new ProductCategoriesListExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
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
		$filename = "AdminlistProduct_CategoriesReport-" . date_now();
		$format = $this->getExportFormat();
		if($format == "print"){
			$records = $query->get(Product_Categories::exportAdminlistFields());
			return view("reports.product_categories-adminlist", ["records" => $records]);
		}
		elseif($format == "pdf"){
			$records = $query->get(Product_Categories::exportAdminlistFields());
			$pdf = PDF::loadView("reports.product_categories-adminlist", ["records" => $records]);
			return $pdf->download("$filename.pdf");
		}
		elseif($format == "csv"){
			return Excel::download(new ProductCategoriesAdminlistExport($query), "$filename.csv", \Maatwebsite\Excel\Excel::CSV);
		}
		elseif($format == "excel"){
			return Excel::download(new ProductCategoriesAdminlistExport($query), "$filename.xlsx", \Maatwebsite\Excel\Excel::XLSX);
		}
	}
}
