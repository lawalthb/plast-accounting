<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
class Companies extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	use SoftDeletes;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'companies';
	

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
		'name','slogan','address','website','com_email','com_phone','logo','favicon','signature'
	];
	public $timestamps = true;
	const CREATED_AT = 'date_created'; 
	const UPDATED_AT = 'date_updated'; 
	const DELETED_AT = 'rec_deleted'; 
	

	/**
     * Set search query for the model
	 * @param \Illuminate\Database\Eloquent\Builder $query
	 * @param string $text
     */
	public static function search($query, $text){
		//search table record 
		$search_condition = '(
				name LIKE ?  OR 
				address LIKE ?  OR 
				com_email LIKE ?  OR 
				logo LIKE ?  OR 
				slogan LIKE ?  OR 
				website LIKE ?  OR 
				favicon LIKE ?  OR 
				com_phone LIKE ?  OR 
				signature LIKE ? 
		)';
		$search_params = [
			"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
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
			"name",
			"address",
			"com_email",
			"logo",
			"date_created" 
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
			"name",
			"address",
			"com_email",
			"logo",
			"date_created" 
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
			"slogan",
			"address",
			"logo",
			"website",
			"favicon",
			"com_email",
			"com_phone",
			"signature",
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
			"slogan",
			"address",
			"logo",
			"website",
			"favicon",
			"com_email",
			"com_phone",
			"signature",
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
			"slogan",
			"address",
			"website",
			"com_email",
			"com_phone",
			"logo",
			"favicon",
			"signature",
			"id" 
		];
	}
	

	/**
     * return dashboardlist page fields of the model.
     * 
     * @return array
     */
	public static function dashboardlistFields(){
		return [ 
			"id",
			"name",
			"com_email",
			"date_created",
			"slogan" 
		];
	}
	

	/**
     * return exportDashboardlist page fields of the model.
     * 
     * @return array
     */
	public static function exportDashboardlistFields(){
		return [ 
			"id",
			"name",
			"com_email",
			"date_created",
			"slogan" 
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
