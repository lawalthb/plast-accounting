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
     * Check if value already exist in Companies table
	 * @param string $value
     * @return bool
     */
	function companies_name_value_exist(Request $request){
		$value = trim($request->value);
		$exist = DB::table('companies')->where('name', $value)->value('name');   
		if($exist){
			return true;
		}
		return false;
	}
	

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
		$sqltext = "SELECT id as value, name as label FROM sub_account_group";
		$query_params = [];
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
		$sqltext = "SELECT id as value, name as label FROM sub_account_group WHERE code = 2014 and company_id=:comp" ;
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
		$sqltext = "SELECT id as value, name as label FROM sub_account_group WHERE code = 2013 and company_id=:comp" ;
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
		$sqltext = "SELECT id as value, name as label FROM sub_account_group WHERE company_id=:comp" ;
		$query_params = [];
		$query_params['comp'] =  auth()->user()->company_id;
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
     * category_option_list Model Action
     * @return array
     */
	function category_option_list(){
		$sqltext = "SELECT id as value, name as label FROM product_categories";
		$query_params = [];
		$arr = DB::select(DB::raw($sqltext), $query_params);
		return $arr;
	}
	

	/**
     * unit_option_list Model Action
     * @return array
     */
	function unit_option_list(){
		$sqltext = "SELECT id as value, name as label FROM units";
		$query_params = [];
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
     * user_id_option_list Model Action
     * @return array
     */
	function user_id_option_list(){
		$sqltext = "SELECT id as value, firstname as label FROM users";
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
