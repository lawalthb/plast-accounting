<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("permissions/add");
    $can_edit = $user->canAccess("permissions/edit");
    $can_view = $user->canAccess("permissions/view");
    $can_delete = $user->canAccess("permissions/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $permissions_role_id_option_list = $comp_model->permissions_role_id_option_list();
    $permission_option_list = $comp_model->permission_option_list();
    $document_types_company_id_option_list = $comp_model->document_types_company_id_option_list();
    $pageTitle = __('permissions'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">
                <div class="col col-md-auto  " >
                    <div class=" h5 font-weight-bold text-primary" >
                        {{ __('permissions') }}
                    </div>
                </div>
                <div class="col-md-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary" href="<?php print_link("permissions/add", true) ?>" >
                    <i class="material-icons">add</i>                               
                    {{ __('addNewPermissions') }} 
                </a>
                <?php } ?>
            </div>
            <div class="col-md-3  " >
                <!-- Page drop down search component -->
                <form  class="search" action="{{ url()->current() }}" method="get">
                    <input type="hidden" name="page" value="1" />
                    <div class="input-group">
                        <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="{{ __('search') }}" />
                        <button class="btn btn-primary"><i class="material-icons">search</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-2 comp-grid " >
                <form method="get" action="" class="form">
                    <div class="q-mb-sm q-pa-sm sticky-top" >
                        <?php $menu_id = "menu-" . random_str(); ?>
                        <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="h4">Filter by Role</div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#<?php echo $menu_id ?>" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        </nav>
                        <div class="collapse collapse-lg " id="<?php echo $menu_id ?>" >
                        <ul class="nav nav-pills flex-column nav-justified">
                            <?php 
                                $options = $permissions_role_id_option_list ?? [];
                                foreach($options as $option){
                                $value = $option->value;
                                $label = $option->label ?? $value;
                                $nav_link = add_query_params(['permissions_role_id' => $value] , false);
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo is_active_link('permissions_role_id', $value); ?>" href="<?php print_link($nav_link) ?>">
                                <?php echo $label; ?>
                            </a>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="q-mb-sm q-pa-sm ">
                <label class="fw-bold p-2">Filter by Permission</label>
                <select   name="permissions_permission" class="form-select custom " >
                <option value="">{{ __('selectAPermission') }}</option>
                <?php 
                    $options = $permission_option_list ?? [];
                    foreach($options as $option){
                    $value = $option->value;
                    $label = $option->label ?? $value;
                    $selected = Html::get_field_selected('permissions_permission', $value);
                ?>
                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                <?php echo $label; ?>
                </option>
                <?php
                    }
                ?>
                </select>
            </div>
            <div class="dropdown">
                <button class="btn  btn- dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </button>
                <div class="dropdown-menu" >
                    <?php 
                        $options = $document_types_company_id_option_list ?? [];
                        foreach($options as $option){
                        $value = $option->value;
                        $label = $option->label;
                        $nav_link = add_query_params(['permissions_company_id' => $value]);
                    ?>
                    <a class="dropdown-item <?php echo is_active_link('permissions_company_id', $value); ?>" href="<?php print_link($nav_link) ?>">
                    <?php echo $label; ?>
                </a>
                <?php
                    }
                ?>
            </div>
        </div>
        <hr />
        <div class="form-group text-center">
            <button class="btn btn-primary">Filter</button>
        </div>
    </form>
</div>
<div class="col-10 comp-grid " >
    <?php Html::display_page_errors($errors); ?>
    <div class="filter-tags mb-2">
        <?php
            Html::filter_tag('permissions_role_id', 'Role Name', $permissions_role_id_option_list);
        ?>
        <?php
            Html::filter_tag('permissions_permission', 'Permission', $permission_option_list);
        ?>
        <?php
            Html::filter_tag('permissions_company_id', 'Company', $document_types_company_id_option_list);
        ?>
    </div>
    <div  class=" page-content" >
        <div id="permissions-list-records">
            <div id="page-main-content" class="table-responsive">
                <?php Html::page_bread_crumb("/permissions/", $field_name, $field_value); ?>
                <table class="table table-hover table-striped table-sm text-left">
                    <thead class="table-header ">
                        <tr>
                            <?php if($can_delete){ ?>
                            <th class="td-checkbox">
                            <label class="form-check-label">
                            <input class="toggle-check-all form-check-input" type="checkbox" />
                            </label>
                            </th>
                            <?php } ?>
                            <th class="td-permission_id <?php echo (get_value('orderby') == 'permission_id' ? 'sortedby' : null); ?>" >
                            <?php Html :: get_field_order_link('permission_id', __('permissionId'), ''); ?>
                            </th>
                            <th class="td-permission <?php echo (get_value('orderby') == 'permission' ? 'sortedby' : null); ?>" >
                            <?php Html :: get_field_order_link('permission', __('permission'), ''); ?>
                            </th>
                            <th class="td-role_id <?php echo (get_value('orderby') == 'role_id' ? 'sortedby' : null); ?>" >
                            <?php Html :: get_field_order_link('role_id', __('roleId'), ''); ?>
                            </th>
                            <th class="td-company_id <?php echo (get_value('orderby') == 'company_id' ? 'sortedby' : null); ?>" >
                            <?php Html :: get_field_order_link('company_id', __('companyId'), ''); ?>
                            </th>
                            <th class="td-date_created <?php echo (get_value('orderby') == 'date_created' ? 'sortedby' : null); ?>" >
                            <?php Html :: get_field_order_link('date_created', __('dateCreated'), ''); ?>
                            </th>
                            <th class="td-date_updated <?php echo (get_value('orderby') == 'date_updated' ? 'sortedby' : null); ?>" >
                            <?php Html :: get_field_order_link('date_updated', __('dateUpdated'), ''); ?>
                            </th>
                            <th class="td-btn"></th>
                        </tr>
                    </thead>
                    <?php
                        if($total_records){
                    ?>
                    <tbody class="page-data">
                        <!--record-->
                        <?php
                            $counter = 0;
                            foreach($records as $data){
                            $rec_id = ($data['permission_id'] ? urlencode($data['permission_id']) : null);
                            $counter++;
                        ?>
                        <tr>
                            <?php if($can_delete){ ?>
                            <td class=" td-checkbox">
                                <label class="form-check-label">
                                <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['permission_id'] ?>" type="checkbox" />
                                </label>
                            </td>
                            <?php } ?>
                            <!--PageComponentStart-->
                            <td class="td-permission_id">
                                <a href="<?php print_link("permissions/view/$data[permission_id]") ?>"><?php echo $data['permission_id']; ?></a>
                            </td>
                            <td class="td-permission">
                                <?php echo  $data['permission'] ; ?>
                            </td>
                            <td class="td-role_id">
                                <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("roles/view/$data[role_id]?subpage=1") ?>">
                                <i class="material-icons">visibility</i> <?php echo $data['roles_role_name'] ?>
                            </a>
                        </td>
                        <td class="td-company_id">
                            <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("companies/view/$data[company_id]?subpage=1") ?>">
                            <i class="material-icons">visibility</i> <?php echo "Companies" ?>
                        </a>
                    </td>
                    <td class="td-date_created">
                        <?php echo  $data['date_created'] ; ?>
                    </td>
                    <td class="td-date_updated">
                        <?php echo  $data['date_updated'] ; ?>
                    </td>
                    <!--PageComponentEnd-->
                    <td class="td-btn">
                        <?php if($can_view){ ?>
                        <a class="btn btn-sm btn-primary has-tooltip "    href="<?php print_link("permissions/view/$rec_id"); ?>" >
                        <i class="material-icons">visibility</i> {{ __('view') }}
                    </a>
                    <?php } ?>
                    <?php if($can_edit){ ?>
                    <a class="btn btn-sm btn-success has-tooltip "    href="<?php print_link("permissions/edit/$rec_id"); ?>" >
                    <i class="material-icons">edit</i> {{ __('edit') }}
                </a>
                <?php } ?>
                <?php if($can_delete){ ?>
                <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal"  href="<?php print_link("permissions/delete/$rec_id"); ?>" >
                <i class="material-icons">delete_sweep</i> {{ __('delete') }}
            </a>
            <?php } ?>
        </td>
    </tr>
    <?php 
        }
    ?>
    <!--endrecord-->
</tbody>
<tbody class="search-data"></tbody>
<?php
    }
    else{
?>
<tbody class="page-data">
    <tr>
        <td class="bg-light text-center text-muted animated bounce p-3" colspan="1000">
            <i class="material-icons">block</i> {{ __('noRecordFound') }}
        </td>
    </tr>
</tbody>
<?php
    }
?>
</table>
</div>
<?php
    if($show_footer){
?>
<div class=" mt-3">
    <div class="row align-items-center justify-content-between">    
        <div class="col-md-auto justify-content-center">    
            <div class="d-flex justify-content-start">  
                <?php if($can_delete){ ?>
                <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("permissions/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                <i class="material-icons">delete_sweep</i> {{ __('deleteSelected') }}
                </button>
                <?php } ?>
            </div>
        </div>
        <div class="col">   
            <?php
                if($show_pagination == true){
                $pager = new Pagination($total_records, $record_count);
                $pager->show_page_count = false;
                $pager->show_record_count = true;
                $pager->show_page_limit =false;
                $pager->limit = $limit;
                $pager->show_page_number_list = true;
                $pager->pager_link_range=5;
                $pager->render();
                }
            ?>
        </div>
    </div>
</div>
<?php
    }
?>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
@endsection
<!-- Page custom css -->
@section('pagecss')
<style>

</style>
@endsection
<!-- Page custom js -->
@section('pagejs')
<script>
    <!--pageautofill-->
$(document).ready(function(){
	// custom javascript | jquery codes
});

</script>
@endsection
