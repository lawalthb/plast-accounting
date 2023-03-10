
<?php
	class Menu{
		
	public static function navbarsideleft(){
		return [
		[
			'path' => 'home',
			'label' => __('dashboard'), 
			'icon' => '<i class="material-icons ">dashboard</i>'
		],
		
		[
			'path' => 'document_types/adminlist',
			'label' => __('entry'), 
			'icon' => '<i class="material-icons ">library_books</i>'
		],
		
		[
			'path' => 'transactions',
			'label' => __('transactions'), 
			'icon' => '<i class="material-icons ">assignment</i>'
		],
		
		[
			'path' => 'transactions/adminlist',
			'label' => __('transactions'), 
			'icon' => '<i class="material-icons ">assignment</i>'
		],
		
		[
			'path' => 'ledgers',
			'label' => __('ledgers'), 
			'icon' => '<i class="material-icons ">local_library</i>'
		],
		
		[
			'path' => 'ledgers/adminlist',
			'label' => __('ledgers'), 
			'icon' => '<i class="material-icons ">local_library</i>'
		],
		
		[
			'path' => 'products',
			'label' => __('products'), 
			'icon' => '<i class="material-icons ">settings_input_composite</i>'
		],
		
		[
			'path' => 'products/adminlist',
			'label' => __('products'), 
			'icon' => '<i class="material-icons ">settings_input_composite</i>'
		],
		
		[
			'path' => 'product_categories',
			'label' => __('productCategories'), 
			'icon' => '<i class="material-icons ">settings_input_hdmi</i>'
		],
		
		[
			'path' => 'product_categories/adminlist',
			'label' => __('productCategories'), 
			'icon' => '<i class="material-icons ">settings_input_hdmi</i>'
		],
		
		[
			'path' => 'units',
			'label' => __('units'), 
			'icon' => '<i class="material-icons ">art_track</i>'
		],
		
		[
			'path' => 'units/adminlist',
			'label' => __('units'), 
			'icon' => '<i class="material-icons ">art_track</i>'
		],
		
		[
			'path' => 'locations',
			'label' => __('locations'), 
			'icon' => '<i class="material-icons ">home</i>'
		],
		
		[
			'path' => 'locations/adminlist',
			'label' => __('locations'), 
			'icon' => '<i class="material-icons ">home</i>'
		],
		
		[
			'path' => 'marketers',
			'label' => __('marketers'), 
			'icon' => '<i class="material-icons ">group_add</i>'
		],
		
		[
			'path' => 'marketers/adminlist',
			'label' => __('marketers'), 
			'icon' => '<i class="material-icons ">group_add</i>'
		],
		
		[
			'path' => 'git_insurance',
			'label' => __('gitInsurance'), 
			'icon' => '<i class="material-icons ">drive_eta</i>'
		],
		
		[
			'path' => 'git_insurance/adminlist',
			'label' => __('gitInsurance'), 
			'icon' => '<i class="material-icons ">drive_eta</i>'
		],
		
		[
			'path' => 'users/adminlist',
			'label' => __('users'), 
			'icon' => '<i class="material-icons ">group</i>'
		],
		
		[
			'path' => 'menu31',
			'label' => __('users'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'document_types',
			'label' => __('documentTypes'), 
			'icon' => '<i class="material-icons ">library_books</i>'
		],
		
		[
			'path' => 'stocks',
			'label' => __('stocks'), 
			'icon' => '<i class="material-icons ">add_shopping_cart</i>'
		],
		
		[
			'path' => 'roles',
			'label' => __('roles'), 
			'icon' => '<i class="material-icons ">person_pin</i>'
		],
		
		[
			'path' => 'roles/adminlist',
			'label' => __('roles'), 
			'icon' => '<i class="material-icons ">person_pin</i>'
		],
		
		[
			'path' => 'permissions',
			'label' => __('permissions'), 
			'icon' => '<i class="material-icons ">assignment_ind</i>'
		],
		
		[
			'path' => 'permissions/adminlist',
			'label' => __('permissions'), 
			'icon' => '<i class="material-icons ">assignment_ind</i>'
		],
		
		[
			'path' => 'companies',
			'label' => __('companies'), 
			'icon' => '<i class="material-icons ">contacts</i>'
		],
		
		[
			'path' => 'options',
			'label' => __('options'), 
			'icon' => '<i class="material-icons ">tune</i>'
		],
		
		[
			'path' => 'sub_account_group',
			'label' => __('accountGroup'), 
			'icon' => '<i class="material-icons ">view_comfy</i>'
		],
		
		[
			'path' => 'reports/adminlist',
			'label' => __('reports'), 
			'icon' => '<i class="material-icons ">find_in_page</i>'
		],
		
		[
			'path' => 'reports',
			'label' => __('reports'), 
			'icon' => '<i class="material-icons ">find_in_page</i>'
		],
		
		[
			'path' => 'audits',
			'label' => __('audits'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'report',
			'label' => __('reportPage'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'auth/logout',
			'label' => __('logOut'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_left</i>'
		],
		
		[
			'path' => 'transactions/addreceipt',
			'label' => __('addreceipt'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'transaction_ledgers/add4receipt',
			'label' => __('add4receipt'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'transactions/add5014',
			'label' => __('add5014'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'transactions/add5011',
			'label' => __('add5011'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'transaction_ledgers/add4payment',
			'label' => __('add4payment'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'transactions/add5005',
			'label' => __('add5005'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'transaction_ledgers/add4contra',
			'label' => __('add4contra'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'transactions/add5006',
			'label' => __('add5006'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'transaction_ledgers/add4credit',
			'label' => __('add4credit'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'transactions/add5007',
			'label' => __('add5007'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'transaction_ledgers/add4debit',
			'label' => __('add4debit'), 
			'icon' => '<i class="material-icons">extension</i>'
		]
	] ;
	}
	
	public static function navbartopleft(){
		return [
		[
			'path' => 'companies',
			'label' => __('viewCompanies'), 
			'icon' => '<i class="material-icons ">contacts</i>'
		],
		
		[
			'path' => 'transactions/adminlist',
			'label' => __('transactions'), 
			'icon' => '<i class="material-icons ">assignment</i>'
		]
	] ;
	}
	
	public static function navbartopright(){
		return [
		[
			'path' => 'options',
			'label' => __('options'), 
			'icon' => '<i class="material-icons ">settings</i>'
		]
	] ;
	}
	
		
	public static function method_numbering(){
		return [
		[
			'value' => 'Automatic', 
			'label' => __('automatic'), 
		],
		[
			'value' => 'Manual', 
			'label' => __('manual'), 
		],
		[
			'value' => 'None', 
			'label' => __('none'), 
		],] ;
	}
	
	public static function prefix(){
		return [
		[
			'value' => 'No', 
			'label' => __('no'), 
		],
		[
			'value' => 'Yes', 
			'label' => __('yes'), 
		],] ;
	}
	
	public static function common_description(){
		return [
		[
			'value' => 'Yes', 
			'label' => __('yes'), 
		],
		[
			'value' => 'No', 
			'label' => __('no'), 
		],] ;
	}
	
	public static function status(){
		return [
		[
			'value' => '1', 
			'label' => __('yes'), 
		],
		[
			'value' => '0', 
			'label' => __('no'), 
		],] ;
	}
	
	}
