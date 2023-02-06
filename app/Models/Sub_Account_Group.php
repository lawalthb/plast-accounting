<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;
class Sub_Account_Group extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'sub_account_group';
	

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
		'company_id','name','account_group_id','code','description','user_id'
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
				sub_account_group.name LIKE ?  OR 
				sub_account_group.description LIKE ? 
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
			"sub_account_group.id AS id",
			"sub_account_group.name AS name",
			"sub_account_group.account_group_id AS account_group_id",
			"account_groups.name AS account_groups_name",
			"sub_account_group.description AS description",
			"sub_account_group.date_created AS date_created" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"sub_account_group.id AS id",
			"sub_account_group.name AS name",
			"sub_account_group.account_group_id AS account_group_id",
			"account_groups.name AS account_groups_name",
			"sub_account_group.description AS description",
			"sub_account_group.date_created AS date_created" 
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
			"company_id",
			"account_group_id",
			"name",
			"code",
			"description",
			"total_amount",
			"user_id",
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
			"company_id",
			"account_group_id",
			"name",
			"code",
			"description",
			"total_amount",
			"user_id",
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
			"company_id",
			"name",
			"account_group_id",
			"code",
			"description",
			"user_id",
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
			"sub_account_group.id AS id",
			"sub_account_group.name AS name",
			"sub_account_group.account_group_id AS account_group_id",
			"account_groups.name AS account_groups_name",
			"sub_account_group.description AS description",
			"sub_account_group.date_created AS date_created" 
		];
	}
	

	/**
     * return exportAdminlist page fields of the model.
     * 
     * @return array
     */
	public static function exportAdminlistFields(){
		return [ 
			"sub_account_group.id AS id",
			"sub_account_group.name AS name",
			"sub_account_group.account_group_id AS account_group_id",
			"account_groups.name AS account_groups_name",
			"sub_account_group.description AS description",
			"sub_account_group.date_created AS date_created" 
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
