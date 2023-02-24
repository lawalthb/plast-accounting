
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
			'path' => 'transactions',
			'label' => __('transactions'), 
			'icon' => '<i class="material-icons ">description</i>'
		],
		
		[
			'path' => 'transactions/adminlist',
			'label' => __('transactions'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'ledgers',
			'label' => __('ledgers'), 
			'icon' => '<i class="material-icons ">local_library</i>'
		],
		
		[
			'path' => 'products',
			'label' => __('products'), 
			'icon' => '<i class="material-icons ">settings_input_composite</i>'
		],
		
		[
			'path' => 'product_categories',
			'label' => __('productCategories'), 
			'icon' => '<i class="material-icons ">settings_input_hdmi</i>'
		],
		
		[
			'path' => 'units',
			'label' => __('units'), 
			'icon' => '<i class="material-icons ">art_track</i>'
		],
		
		[
			'path' => 'locations',
			'label' => __('locations'), 
			'icon' => '<i class="material-icons ">home</i>'
		],
		
		[
			'path' => 'marketers',
			'label' => __('marketers'), 
			'icon' => '<i class="material-icons ">group_add</i>'
		],
		
		[
			'path' => 'git_insurance',
			'label' => __('gitInsurance'), 
			'icon' => '<i class="material-icons ">drive_eta</i>'
		],
		
		[
			'path' => 'users',
			'label' => __('users'), 
			'icon' => '<i class="material-icons ">group</i>'
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
			'path' => 'permissions',
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
			'path' => 'auth/logout',
			'label' => __('logOut'), 
			'icon' => '<i class="material-icons ">subdirectory_arrow_left</i>'
		],
		
		[
			'path' => 'ledgers/adminlist',
			'label' => __('adminlist'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'audits',
			'label' => __('audits'), 
			'icon' => '<i class="material-icons">extension</i>'
		],
		
		[
			'path' => 'reports',
			'label' => __('reports'), 
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
			'icon' => '<i class="material-icons">extension</i>'
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
