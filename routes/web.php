<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



	Route::get('', 'IndexController@index')->name('index')->middleware(['redirect.to.home']);
	Route::get('index/login', 'IndexController@login')->name('login');
	
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::any('auth/logout', 'AuthController@logout')->name('logout')->middleware(['auth']);

	Route::get('auth/accountcreated', 'AuthController@accountcreated')->name('accountcreated');
	Route::get('auth/accountpending', 'AuthController@accountpending')->name('accountpending');
	Route::get('auth/accountblocked', 'AuthController@accountblocked')->name('accountblocked');
	Route::get('auth/accountinactive', 'AuthController@accountinactive')->name('accountinactive');


	
	Route::get('companies/add', 'CompaniesController@add')->name('companies.add');
	Route::post('companies/add', 'CompaniesController@store')->name('companies.store');
		
	Route::get('auth/register', 'AuthController@register')->name('auth.register')->middleware(['redirect.to.home']);
	Route::post('auth/register', 'AuthController@register_store')->name('auth.register_store');
		
	Route::get('users/add', 'UsersController@add')->name('users.add');
	Route::post('users/add', 'UsersController@store')->name('users.store');
		
	Route::post('auth/login', 'AuthController@login')->name('auth.login');
	Route::get('auth/password/forgotpassword', 'AuthController@showForgotPassword')->name('password.forgotpassword');
	Route::post('auth/password/sendemail', 'AuthController@sendPasswordResetLink')->name('password.email');
	Route::get('auth/password/reset', 'AuthController@showResetPassword')->name('password.reset.token');
	Route::post('auth/password/resetpassword', 'AuthController@resetPassword')->name('password.resetpassword');
	Route::get('auth/password/resetcompleted', 'AuthController@passwordResetCompleted')->name('password.resetcompleted');
	Route::get('auth/password/linksent', 'AuthController@passwordResetLinkSent')->name('password.resetlinksent');
	
	Route::get('auth/email/showverifyemail', 'AuthController@showVerifyEmail')->name('verification.notice');
	Route::get('auth/email/verify', 'AuthController@verifyEmail')->name('verification.verify');
	Route::get('auth/email/verified', 'AuthController@emailVerified')->name('verification.verified');
	Route::get('auth/email/resend', 'AuthController@resendVerifyEmail')->name('verification.resend');
	

/**
 * All routes which requires auth
 */
