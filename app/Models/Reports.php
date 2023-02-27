<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Reports extends Model 
{
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'reports';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'name','link','company_id','is_active','no_views','last_view_time','report_code'
	];
	public $timestamps = false;
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				reports.name LIKE ?  OR 
				reports.link LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%"
		];
		//setting search conditions
		$query->whereRaw($search_condition, $search_params);
	}
	

	/**
     * return list page fields of the model.
     * 
     * @return array
     */
	public static function listFields(){
		return [ 
			"reports.id AS id",
			"reports.name AS name",
			"reports.link AS link",
			"reports.company_id AS company_id",
			"companies.name AS companies_name",
			"reports.is_active AS is_active",
			"reports.no_views AS no_views",
			"reports.last_view_time AS last_view_time",
			"reports.report_code AS report_code" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"reports.id AS id",
			"reports.name AS name",
			"reports.link AS link",
			"reports.company_id AS company_id",
			"companies.name AS companies_name",
			"reports.is_active AS is_active",
			"reports.no_views AS no_views",
			"reports.last_view_time AS last_view_time",
			"reports.report_code AS report_code" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"id",
			"name",
			"link",
			"company_id",
			"is_active",
			"no_views",
			"last_view_time",
			"report_code" 
		];
	}
	

	/**
     * return exportView page fields of the model.
     * 
     * @return array
     */
	public static function exportViewFields(){
		return [ 
			"id",
			"name",
			"link",
			"company_id",
			"is_active",
			"no_views",
			"last_view_time",
			"report_code" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"name",
			"link",
			"company_id",
			"is_active",
			"no_views",
			"last_view_time",
			"report_code",
			"id" 
		];
	}
	

	/**
     * return adminlist page fields of the model.
     * 
     * @return array
     */
	public static function adminlistFields(){
		return [ 
			"reports.id AS id",
			"reports.name AS name",
			"reports.link AS link",
			"reports.company_id AS company_id",
			"companies.name AS companies_name",
			"reports.is_active AS is_active",
			"reports.no_views AS no_views",
			"reports.last_view_time AS last_view_time",
			"reports.report_code AS report_code" 
		];
	}
	

	/**
     * return exportAdminlist page fields of the model.
     * 
     * @return array
     */
	public static function exportAdminlistFields(){
		return [ 
			"reports.id AS id",
			"reports.name AS name",
			"reports.link AS link",
			"reports.company_id AS company_id",
			"companies.name AS companies_name",
			"reports.is_active AS is_active",
			"reports.no_views AS no_views",
			"reports.last_view_time AS last_view_time",
			"reports.report_code AS report_code" 
		];
	}
}
