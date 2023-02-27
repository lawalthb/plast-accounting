<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;
class Locations extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'locations';
	

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
		'name','company_id','created_by','is_active'
	];
	public $timestamps = true;
	const CREATED_AT = 'date_created'; 
	const UPDATED_AT = 'date_updated'; 
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				locations.name LIKE ? 
		)';
		$search_params = [
			"%$text%"
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
			"locations.id AS id",
			"locations.name AS name",
			"locations.company_id AS company_id",
			"companies.name AS companies_name",
			"locations.created_by AS created_by",
			"users.username AS users_username",
			"locations.is_active AS is_active",
			"locations.date_created AS date_created",
			"locations.date_updated AS date_updated" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"locations.id AS id",
			"locations.name AS name",
			"locations.company_id AS company_id",
			"companies.name AS companies_name",
			"locations.created_by AS created_by",
			"users.username AS users_username",
			"locations.is_active AS is_active",
			"locations.date_created AS date_created",
			"locations.date_updated AS date_updated" 
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
			"company_id",
			"created_by",
			"is_active",
			"date_created",
			"date_updated" 
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
			"company_id",
			"created_by",
			"is_active",
			"date_created",
			"date_updated" 
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
			"company_id",
			"created_by",
			"is_active",
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
			"locations.id AS id",
			"locations.name AS name",
			"locations.created_by AS created_by",
			"locations.is_active AS is_active",
			"locations.date_created AS date_created",
			"companies.name AS companies_name" 
		];
	}
	

	/**
     * return exportAdminlist page fields of the model.
     * 
     * @return array
     */
	public static function exportAdminlistFields(){
		return [ 
			"locations.id AS id",
			"locations.name AS name",
			"locations.created_by AS created_by",
			"locations.is_active AS is_active",
			"locations.date_created AS date_created",
			"companies.name AS companies_name" 
		];
	}
	

	/**
     * Audit log events
     * 
     * @var array
     */
	protected $auditEvents = [
		'created', 'updated', 'deleted'
	];
}