Route::middleware(['auth', 'verified', 'rbac'])->group(function () {
		
	Route::get('home', 'HomeController@index')->name('home');

	

/* routes for Account_Groups Controller */	
	Route::get('account_groups', 'Account_GroupsController@index')->name('account_groups.index');
	Route::get('account_groups/index', 'Account_GroupsController@index')->name('account_groups.index');
	Route::get('account_groups/index/{filter?}/{filtervalue?}', 'Account_GroupsController@index')->name('account_groups.index');	
	Route::post('account_groups/importdata', 'Account_GroupsController@importdata');	
	Route::get('account_groups/view/{rec_id}', 'Account_GroupsController@view')->name('account_groups.view');
	Route::get('account_groups/masterdetail/{rec_id}', 'Account_GroupsController@masterDetail')->name('account_groups.masterdetail');	
	Route::get('account_groups/add', 'Account_GroupsController@add')->name('account_groups.add');
	Route::post('account_groups/add', 'Account_GroupsController@store')->name('account_groups.store');
		
	Route::any('account_groups/edit/{rec_id}', 'Account_GroupsController@edit')->name('account_groups.edit');	
	Route::get('account_groups/delete/{rec_id}', 'Account_GroupsController@delete');

/* routes for Audits Controller */	
	Route::get('audits', 'AuditsController@index')->name('audits.index');
	Route::get('audits/index', 'AuditsController@index')->name('audits.index');
	Route::get('audits/index/{filter?}/{filtervalue?}', 'AuditsController@index')->name('audits.index');	
	Route::get('audits/view/{rec_id}', 'AuditsController@view')->name('audits.view');

/* routes for Companies Controller */	
	Route::get('companies', 'CompaniesController@index')->name('companies.index');
	Route::get('companies/index', 'CompaniesController@index')->name('companies.index');
	Route::get('companies/index/{filter?}/{filtervalue?}', 'CompaniesController@index')->name('companies.index');	
	Route::get('companies/view/{rec_id}', 'CompaniesController@view')->name('companies.view');
	Route::get('companies/masterdetail/{rec_id}', 'CompaniesController@masterDetail')->name('companies.masterdetail');	
	Route::any('companies/edit/{rec_id}', 'CompaniesController@edit')->name('companies.edit');	
	Route::get('companies/delete/{rec_id}', 'CompaniesController@delete');	
	Route::get('companies/dashboardlist', 'CompaniesController@dashboardlist');
	Route::get('companies/dashboardlist/{filter?}/{filtervalue?}', 'CompaniesController@dashboardlist');

/* routes for Document_Types Controller */	
	Route::get('document_types', 'Document_TypesController@index')->name('document_types.index');
	Route::get('document_types/index', 'Document_TypesController@index')->name('document_types.index');
	Route::get('document_types/index/{filter?}/{filtervalue?}', 'Document_TypesController@index')->name('document_types.index');	
	Route::get('document_types/view/{rec_id}', 'Document_TypesController@view')->name('document_types.view');
	Route::get('document_types/masterdetail/{rec_id}', 'Document_TypesController@masterDetail')->name('document_types.masterdetail');	
	Route::get('document_types/add', 'Document_TypesController@add')->name('document_types.add');
	Route::post('document_types/add', 'Document_TypesController@store')->name('document_types.store');
		
	Route::any('document_types/edit/{rec_id}', 'Document_TypesController@edit')->name('document_types.edit');	
	Route::get('document_types/delete/{rec_id}', 'Document_TypesController@delete');	
	Route::get('document_types/adminlist', 'Document_TypesController@adminlist');
	Route::get('document_types/adminlist/{filter?}/{filtervalue?}', 'Document_TypesController@adminlist');	
	Route::get('document_types/adminadd', 'Document_TypesController@adminadd')->name('document_types.adminadd');
	Route::post('document_types/adminadd', 'Document_TypesController@adminadd_store')->name('document_types.adminadd_store');
	

/* routes for General_Descriptions Controller */	
	Route::get('general_descriptions', 'General_DescriptionsController@index')->name('general_descriptions.index');
	Route::get('general_descriptions/index', 'General_DescriptionsController@index')->name('general_descriptions.index');
	Route::get('general_descriptions/index/{filter?}/{filtervalue?}', 'General_DescriptionsController@index')->name('general_descriptions.index');	
	Route::post('general_descriptions/importdata', 'General_DescriptionsController@importdata');	
	Route::get('general_descriptions/view/{rec_id}', 'General_DescriptionsController@view')->name('general_descriptions.view');	
	Route::get('general_descriptions/add', 'General_DescriptionsController@add')->name('general_descriptions.add');
	Route::post('general_descriptions/add', 'General_DescriptionsController@store')->name('general_descriptions.store');
		
	Route::any('general_descriptions/edit/{rec_id}', 'General_DescriptionsController@edit')->name('general_descriptions.edit');	
	Route::get('general_descriptions/delete/{rec_id}', 'General_DescriptionsController@delete');

/* routes for Git_Customers Controller */	
	Route::get('git_customers', 'Git_CustomersController@index')->name('git_customers.index');
	Route::get('git_customers/index', 'Git_CustomersController@index')->name('git_customers.index');
	Route::get('git_customers/index/{filter?}/{filtervalue?}', 'Git_CustomersController@index')->name('git_customers.index');	
	Route::get('git_customers/view/{rec_id}', 'Git_CustomersController@view')->name('git_customers.view');	
	Route::get('git_customers/add', 'Git_CustomersController@add')->name('git_customers.add');
	Route::post('git_customers/add', 'Git_CustomersController@store')->name('git_customers.store');
		
	Route::any('git_customers/edit/{rec_id}', 'Git_CustomersController@edit')->name('git_customers.edit');Route::any('git_customers/editfield/{rec_id}', 'Git_CustomersController@editfield');	
	Route::get('git_customers/delete/{rec_id}', 'Git_CustomersController@delete');

/* routes for Git_Insurance Controller */	
	Route::get('git_insurance', 'Git_InsuranceController@index')->name('git_insurance.index');
	Route::get('git_insurance/index', 'Git_InsuranceController@index')->name('git_insurance.index');
	Route::get('git_insurance/index/{filter?}/{filtervalue?}', 'Git_InsuranceController@index')->name('git_insurance.index');	
	Route::get('git_insurance/view/{rec_id}', 'Git_InsuranceController@view')->name('git_insurance.view');	
	Route::get('git_insurance/add', 'Git_InsuranceController@add')->name('git_insurance.add');
	Route::post('git_insurance/add', 'Git_InsuranceController@store')->name('git_insurance.store');
		
	Route::any('git_insurance/edit/{rec_id}', 'Git_InsuranceController@edit')->name('git_insurance.edit');	
	Route::get('git_insurance/delete/{rec_id}', 'Git_InsuranceController@delete');	
	Route::get('git_insurance/adminlist', 'Git_InsuranceController@adminlist');
	Route::get('git_insurance/adminlist/{filter?}/{filtervalue?}', 'Git_InsuranceController@adminlist');

/* routes for Ledgers Controller */	
	Route::get('ledgers', 'LedgersController@index')->name('ledgers.index');
	Route::get('ledgers/index', 'LedgersController@index')->name('ledgers.index');
	Route::get('ledgers/index/{filter?}/{filtervalue?}', 'LedgersController@index')->name('ledgers.index');	
	Route::post('ledgers/importdata', 'LedgersController@importdata');	
	Route::get('ledgers/view/{rec_id}', 'LedgersController@view')->name('ledgers.view');
	Route::get('ledgers/masterdetail/{rec_id}', 'LedgersController@masterDetail')->name('ledgers.masterdetail');	
	Route::get('ledgers/add', 'LedgersController@add')->name('ledgers.add');
	Route::post('ledgers/add', 'LedgersController@store')->name('ledgers.store');
		
	Route::any('ledgers/edit/{rec_id}', 'LedgersController@edit')->name('ledgers.edit');	
	Route::get('ledgers/delete/{rec_id}', 'LedgersController@delete');	
	Route::get('ledgers/addcustomer', 'LedgersController@addcustomer')->name('ledgers.addcustomer');
	Route::post('ledgers/addcustomer', 'LedgersController@addcustomer_store')->name('ledgers.addcustomer_store');
		
	Route::get('ledgers/addsupplier', 'LedgersController@addsupplier')->name('ledgers.addsupplier');
	Route::post('ledgers/addsupplier', 'LedgersController@addsupplier_store')->name('ledgers.addsupplier_store');
		
	Route::get('ledgers/addotherledger', 'LedgersController@addotherledger')->name('ledgers.addotherledger');
	Route::post('ledgers/addotherledger', 'LedgersController@addotherledger_store')->name('ledgers.addotherledger_store');
		
	Route::get('ledgers/adminlist', 'LedgersController@adminlist');
	Route::get('ledgers/adminlist/{filter?}/{filtervalue?}', 'LedgersController@adminlist');

/* routes for Locations Controller */	
	Route::get('locations', 'LocationsController@index')->name('locations.index');
	Route::get('locations/index', 'LocationsController@index')->name('locations.index');
	Route::get('locations/index/{filter?}/{filtervalue?}', 'LocationsController@index')->name('locations.index');	
	Route::get('locations/view/{rec_id}', 'LocationsController@view')->name('locations.view');	
	Route::get('locations/add', 'LocationsController@add')->name('locations.add');
	Route::post('locations/add', 'LocationsController@store')->name('locations.store');
		
	Route::any('locations/edit/{rec_id}', 'LocationsController@edit')->name('locations.edit');Route::any('locations/editfield/{rec_id}', 'LocationsController@editfield');	
	Route::get('locations/delete/{rec_id}', 'LocationsController@delete');	
	Route::get('locations/adminlist', 'LocationsController@adminlist');
	Route::get('locations/adminlist/{filter?}/{filtervalue?}', 'LocationsController@adminlist');

/* routes for Marketers Controller */	
	Route::get('marketers', 'MarketersController@index')->name('marketers.index');
	Route::get('marketers/index', 'MarketersController@index')->name('marketers.index');
	Route::get('marketers/index/{filter?}/{filtervalue?}', 'MarketersController@index')->name('marketers.index');	
	Route::get('marketers/view/{rec_id}', 'MarketersController@view')->name('marketers.view');
	Route::get('marketers/masterdetail/{rec_id}', 'MarketersController@masterDetail')->name('marketers.masterdetail');	
	Route::get('marketers/add', 'MarketersController@add')->name('marketers.add');
	Route::post('marketers/add', 'MarketersController@store')->name('marketers.store');
		
	Route::any('marketers/edit/{rec_id}', 'MarketersController@edit')->name('marketers.edit');Route::any('marketers/editfield/{rec_id}', 'MarketersController@editfield');	
	Route::get('marketers/delete/{rec_id}', 'MarketersController@delete');	
	Route::get('marketers/adminlist', 'MarketersController@adminlist');
	Route::get('marketers/adminlist/{filter?}/{filtervalue?}', 'MarketersController@adminlist');

/* routes for Narrations Controller */	
	Route::get('narrations', 'NarrationsController@index')->name('narrations.index');
	Route::get('narrations/index', 'NarrationsController@index')->name('narrations.index');
	Route::get('narrations/index/{filter?}/{filtervalue?}', 'NarrationsController@index')->name('narrations.index');	
	Route::post('narrations/importdata', 'NarrationsController@importdata');	
	Route::get('narrations/view/{rec_id}', 'NarrationsController@view')->name('narrations.view');	
	Route::get('narrations/add', 'NarrationsController@add')->name('narrations.add');
	Route::post('narrations/add', 'NarrationsController@store')->name('narrations.store');
		
	Route::any('narrations/edit/{rec_id}', 'NarrationsController@edit')->name('narrations.edit');	
	Route::get('narrations/delete/{rec_id}', 'NarrationsController@delete');

/* routes for Options Controller */	
	Route::get('options', 'OptionsController@index')->name('options.index');
	Route::get('options/index', 'OptionsController@index')->name('options.index');
	Route::get('options/index/{filter?}/{filtervalue?}', 'OptionsController@index')->name('options.index');	
	Route::post('options/importdata', 'OptionsController@importdata');	
	Route::get('options/view/{rec_id}', 'OptionsController@view')->name('options.view');	
	Route::get('options/add', 'OptionsController@add')->name('options.add');
	Route::post('options/add', 'OptionsController@store')->name('options.store');
		
	Route::any('options/edit/{rec_id}', 'OptionsController@edit')->name('options.edit');	
	Route::get('options/delete/{rec_id}', 'OptionsController@delete');

/* routes for Permissions Controller */	
	Route::get('permissions', 'PermissionsController@index')->name('permissions.index');
	Route::get('permissions/index', 'PermissionsController@index')->name('permissions.index');
	Route::get('permissions/index/{filter?}/{filtervalue?}', 'PermissionsController@index')->name('permissions.index');	
	Route::get('permissions/view/{rec_id}', 'PermissionsController@view')->name('permissions.view');	
	Route::get('permissions/add', 'PermissionsController@add')->name('permissions.add');
	Route::post('permissions/add', 'PermissionsController@store')->name('permissions.store');
		
	Route::any('permissions/edit/{rec_id}', 'PermissionsController@edit')->name('permissions.edit');	
	Route::get('permissions/delete/{rec_id}', 'PermissionsController@delete');	
	Route::get('permissions/adminlist', 'PermissionsController@adminlist');
	Route::get('permissions/adminlist/{filter?}/{filtervalue?}', 'PermissionsController@adminlist');	
	Route::get('permissions/roleaddpermission', 'PermissionsController@roleaddpermission')->name('permissions.roleaddpermission');
	Route::post('permissions/roleaddpermission', 'PermissionsController@roleaddpermission_store')->name('permissions.roleaddpermission_store');
	

/* routes for Product_Categories Controller */	
	Route::get('product_categories', 'Product_CategoriesController@index')->name('product_categories.index');
	Route::get('product_categories/index', 'Product_CategoriesController@index')->name('product_categories.index');
	Route::get('product_categories/index/{filter?}/{filtervalue?}', 'Product_CategoriesController@index')->name('product_categories.index');	
	Route::post('product_categories/importdata', 'Product_CategoriesController@importdata');	
	Route::get('product_categories/view/{rec_id}', 'Product_CategoriesController@view')->name('product_categories.view');
	Route::get('product_categories/masterdetail/{rec_id}', 'Product_CategoriesController@masterDetail')->name('product_categories.masterdetail');	
	Route::get('product_categories/add', 'Product_CategoriesController@add')->name('product_categories.add');
	Route::post('product_categories/add', 'Product_CategoriesController@store')->name('product_categories.store');
		
	Route::any('product_categories/edit/{rec_id}', 'Product_CategoriesController@edit')->name('product_categories.edit');Route::any('product_categories/editfield/{rec_id}', 'Product_CategoriesController@editfield');	
	Route::get('product_categories/delete/{rec_id}', 'Product_CategoriesController@delete');	
	Route::get('product_categories/adminlist', 'Product_CategoriesController@adminlist');
	Route::get('product_categories/adminlist/{filter?}/{filtervalue?}', 'Product_CategoriesController@adminlist');

/* routes for Products Controller */	
	Route::get('products', 'ProductsController@index')->name('products.index');
	Route::get('products/index', 'ProductsController@index')->name('products.index');
	Route::get('products/index/{filter?}/{filtervalue?}', 'ProductsController@index')->name('products.index');	
	Route::get('products/view/{rec_id}', 'ProductsController@view')->name('products.view');	
	Route::get('products/add', 'ProductsController@add')->name('products.add');
	Route::post('products/add', 'ProductsController@store')->name('products.store');
		
	Route::any('products/edit/{rec_id}', 'ProductsController@edit')->name('products.edit');	
	Route::get('products/delete/{rec_id}', 'ProductsController@delete');	
	Route::get('products/superdashboardlist', 'ProductsController@superdashboardlist');
	Route::get('products/superdashboardlist/{filter?}/{filtervalue?}', 'ProductsController@superdashboardlist');	
	Route::get('products/adminlist', 'ProductsController@adminlist');
	Route::get('products/adminlist/{filter?}/{filtervalue?}', 'ProductsController@adminlist');	
	Route::get('products/adminview/{rec_id}', 'ProductsController@adminview')->name('products.adminview');

/* routes for Reports Controller */	
	Route::get('reports', 'ReportsController@index')->name('reports.index');
	Route::get('reports/index', 'ReportsController@index')->name('reports.index');
	Route::get('reports/index/{filter?}/{filtervalue?}', 'ReportsController@index')->name('reports.index');	
	Route::get('reports/view/{rec_id}', 'ReportsController@view')->name('reports.view');	
	Route::get('reports/add', 'ReportsController@add')->name('reports.add');
	Route::post('reports/add', 'ReportsController@store')->name('reports.store');
		
	Route::any('reports/edit/{rec_id}', 'ReportsController@edit')->name('reports.edit');	
	Route::get('reports/delete/{rec_id}', 'ReportsController@delete');	
	Route::get('reports/adminlist', 'ReportsController@adminlist');
	Route::get('reports/adminlist/{filter?}/{filtervalue?}', 'ReportsController@adminlist');

/* routes for Roles Controller */	
	Route::get('roles', 'RolesController@index')->name('roles.index');
	Route::get('roles/index', 'RolesController@index')->name('roles.index');
	Route::get('roles/index/{filter?}/{filtervalue?}', 'RolesController@index')->name('roles.index');	
	Route::get('roles/view/{rec_id}', 'RolesController@view')->name('roles.view');
	Route::get('roles/masterdetail/{rec_id}', 'RolesController@masterDetail')->name('roles.masterdetail');	
	Route::get('roles/add', 'RolesController@add')->name('roles.add');
	Route::post('roles/add', 'RolesController@store')->name('roles.store');
		
	Route::any('roles/edit/{rec_id}', 'RolesController@edit')->name('roles.edit');	
	Route::get('roles/delete/{rec_id}', 'RolesController@delete');	
	Route::get('roles/adminlist', 'RolesController@adminlist');
	Route::get('roles/adminlist/{filter?}/{filtervalue?}', 'RolesController@adminlist');

/* routes for Source_Documents Controller */	
	Route::get('source_documents', 'Source_DocumentsController@index')->name('source_documents.index');
	Route::get('source_documents/index', 'Source_DocumentsController@index')->name('source_documents.index');
	Route::get('source_documents/index/{filter?}/{filtervalue?}', 'Source_DocumentsController@index')->name('source_documents.index');	
	Route::post('source_documents/importdata', 'Source_DocumentsController@importdata');	
	Route::get('source_documents/view/{rec_id}', 'Source_DocumentsController@view')->name('source_documents.view');	
	Route::get('source_documents/add', 'Source_DocumentsController@add')->name('source_documents.add');
	Route::post('source_documents/add', 'Source_DocumentsController@store')->name('source_documents.store');
		
	Route::any('source_documents/edit/{rec_id}', 'Source_DocumentsController@edit')->name('source_documents.edit');	
	Route::get('source_documents/delete/{rec_id}', 'Source_DocumentsController@delete');

/* routes for Stocks Controller */	
	Route::get('stocks', 'StocksController@index')->name('stocks.index');
	Route::get('stocks/index', 'StocksController@index')->name('stocks.index');
	Route::get('stocks/index/{filter?}/{filtervalue?}', 'StocksController@index')->name('stocks.index');	
	Route::get('stocks/view/{rec_id}', 'StocksController@view')->name('stocks.view');	
	Route::get('stocks/add', 'StocksController@add')->name('stocks.add');
	Route::post('stocks/add', 'StocksController@store')->name('stocks.store');
		
	Route::any('stocks/edit/{rec_id}', 'StocksController@edit')->name('stocks.edit');	
	Route::get('stocks/delete/{rec_id}', 'StocksController@delete');

/* routes for Sub_Account_Group Controller */	
	Route::get('sub_account_group', 'Sub_Account_GroupController@index')->name('sub_account_group.index');
	Route::get('sub_account_group/index', 'Sub_Account_GroupController@index')->name('sub_account_group.index');
	Route::get('sub_account_group/index/{filter?}/{filtervalue?}', 'Sub_Account_GroupController@index')->name('sub_account_group.index');	
	Route::post('sub_account_group/importdata', 'Sub_Account_GroupController@importdata');	
	Route::get('sub_account_group/view/{rec_id}', 'Sub_Account_GroupController@view')->name('sub_account_group.view');
	Route::get('sub_account_group/masterdetail/{rec_id}', 'Sub_Account_GroupController@masterDetail')->name('sub_account_group.masterdetail');	
	Route::get('sub_account_group/add', 'Sub_Account_GroupController@add')->name('sub_account_group.add');
	Route::post('sub_account_group/add', 'Sub_Account_GroupController@store')->name('sub_account_group.store');
		
	Route::any('sub_account_group/edit/{rec_id}', 'Sub_Account_GroupController@edit')->name('sub_account_group.edit');	
	Route::get('sub_account_group/delete/{rec_id}', 'Sub_Account_GroupController@delete');

/* routes for Transaction_Ledgers Controller */	
	Route::get('transaction_ledgers', 'Transaction_LedgersController@index')->name('transaction_ledgers.index');
	Route::get('transaction_ledgers/index', 'Transaction_LedgersController@index')->name('transaction_ledgers.index');
	Route::get('transaction_ledgers/index/{filter?}/{filtervalue?}', 'Transaction_LedgersController@index')->name('transaction_ledgers.index');	
	Route::post('transaction_ledgers/importdata', 'Transaction_LedgersController@importdata');	
	Route::get('transaction_ledgers/view/{rec_id}', 'Transaction_LedgersController@view')->name('transaction_ledgers.view');	
	Route::get('transaction_ledgers/add', 'Transaction_LedgersController@add')->name('transaction_ledgers.add');
	Route::post('transaction_ledgers/add', 'Transaction_LedgersController@store')->name('transaction_ledgers.store');
		
	Route::any('transaction_ledgers/edit/{rec_id}', 'Transaction_LedgersController@edit')->name('transaction_ledgers.edit');	
	Route::get('transaction_ledgers/delete/{rec_id}', 'Transaction_LedgersController@delete');	
	Route::get('transaction_ledgers/add4receipt', 'Transaction_LedgersController@add4receipt')->name('transaction_ledgers.add4receipt');
	Route::post('transaction_ledgers/add4receipt', 'Transaction_LedgersController@add4receipt_store')->name('transaction_ledgers.add4receipt_store');
		
	Route::get('transaction_ledgers/add4payment', 'Transaction_LedgersController@add4payment')->name('transaction_ledgers.add4payment');
	Route::post('transaction_ledgers/add4payment', 'Transaction_LedgersController@add4payment_store')->name('transaction_ledgers.add4payment_store');
		
	Route::get('transaction_ledgers/add4contra', 'Transaction_LedgersController@add4contra')->name('transaction_ledgers.add4contra');
	Route::post('transaction_ledgers/add4contra', 'Transaction_LedgersController@add4contra_store')->name('transaction_ledgers.add4contra_store');
		
	Route::get('transaction_ledgers/add4credit', 'Transaction_LedgersController@add4credit')->name('transaction_ledgers.add4credit');
	Route::post('transaction_ledgers/add4credit', 'Transaction_LedgersController@add4credit_store')->name('transaction_ledgers.add4credit_store');
	

/* routes for Transaction_Products Controller */	
	Route::get('transaction_products', 'Transaction_ProductsController@index')->name('transaction_products.index');
	Route::get('transaction_products/index', 'Transaction_ProductsController@index')->name('transaction_products.index');
	Route::get('transaction_products/index/{filter?}/{filtervalue?}', 'Transaction_ProductsController@index')->name('transaction_products.index');	
	Route::post('transaction_products/importdata', 'Transaction_ProductsController@importdata');	
	Route::get('transaction_products/view/{rec_id}', 'Transaction_ProductsController@view')->name('transaction_products.view');	
	Route::get('transaction_products/add', 'Transaction_ProductsController@add')->name('transaction_products.add');
	Route::post('transaction_products/add', 'Transaction_ProductsController@store')->name('transaction_products.store');
		
	Route::any('transaction_products/edit/{rec_id}', 'Transaction_ProductsController@edit')->name('transaction_products.edit');	
	Route::get('transaction_products/delete/{rec_id}', 'Transaction_ProductsController@delete');

/* routes for Transactions Controller */	
	Route::get('transactions', 'TransactionsController@index')->name('transactions.index');
	Route::get('transactions/index', 'TransactionsController@index')->name('transactions.index');
	Route::get('transactions/index/{filter?}/{filtervalue?}', 'TransactionsController@index')->name('transactions.index');	
	Route::get('transactions/view/{rec_id}', 'TransactionsController@view')->name('transactions.view');
	Route::get('transactions/masterdetail/{rec_id}', 'TransactionsController@masterDetail')->name('transactions.masterdetail');	
	Route::get('transactions/add', 'TransactionsController@add')->name('transactions.add');
	Route::post('transactions/add', 'TransactionsController@store')->name('transactions.store');
		
	Route::any('transactions/edit/{rec_id}', 'TransactionsController@edit')->name('transactions.edit');	
	Route::get('transactions/delete/{rec_id}', 'TransactionsController@delete');	
	Route::get('transactions/superdashboardlist', 'TransactionsController@superdashboardlist');
	Route::get('transactions/superdashboardlist/{filter?}/{filtervalue?}', 'TransactionsController@superdashboardlist');	
	Route::get('transactions/adminlist', 'TransactionsController@adminlist');
	Route::get('transactions/adminlist/{filter?}/{filtervalue?}', 'TransactionsController@adminlist');	
	Route::any('transactions/adminedit/{rec_id}', 'TransactionsController@adminedit')->name('transactions.adminedit');	
	Route::get('transactions/addreceipt', 'TransactionsController@addreceipt')->name('transactions.addreceipt');
	Route::post('transactions/addreceipt', 'TransactionsController@addreceipt_store')->name('transactions.addreceipt_store');
		
	Route::get('transactions/add5014', 'TransactionsController@add5014')->name('transactions.add5014');
	Route::post('transactions/add5014', 'TransactionsController@add5014_store')->name('transactions.add5014_store');
		
	Route::get('transactions/add5011', 'TransactionsController@add5011')->name('transactions.add5011');
	Route::post('transactions/add5011', 'TransactionsController@add5011_store')->name('transactions.add5011_store');
		
	Route::get('transactions/add5005', 'TransactionsController@add5005')->name('transactions.add5005');
	Route::post('transactions/add5005', 'TransactionsController@add5005_store')->name('transactions.add5005_store');
		
	Route::get('transactions/add5006', 'TransactionsController@add5006')->name('transactions.add5006');
	Route::post('transactions/add5006', 'TransactionsController@add5006_store')->name('transactions.add5006_store');
	

/* routes for Units Controller */	
	Route::get('units', 'UnitsController@index')->name('units.index');
	Route::get('units/index', 'UnitsController@index')->name('units.index');
	Route::get('units/index/{filter?}/{filtervalue?}', 'UnitsController@index')->name('units.index');	
	Route::get('units/view/{rec_id}', 'UnitsController@view')->name('units.view');
	Route::get('units/masterdetail/{rec_id}', 'UnitsController@masterDetail')->name('units.masterdetail');	
	Route::get('units/add', 'UnitsController@add')->name('units.add');
	Route::post('units/add', 'UnitsController@store')->name('units.store');
		
	Route::any('units/edit/{rec_id}', 'UnitsController@edit')->name('units.edit');Route::any('units/editfield/{rec_id}', 'UnitsController@editfield');	
	Route::get('units/delete/{rec_id}', 'UnitsController@delete');	
	Route::get('units/adminlist', 'UnitsController@adminlist');
	Route::get('units/adminlist/{filter?}/{filtervalue?}', 'UnitsController@adminlist');

/* routes for Users Controller */	
	Route::get('users', 'UsersController@index')->name('users.index');
	Route::get('users/index', 'UsersController@index')->name('users.index');
	Route::get('users/index/{filter?}/{filtervalue?}', 'UsersController@index')->name('users.index');	
	Route::post('users/importdata', 'UsersController@importdata');	
	Route::get('users/view/{rec_id}', 'UsersController@view')->name('users.view');
	Route::get('users/masterdetail/{rec_id}', 'UsersController@masterDetail')->name('users.masterdetail');	
	Route::any('account/edit', 'AccountController@edit')->name('account.edit');	
	Route::get('account', 'AccountController@index');	
	Route::post('account/changepassword', 'AccountController@changepassword')->name('account.changepassword');	
	Route::any('users/edit/{rec_id}', 'UsersController@edit')->name('users.edit');	
	Route::get('users/delete/{rec_id}', 'UsersController@delete');	
	Route::get('users/adminlist', 'UsersController@adminlist');
	Route::get('users/adminlist/{filter?}/{filtervalue?}', 'UsersController@adminlist');	
	Route::get('users/adminadd', 'UsersController@adminadd')->name('users.adminadd');
	Route::post('users/adminadd', 'UsersController@adminadd_store')->name('users.adminadd_store');
		
	Route::any('users/adminedit/{rec_id}', 'UsersController@adminedit')->name('users.adminedit');	
Route::get('outpage',  function(Request $request){
		return view("pages.custom.outpage");
	}
);
	
Route::get('report',  function(Request $request){
		return view("pages.custom.report");
	}
);

});


	
Route::get('componentsdata/document_code_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->document_code_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/document_types_document_code_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->document_types_document_code_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/transactions_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->transactions_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/company_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->company_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/customer_name_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->customer_name_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/sub_account_group_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->sub_account_group_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/marketer_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->marketer_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/ledgers_sub_account_group_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->ledgers_sub_account_group_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/ledgers_marketer_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->ledgers_marketer_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/sub_account_group_id_option_list_2',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->sub_account_group_id_option_list_2($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/sub_account_group_id_option_list_3',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->sub_account_group_id_option_list_3($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/updated_by_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->updated_by_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/role_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->role_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/permission_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->permission_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/product_categories_company_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->product_categories_company_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/category_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->category_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/unit_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->unit_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/document_type_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->document_type_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/ledger_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->ledger_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/account_group_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->account_group_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/code_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->code_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/transaction_ledgers_ledger_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->transaction_ledgers_ledger_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/ledger_id_option_list_2',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->ledger_id_option_list_2($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/ledger_id_option_list_3',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->ledger_id_option_list_3($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/document_type_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->document_type_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/party_ledger_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->party_ledger_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/transactions_party_ledger_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->transactions_party_ledger_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/users_email_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_email_value_exist($request);
	}
);
	
Route::get('componentsdata/users_username_value_exist',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_username_value_exist($request);
	}
);
	
