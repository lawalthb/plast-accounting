<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;
class Document_Types extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'document_types';
	

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
		'name','method_numbering','prefix','prefix_char','starting_num','common_description','print_onsave','desc_each_line','document_code','company_id'
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
				name LIKE ?  OR 
				prefix_char LIKE ? 
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
			"name",
			"method_numbering",
			"prefix",
			"starting_num",
			"common_description",
			"print_onsave",
			"desc_each_line",
			"document_code",
			"date_created",
			"prefix_char" 
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
			"method_numbering",
			"prefix",
			"starting_num",
			"common_description",
			"print_onsave",
			"desc_each_line",
			"document_code",
			"date_created",
			"prefix_char" 
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
			"method_numbering",
			"prefix",
			"starting_num",
			"common_description",
			"print_onsave",
			"desc_each_line",
			"document_code",
			"company_id",
			"date_created",
			"date_updated",
			"prefix_char" 
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
			"method_numbering",
			"prefix",
			"starting_num",
			"common_description",
			"print_onsave",
			"desc_each_line",
			"document_code",
			"company_id",
			"date_created",
			"date_updated",
			"prefix_char" 
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
			"method_numbering",
			"prefix",
			"prefix_char",
			"starting_num",
			"common_description",
			"print_onsave",
			"desc_each_line",
			"document_code",
			"company_id",
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
			"id",
			"name",
			"method_numbering",
			"prefix",
			"starting_num",
			"common_description",
			"print_onsave",
			"desc_each_line",
			"document_code",
			"date_created",
			"prefix_char" 
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
			"name",
			"method_numbering",
			"prefix",
			"starting_num",
			"common_description",
			"print_onsave",
			"desc_each_line",
			"document_code",
			"date_created",
			"prefix_char" 
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
