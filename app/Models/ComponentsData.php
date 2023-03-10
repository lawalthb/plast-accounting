<?php 
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
/**
 * Components data Model
 * Use for getting values from the database for page components
 * Support raw query builder
 * @category Model
 */
class ComponentsData{
	

	/**
     * document_code_option_list Model Action
     * @return array
     */
	function document_code_option_list(){
		$sqltext = "SELECT  DISTINCT document_code AS value,name AS label FROM document_types ORDER BY name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * document_types_document_code_option_list Model Action
     * @return array
     */
	function document_types_document_code_option_list(){
		$sqltext = "SELECT  DISTINCT document_code AS value,name AS label FROM document_types WHERE company_id=:comp_id ORDER BY name ASC" ;
		$query_params = [];
		$query_params['comp_id'] = 1;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * transactions_id_option_list Model Action
     * @return array
     */
	function transactions_id_option_list(){
		$sqltext = "SELECT id as value, id as label FROM transactions";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * company_id_option_list Model Action
     * @return array
     */
	function company_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM companies";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * customer_name_option_list Model Action
     * @return array
     */
	function customer_name_option_list(){
		$sqltext = "";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * sub_account_group_id_option_list Model Action
     * @return array
     */
	function sub_account_group_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM sub_account_group WHERE company_id=:comp_id" ;
		$query_params = [];
		$query_params['comp_id'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * marketer_id_option_list Model Action
     * @return array
     */
	function marketer_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM marketers";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * ledgers_sub_account_group_id_option_list Model Action
     * @return array
     */
	function ledgers_sub_account_group_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM sub_account_group WHERE code=2012 and  company_id=:comp" ;
		$query_params = [];
$query_params['comp'] =  auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * ledgers_marketer_id_option_list Model Action
     * @return array
     */
	function ledgers_marketer_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM marketers WHERE company_id=:comp" ;
		$query_params = [];
$query_params['comp'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * sub_account_group_id_option_list_2 Model Action
     * @return array
     */
	function sub_account_group_id_option_list_2(){
		$sqltext = "SELECT id as value, name as label FROM sub_account_group WHERE code = 2011 and company_id=:comp" ;
		$query_params = [];
		$query_params['comp'] =  auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * sub_account_group_id_option_list_3 Model Action
     * @return array
     */
	function sub_account_group_id_option_list_3(){
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM sub_account_group WHERE company_id=:comp_id ORDER BY name ASC" ;
		$query_params = [];
$query_params['comp_id'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * updated_by_option_list Model Action
     * @return array
     */
	function updated_by_option_list(){
		$sqltext = "SELECT id as value, firstname as label FROM users";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * role_id_option_list Model Action
     * @return array
     */
	function role_id_option_list(){
		$sqltext = "SELECT role_id as value, role_name as label FROM roles";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * permission_option_list Model Action
     * @return array
     */
	function permission_option_list(){
		$sqltext = "SELECT  DISTINCT permission AS value,permission AS label FROM permissions ORDER BY permission ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * product_categories_company_id_option_list Model Action
     * @return array
     */
	function product_categories_company_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM product_categories";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * category_option_list Model Action
     * @return array
     */
	function category_option_list(){
		$sqltext = "SELECT id as value, name as label FROM product_categories WHERE company_id=:comp_id" ;
		$query_params = [];
$query_params['comp_id'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * unit_option_list Model Action
     * @return array
     */
	function unit_option_list(){
		$sqltext = "SELECT id as value, name as label FROM units WHERE company_id=:comp_id" ;
		$query_params = [];
$query_params['comp_id'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * document_type_option_list Model Action
     * @return array
     */
	function document_type_option_list(){
		$sqltext = "SELECT id as value, id as label FROM main_documents";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * ledger_id_option_list Model Action
     * @return array
     */
	function ledger_id_option_list(){
		$sqltext = "SELECT id as value, ledger_name as label FROM ledgers";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * account_group_id_option_list Model Action
     * @return array
     */
	function account_group_id_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM account_groups ORDER BY name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * code_option_list Model Action
     * @return array
     */
	function code_option_list($value = null){
		$lookup_value = request()->lookup ?? $value;
		$sqltext = "SELECT  DISTINCT code AS value,code AS label FROM account_groups WHERE code=:lookup_code ORDER BY id ASC" ;
		$query_params = [];
		$query_params['lookup_code'] = $lookup_value;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * transaction_ledgers_ledger_id_option_list Model Action
     * @return array
     */
	function transaction_ledgers_ledger_id_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,ledger_name AS label FROM ledgers WHERE code !=2001 and  company_id=:comp_id  ORDER BY ledger_name ASC" ;
		$query_params = [];
		$query_params['comp_id'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * ledger_id_option_list_2 Model Action
     * @return array
     */
	function ledger_id_option_list_2(){
		$sqltext = "SELECT  DISTINCT id AS value,ledger_name AS label FROM ledgers WHERE (code =2001  or code =2002 or code =2003) and  company_id=:comp_id  ORDER BY ledger_name ASC" ;
		$query_params = [];
		$query_params['comp_id'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * ledger_id_option_list_3 Model Action
     * @return array
     */
	function ledger_id_option_list_3(){
		$sqltext = "SELECT  DISTINCT id AS value,ledger_name AS label FROM ledgers WHERE (code !=2001  and code !=2002 and code !=2003 and code !=2018) and  company_id=:comp_id  ORDER BY ledger_name ASC" ;
		$query_params = [];
		$query_params['comp_id'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * document_type_id_option_list Model Action
     * @return array
     */
	function document_type_id_option_list(){
		$sqltext = "SELECT id as value, name as label FROM document_types";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * party_ledger_id_option_list Model Action
     * @return array
     */
	function party_ledger_id_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,ledger_name AS label FROM ledgers WHERE company_id=:comp_id and (code =2001  or code =2002 or code =2003)  ORDER BY ledger_name ASC" ;
		$query_params = [];
		$query_params['comp_id'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * transactions_party_ledger_id_option_list Model Action
     * @return array
     */
	function transactions_party_ledger_id_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,ledger_name AS label FROM ledgers WHERE company_id=:comp_id and (code !=2001  and code !=2002 and code !=2003 and code !=2018)  ORDER BY ledger_name ASC" ;
		$query_params = [];
		$query_params['comp_id'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * Check if value already exist in Users table
	 * @param string $value
     * @return bool
     */
	function users_email_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('users')->where('email', $value)->value('email');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * Check if value already exist in Users table
	 * @param string $value
     * @return bool
     */
	function users_username_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('users')->where('username', $value)->value('username');   
		if($exist){
			return true;
		}
		return false;
	}
	

	/**
     * user_role_id_option_list Model Action
     * @return array
     */
	function user_role_id_option_list(){
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles" ;
		$query_params = [];
$query_params['comp_id'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * users_user_role_id_option_list Model Action
     * @return array
     */
	function users_user_role_id_option_list(){
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles" ;
		$query_params = [];
$query_params['id'] = '3';
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * user_role_id_option_list_2 Model Action
     * @return array
     */
	function user_role_id_option_list_2(){
		$sqltext = "SELECT role_id AS value, role_name AS label FROM roles" ;
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * document_types_company_id_option_list Model Action
     * @return array
     */
	function document_types_company_id_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM companies ORDER BY name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * git_insurance_driver_name_option_list Model Action
     * @return array
     */
	function git_insurance_driver_name_option_list(){
		$sqltext = "SELECT  DISTINCT driver_name AS value,driver_name AS label FROM git_insurance ORDER BY driver_name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * git_insurance_going_to_option_list Model Action
     * @return array
     */
	function git_insurance_going_to_option_list(){
		$sqltext = "SELECT  DISTINCT going_to AS value,going_to AS label FROM git_insurance ORDER BY going_to ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * ledgers_sub_account_group_id_option_list_2 Model Action
     * @return array
     */
	function ledgers_sub_account_group_id_option_list_2(){
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM sub_account_group where company_id=:comp ORDER BY name ASC" ;
		$query_params = [];
$query_params['comp'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * ledgers_sub_account_group_id_autofill Model Action
     * @return array
     */
	function ledgers_sub_account_group_id_autofill(){
		$sqltext = "SELECT code FROM sub_account_group WHERE id=:value" ;
		$query_params = [];
		$query_params['value'] = request()->get('value');
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * permissions_role_id_option_list Model Action
     * @return array
     */
	function permissions_role_id_option_list(){
		$sqltext = "SELECT  DISTINCT role_id AS value,role_name AS label FROM roles ORDER BY role_name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * permissions_role_id_option_list_2 Model Action
     * @return array
     */
	function permissions_role_id_option_list_2(){
		$sqltext = "SELECT  DISTINCT role_id AS value,role_name AS label FROM roles where role_id !=3 ORDER BY role_name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * products_category_option_list Model Action
     * @return array
     */
	function products_category_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM product_categories ORDER BY name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * products_category_option_list_2 Model Action
     * @return array
     */
	function products_category_option_list_2(){
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM product_categories WHERE company_id=:comp_id ORDER BY name ASC" ;
		$query_params = [];
		$query_params['comp_id'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * reportsid_list Model Action
     * @return array
     */
	function reportsid_list(){
		$sqltext = "SELECT id AS value, name AS label FROM reports GROUP BY id ORDER BY no_views DESC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * transactions_id_option_list_2 Model Action
     * @return array
     */
	function transactions_id_option_list_2(){
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM document_types ORDER BY name ASC";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * transactions_document_type_id_option_list Model Action
     * @return array
     */
	function transactions_document_type_id_option_list(){
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM document_types WHERE company_id=:comp_id ORDER BY name ASC" ;
		$query_params = [];
$query_params['comp_id'] = auth()->user()->company_id;
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * getcount_companies Model Action
     * @return int
     */
	function getcount_companies(){
		$sqltext = "SELECT COUNT(*) AS num FROM companies";
		$query_params = [];
		$val = DB::selectOne(DB::raw($sqltext), $query_params);
		return $val->num;
	}
	

	/**
     * getcount_users Model Action
     * @return int
     */
	function getcount_users(){
		$sqltext = "SELECT COUNT(*) AS num FROM users";
		$query_params = [];
		$val = DB::selectOne(DB::raw($sqltext), $query_params);
		return $val->num;
	}
	

	/**
     * getcount_transactions Model Action
     * @return int
     */
	function getcount_transactions(){
		$sqltext = "SELECT COUNT(*) AS num FROM transactions";
		$query_params = [];
		$val = DB::selectOne(DB::raw($sqltext), $query_params);
		return $val->num;
	}
	

	/**
     * getcount_products Model Action
     * @return int
     */
	function getcount_products(){
		$sqltext = "SELECT COUNT(*) AS num FROM products";
		$query_params = [];
		$val = DB::selectOne(DB::raw($sqltext), $query_params);
		return $val->num;
	}
	

	/**
     * getcount_locations Model Action
     * @return int
     */
	function getcount_locations(){
		$sqltext = "SELECT COUNT(*) AS num FROM locations";
		$query_params = [];
		$val = DB::selectOne(DB::raw($sqltext), $query_params);
		return $val->num;
	}
	

	/**
     * getcount_gitinsurance Model Action
     * @return int
     */
	function getcount_gitinsurance(){
		$sqltext = "SELECT COUNT(*) AS num FROM git_insurance";
		$query_params = [];
		$val = DB::selectOne(DB::raw($sqltext), $query_params);
		return $val->num;
	}
	

	/**
     * getcount_ledgers Model Action
     * @return int
     */
	function getcount_ledgers(){
		$sqltext = "SELECT COUNT(*) AS num FROM ledgers";
		$query_params = [];
		$val = DB::selectOne(DB::raw($sqltext), $query_params);
		return $val->num;
	}
	

	/**
     * getcount_documenttypes Model Action
     * @return int
     */
	function getcount_documenttypes(){
		$sqltext = "SELECT COUNT(*) AS num FROM document_types";
		$query_params = [];
		$val = DB::selectOne(DB::raw($sqltext), $query_params);
		return $val->num;
	}
}