Route::get('componentsdata/user_role_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->user_role_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/users_user_role_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->users_user_role_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/user_role_id_option_list_2',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->user_role_id_option_list_2($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/document_types_company_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->document_types_company_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/git_insurance_driver_name_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->git_insurance_driver_name_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/git_insurance_going_to_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->git_insurance_going_to_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/ledgers_sub_account_group_id_option_list_2',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->ledgers_sub_account_group_id_option_list_2($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/ledgers_sub_account_group_id_autofill',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->ledgers_sub_account_group_id_autofill($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/permissions_role_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->permissions_role_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/permissions_role_id_option_list_2',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->permissions_role_id_option_list_2($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/products_category_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->products_category_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/products_category_option_list_2',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->products_category_option_list_2($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/reportsid_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->reportsid_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/transactions_id_option_list_2',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->transactions_id_option_list_2($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/transactions_document_type_id_option_list',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->transactions_document_type_id_option_list($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_companies',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_companies($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_users',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_users($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_transactions',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_transactions($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_products',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_products($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_locations',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_locations($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_gitinsurance',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_gitinsurance($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_ledgers',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_ledgers($request);
	}
)->middleware(['auth']);
	
Route::get('componentsdata/getcount_documenttypes',  function(Request $request){
		$compModel = new App\Models\ComponentsData();
		return $compModel->getcount_documenttypes($request);
	}
)->middleware(['auth']);


Route::post('fileuploader/upload/{fieldname}', 'FileUploaderController@upload');
Route::post('fileuploader/s3upload/{fieldname}', 'FileUploaderController@s3upload');
Route::post('fileuploader/remove_temp_file', 'FileUploaderController@remove_temp_file');


/**
 * All static content routes
 */
Route::get('info/about',  function(){
		return view("pages.info.about");
	}
);
Route::get('info/faq',  function(){
		return view("pages.info.faq");
	}
);

Route::get('info/contact',  function(){
	return view("pages.info.contact");
}
);
Route::get('info/contactsent',  function(){
	return view("pages.info.contactsent");
}
);

Route::post('info/contact',  function(Request $request){
		$request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);

		$senderName = $request->name;
		$senderEmail = $request->email;
		$message = $request->message;

		$receiverEmail = config("mail.from.address");

		Mail::send(
			'pages.info.contactemail', [
				'name' => $senderName,
				'email' => $senderEmail,
				'comment' => $message
			],
			function ($mail) use ($senderEmail, $receiverEmail) {
				$mail->from($senderEmail);
				$mail->to($receiverEmail)
					->subject('Contact Form');
			}
		);
		return redirect("info/contactsent");
	}
);


Route::get('info/features',  function(){
		return view("pages.info.features");
	}
);
Route::get('info/privacypolicy',  function(){
		return view("pages.info.privacypolicy");
	}
);
Route::get('info/termsandconditions',  function(){
		return view("pages.info.termsandconditions");
	}
);

Route::get('info/changelocale/{locale}', function ($locale) {
	app()->setlocale($locale);
	session()->put('locale', $locale);
    return redirect()->back();
})->name('info.changelocale');