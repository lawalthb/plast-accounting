<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;
class Transactions extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'transactions';
	

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
		'trans_no','reference','trans_date','party_ledger_id','against_ledger_id','document_type_id','document_type_code','total_debit','total_credit','created_by','company_id'
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
				reference LIKE ?  OR 
				trans_no LIKE ? 
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
			"trans_date",
			"reference",
			"party_Ledger_id AS party_ledger_id",
			"against_ledger_id",
			"document_type_id",
			"document_type_code",
			"total_debit",
			"total_credit",
			"created_by",
			"company_id",
			"trans_no",
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
			"trans_date",
			"reference",
			"party_Ledger_id AS party_ledger_id",
			"against_ledger_id",
			"document_type_id",
			"document_type_code",
			"total_debit",
			"total_credit",
			"created_by",
			"company_id",
			"trans_no",
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
			"trans_date",
			"reference",
			"party_Ledger_id AS party_ledger_id",
			"against_ledger_id",
			"document_type_id",
			"document_type_code",
			"total_debit",
			"total_credit",
			"created_by",
			"company_id",
			"trans_no",
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
			"trans_date",
			"reference",
			"party_Ledger_id AS party_ledger_id",
			"against_ledger_id",
			"document_type_id",
			"document_type_code",
			"total_debit",
			"total_credit",
			"created_by",
			"company_id",
			"trans_no",
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
			"trans_no",
			"reference",
			"trans_date",
			"party_Ledger_id AS party_ledger_id",
			"against_ledger_id",
			"document_type_id",
			"document_type_code",
			"total_debit",
			"total_credit",
			"created_by",
			"company_id",
			"id" 
		];
	}
	

	/**
     * return superdashboardlist page fields of the model.
     * 
     * @return array
     */
	public static function superdashboardlistFields(){
		return [ 
			"transactions.id AS id",
			"transactions.trans_date AS trans_date",
			"transactions.reference AS reference",
			"transactions.party_Ledger_id AS party_ledger_id",
			"ledgers.ledger_name AS ledgers_ledger_name",
			"transactions.against_ledger_id AS against_ledger_id",
			"ledgers.ledger_name AS ledgers_ledger_name",
			"transactions.document_type_id AS document_type_id",
			"transactions.total_debit AS total_debit",
			"transactions.total_credit AS total_credit" 
		];
	}
	

	/**
     * return exportSuperdashboardlist page fields of the model.
     * 
     * @return array
     */
	public static function exportSuperdashboardlistFields(){
		return [ 
			"transactions.id AS id",
			"transactions.trans_date AS trans_date",
			"transactions.reference AS reference",
			"transactions.party_Ledger_id AS party_ledger_id",
			"ledgers.ledger_name AS ledgers_ledger_name",
			"transactions.against_ledger_id AS against_ledger_id",
			"ledgers.ledger_name AS ledgers_ledger_name",
			"transactions.document_type_id AS document_type_id",
			"transactions.total_debit AS total_debit",
			"transactions.total_credit AS total_credit" 
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
			"trans_date",
			"reference",
			"party_Ledger_id AS party_ledger_id",
			"against_ledger_id",
			"document_type_id",
			"document_type_code",
			"total_debit",
			"total_credit",
			"created_by",
			"trans_no" 
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
			"trans_date",
			"reference",
			"party_Ledger_id AS party_ledger_id",
			"against_ledger_id",
			"document_type_id",
			"document_type_code",
			"total_debit",
			"total_credit",
			"created_by",
			"trans_no" 
		];
	}
	

	/**
     * return adminedit page fields of the model.
     * 
     * @return array
     */
	public static function admineditFields(){
		return [ 
			"trans_no",
			"reference",
			"trans_date",
			"party_Ledger_id AS party_ledger_id",
			"against_ledger_id",
			"document_type_id",
			"document_type_code",
			"total_debit",
			"total_credit",
			"created_by",
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
