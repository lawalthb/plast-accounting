<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;
class Git_Insurance extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'git_insurance';
	

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
		'git_no','reg_date','vehicle_no','driver_name','load_from','going_to','total_amount','charges','item_type','mail_sent','is_active','company_id'
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
				git_no LIKE ?  OR 
				vehicle_no LIKE ?  OR 
				item_type LIKE ?  OR 
				driver_name LIKE ?  OR 
				load_from LIKE ?  OR 
				going_to LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"git_no",
			"vehicle_no",
			"item_type",
			"reg_date",
			"driver_name",
			"load_from",
			"going_to",
			"total_amount",
			"mail_sent",
			"charges" 
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
			"git_no",
			"vehicle_no",
			"item_type",
			"reg_date",
			"driver_name",
			"load_from",
			"going_to",
			"total_amount",
			"mail_sent",
			"charges" 
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
			"git_no",
			"vehicle_no",
			"item_type",
			"reg_date",
			"driver_name",
			"load_from",
			"going_to",
			"total_amount",
			"is_active",
			"date_created",
			"date_updated",
			"company_id",
			"mail_sent",
			"charges" 
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
			"git_no",
			"vehicle_no",
			"item_type",
			"reg_date",
			"driver_name",
			"load_from",
			"going_to",
			"total_amount",
			"is_active",
			"date_created",
			"date_updated",
			"company_id",
			"mail_sent",
			"charges" 
		];
	}
	

	/**
     * return edit page fields of the model.
     * 
     * @return array
     */
	public static function editFields(){
		return [ 
			"git_no",
			"reg_date",
			"vehicle_no",
			"driver_name",
			"load_from",
			"going_to",
			"total_amount",
			"charges",
			"item_type",
			"mail_sent",
			"is_active",
			"company_id",
			"id" 
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
