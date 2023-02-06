<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;
class Options extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'options';
	

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
		'option_name','option_value','company_id','updated_by'
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
				option_name LIKE ?  OR 
				option_value LIKE ? 
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
			"id",
			"option_name",
			"option_value",
			"company_id",
			"date_created",
			"date_updated",
			"updated_by" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"id",
			"option_name",
			"option_value",
			"company_id",
			"date_created",
			"date_updated",
			"updated_by" 
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
			"option_name",
			"option_value",
			"company_id",
			"date_created",
			"date_updated",
			"updated_by" 
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
			"option_name",
			"option_value",
			"company_id",
			"date_created",
			"date_updated",
			"updated_by" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"id",
			"option_name",
			"option_value",
			"company_id",
			"updated_by" 
		];
	}
	

	/**
     * return adminlist page fields of the model.
     * 
     * @return array
     */
	public static function adminlistFields(){
		return [ 
			"id",
			"option_name",
			"option_value",
			"company_id",
			"date_created",
			"date_updated",
			"updated_by" 
		];
	}
	

	/**
     * return exportAdminlist page fields of the model.
     * 
     * @return array
     */
	public static function exportAdminlistFields(){
		return [ 
			"id",
			"option_name",
			"option_value",
			"company_id",
			"date_created",
			"date_updated",
			"updated_by" 
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
