<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;
class Stocks extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'stocks';
	

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
		'product_id','particular','reg_date','stock_in','stock_out','stock_balance','doc_no','user_id','company_id','amount_in','amount_out','ledger_id'
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
				particular LIKE ?  OR 
				doc_no LIKE ? 
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
			"product_id",
			"particular",
			"reg_date",
			"stock_in",
			"stock_out",
			"stock_balance",
			"doc_no",
			"user_id",
			"company_id",
			"amount_in",
			"amount_out",
			"ledger_id",
			"date_created",
			"date_updated" 
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
			"product_id",
			"particular",
			"reg_date",
			"stock_in",
			"stock_out",
			"stock_balance",
			"doc_no",
			"user_id",
			"company_id",
			"amount_in",
			"amount_out",
			"ledger_id",
			"date_created",
			"date_updated" 
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
			"product_id",
			"particular",
			"reg_date",
			"stock_in",
			"stock_out",
			"stock_balance",
			"doc_no",
			"user_id",
			"company_id",
			"amount_in",
			"amount_out",
			"ledger_id",
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
			"product_id",
			"particular",
			"reg_date",
			"stock_in",
			"stock_out",
			"stock_balance",
			"doc_no",
			"user_id",
			"company_id",
			"amount_in",
			"amount_out",
			"ledger_id",
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
			"id",
			"product_id",
			"particular",
			"reg_date",
			"stock_in",
			"stock_out",
			"stock_balance",
			"doc_no",
			"user_id",
			"company_id",
			"amount_in",
			"amount_out",
			"ledger_id" 
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
