<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Contracts\Auditable;
class Products extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	

	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'products';
	

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
		'company_id','category','unit','name','qty','selling_price','purchase_price','mfg_date','exp_date','dead_stock','is_active','image','user_id'
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
				products.name LIKE ? 
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
			"products.id AS id",
			"products.company_id AS company_id",
			"companies.name AS companies_name",
			"products.name AS name",
			"products.category AS category",
			"product_categories.name AS product_categories_name",
			"products.qty AS qty",
			"products.selling_price AS selling_price",
			"products.purchase_price AS purchase_price",
			"products.dead_stock AS dead_stock",
			"products.is_active AS is_active",
			"products.user_id AS user_id",
			"users.username AS users_username",
			"products.unit AS unit",
			"units.name AS units_name",
			"products.date_created AS date_created",
			"products.date_updated AS date_updated" 
		];
	}
	

	/**
     * return exportList page fields of the model.
     * 
     * @return array
     */
	public static function exportListFields(){
		return [ 
			"products.id AS id",
			"products.company_id AS company_id",
			"companies.name AS companies_name",
			"products.name AS name",
			"products.category AS category",
			"product_categories.name AS product_categories_name",
			"products.qty AS qty",
			"products.selling_price AS selling_price",
			"products.purchase_price AS purchase_price",
			"products.dead_stock AS dead_stock",
			"products.is_active AS is_active",
			"products.user_id AS user_id",
			"users.username AS users_username",
			"products.unit AS unit",
			"units.name AS units_name",
			"products.date_created AS date_created",
			"products.date_updated AS date_updated" 
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
			"name",
			"category",
			"image",
			"mfg_date",
			"exp_date",
			"qty",
			"selling_price",
			"purchase_price",
			"dead_stock",
			"is_active",
			"user_id",
			"unit",
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
			"name",
			"category",
			"image",
			"mfg_date",
			"exp_date",
			"qty",
			"selling_price",
			"purchase_price",
			"dead_stock",
			"is_active",
			"user_id",
			"unit",
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
			"category",
			"unit",
			"name",
			"qty",
			"selling_price",
			"purchase_price",
			"mfg_date",
			"exp_date",
			"dead_stock",
			"is_active",
			"image",
			"user_id",
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
			"products.id AS id",
			"products.name AS name",
			"products.category AS category",
			"product_categories.name AS product_categories_name",
			"products.qty AS qty",
			"products.selling_price AS selling_price",
			"products.user_id AS user_id",
			"users.username AS users_username",
			"products.company_id AS company_id",
			"companies.name AS companies_name",
			"units.name AS units_name" 
		];
	}
	

	/**
     * return exportSuperdashboardlist page fields of the model.
     * 
     * @return array
     */
	public static function exportSuperdashboardlistFields(){
		return [ 
			"products.id AS id",
			"products.name AS name",
			"products.category AS category",
			"product_categories.name AS product_categories_name",
			"products.qty AS qty",
			"products.selling_price AS selling_price",
			"products.user_id AS user_id",
			"users.username AS users_username",
			"products.company_id AS company_id",
			"companies.name AS companies_name",
			"units.name AS units_name" 
		];
	}
	

	/**
     * return adminlist page fields of the model.
     * 
     * @return array
     */
	public static function adminlistFields(){
		return [ 
			"products.id AS id",
			"products.company_id AS company_id",
			"companies.name AS companies_name",
			"products.name AS name",
			"products.category AS category",
			"product_categories.name AS product_categories_name",
			"products.qty AS qty",
			"products.selling_price AS selling_price",
			"products.purchase_price AS purchase_price",
			"products.dead_stock AS dead_stock",
			"products.is_active AS is_active",
			"products.user_id AS user_id",
			"users.username AS users_username",
			"products.unit AS unit",
			"units.name AS units_name",
			"products.date_created AS date_created",
			"products.date_updated AS date_updated" 
		];
	}
	

	/**
     * return exportAdminlist page fields of the model.
     * 
     * @return array
     */
	public static function exportAdminlistFields(){
		return [ 
			"products.id AS id",
			"products.company_id AS company_id",
			"companies.name AS companies_name",
			"products.name AS name",
			"products.category AS category",
			"product_categories.name AS product_categories_name",
			"products.qty AS qty",
			"products.selling_price AS selling_price",
			"products.purchase_price AS purchase_price",
			"products.dead_stock AS dead_stock",
			"products.is_active AS is_active",
			"products.user_id AS user_id",
			"users.username AS users_username",
			"products.unit AS unit",
			"units.name AS units_name",
			"products.date_created AS date_created",
			"products.date_updated AS date_updated" 
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
