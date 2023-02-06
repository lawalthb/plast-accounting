<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;
class Permissions extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'permissions';
	

	/**
     * The table primary key field
     *
     * @var string
     */
	protected $primaryKey = 'permission_id';
	

	/**
     * Table fillable fields
     *
     * @var array
     */
	protected $fillable = [
		'role_id','permission','company_id'
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
				permissions.permission LIKE ? 
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
			"permissions.permission_id AS permission_id",
			"permissions.permission AS permission",
			"permissions.role_id AS role_id",
			"roles.role_name AS roles_role_name",
			"permissions.company_id AS company_id",
			"permissions.date_created AS date_created",
			"permissions.date_updated AS date_updated" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"permissions.permission_id AS permission_id",
			"permissions.permission AS permission",
			"permissions.role_id AS role_id",
			"roles.role_name AS roles_role_name",
			"permissions.company_id AS company_id",
			"permissions.date_created AS date_created",
			"permissions.date_updated AS date_updated" 
		];
	}
	

	/**
     * return view page fields of the model.
     * 
     * @return array
     */
	public static function viewFields(){
		return [ 
			"permission_id",
			"permission",
			"role_id",
			"company_id",
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
			"permission_id",
			"permission",
			"role_id",
			"company_id",
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
			"role_id",
			"permission",
			"company_id",
			"permission_id" 
		];
	}
	

	/**
     * return adminlist page fields of the model.
     * 
     * @return array
     */
	public static function adminlistFields(){
		return [ 
			"permission_id",
			"permission",
			"role_id",
			"company_id",
			"date_created",
			"date_updated" 
		];
	}
	

	/**
     * return exportAdminlist page fields of the model.
     * 
     * @return array
     */
	public static function exportAdminlistFields(){
		return [ 
			"permission_id",
			"permission",
			"role_id",
			"company_id",
			"date_created",
			"date_updated" 
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
