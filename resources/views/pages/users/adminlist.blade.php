<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("users/add");
    $can_edit = $user->canAccess("users/edit");
    $can_view = $user->canAccess("users/view");
    $can_delete = $user->canAccess("users/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = __('users'); //set dynamic page title
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
                        {{ __('users') }}
                    </div>
                </div>
                <div class="col-md-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary" href="<?php print_link("users/add", true) ?>" >
                    <i class="material-icons">add</i>                               
                    {{ __('addNewUsers') }} 
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
            <div class="col-md-12 comp-grid " >
                <?php Html::display_page_errors($errors); ?>
                <div  class=" page-content" >
                    <div id="users-adminlist-records">
                        <div class="row gutter-lg ">
                            <div class="col">
                                <div id="page-main-content" class="table-responsive">
                                    <?php Html::page_bread_crumb("/users/adminlist", $field_name, $field_value); ?>
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
                                                <th class="td-" > </th>
                                                <th class="td-id <?php echo (get_value('orderby') == 'id' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('id', __('id'), ''); ?>
                                                </th>
                                                <th class="td-firstname <?php echo (get_value('orderby') == 'firstname' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('firstname', __('firstname'), ''); ?>
                                                </th>
                                                <th class="td-lastname <?php echo (get_value('orderby') == 'lastname' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('lastname', __('lastname'), ''); ?>
                                                </th>
                                                <th class="td-email <?php echo (get_value('orderby') == 'email' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('email', __('email'), ''); ?>
                                                </th>
                                                <th class="td-role_id <?php echo (get_value('orderby') == 'role_id' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('role_id', __('roleId'), ''); ?>
                                                </th>
                                                <th class="td-phone <?php echo (get_value('orderby') == 'phone' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('phone', __('phone'), ''); ?>
                                                </th>
                                                <th class="td-photo <?php echo (get_value('orderby') == 'photo' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('photo', __('photo'), ''); ?>
                                                </th>
                                                <th class="td-user_type <?php echo (get_value('orderby') == 'user_type' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('user_type', __('userType'), ''); ?>
                                                </th>
                                                <th class="td-date_join <?php echo (get_value('orderby') == 'date_join' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('date_join', __('dateJoin'), ''); ?>
                                                </th>
                                                <th class="td-is_active <?php echo (get_value('orderby') == 'is_active' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('is_active', __('isActive'), ''); ?>
                                                </th>
                                                <th class="td-company_id <?php echo (get_value('orderby') == 'company_id' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('company_id', __('companyId'), ''); ?>
                                                </th>
                                                <th class="td-username <?php echo (get_value('orderby') == 'username' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('username', __('username'), ''); ?>
                                                </th>
                                                <th class="td-email_verified_at <?php echo (get_value('orderby') == 'email_verified_at' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('email_verified_at', __('emailVerifiedAt'), ''); ?>
                                                </th>
                                                <th class="td-user_role_id <?php echo (get_value('orderby') == 'user_role_id' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('user_role_id', __('userRoleId'), ''); ?>
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
                                                $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                                $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <td class=" td-checkbox">
                                                    <label class="form-check-label">
                                                    <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                                    </label>
                                                </td>
                                                <?php } ?>
                                                <!--PageComponentStart-->
                                                <td class="td-masterdetailbtn">
                                                    <a data-page-id="users-detail-page" class="btn btn-sm btn-secondary open-master-detail-page" href="<?php print_link("users/masterdetail/$data[id]"); ?>">
                                                    <i class="material-icons">more_vert</i> 
                                                </a>
                                            </td>
                                            <td class="td-id">
                                                <a href="<?php print_link("users/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                            </td>
                                            <td class="td-firstname">
                                                <?php echo  $data['firstname'] ; ?>
                                            </td>
                                            <td class="td-lastname">
                                                <?php echo  $data['lastname'] ; ?>
                                            </td>
                                            <td class="td-email">
                                                <a href="<?php print_link("mailto:$data[email]") ?>"><?php echo $data['email']; ?></a>
                                            </td>
                                            <td class="td-role_id">
                                                <?php echo  $data['role_id'] ; ?>
                                            </td>
                                            <td class="td-phone">
                                                <a href="<?php print_link("tel:$data[phone]") ?>"><?php echo $data['phone']; ?></a>
                                            </td>
                                            <td class="td-photo">
                                                <?php 
                                                    Html :: page_img($data['photo'], '50px', '50px', "small", 1); 
                                                ?>
                                            </td>
                                            <td class="td-user_type">
                                                <?php echo  $data['user_type'] ; ?>
                                            </td>
                                            <td class="td-date_join">
                                                <?php echo  $data['date_join'] ; ?>
                                            </td>
                                            <td class="td-is_active">
                                                <?php echo  $data['is_active'] ; ?>
                                            </td>
                                            <td class="td-company_id">
                                                <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("companies/view/$data[company_id]?subpage=1") ?>">
                                                <i class="material-icons">visibility</i> <?php echo "Companies" ?>
                                            </a>
                                        </td>
                                        <td class="td-username">
                                            <?php echo  $data['username'] ; ?>
                                        </td>
                                        <td class="td-email_verified_at">
                                            <a href="<?php print_link("mailto:$data[email_verified_at]") ?>"><?php echo $data['email_verified_at']; ?></a>
                                        </td>
                                        <td class="td-user_role_id">
                                            <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("roles/view/$data[user_role_id]?subpage=1") ?>">
                                            <i class="material-icons">visibility</i> <?php echo "Roles" ?>
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
                                        <div class="dropdown" >
                                            <button data-bs-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                            <i class="material-icons">menu</i> 
                                            </button>
                                            <ul class="dropdown-menu">
                                                <?php if($can_view){ ?>
                                                <a class="dropdown-item "   href="<?php print_link("users/view/$rec_id"); ?>" >
                                                <i class="material-icons">visibility</i> {{ __('view') }}
                                            </a>
                                            <?php } ?>
                                            <?php if($can_edit){ ?>
                                            <a class="dropdown-item "   href="<?php print_link("users/edit/$rec_id"); ?>" >
                                            <i class="material-icons">edit</i> {{ __('edit') }}
                                        </a>
                                        <?php } ?>
                                        <?php if($can_delete){ ?>
                                        <a class="dropdown-item record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal" href="<?php print_link("users/delete/$rec_id"); ?>" >
                                        <i class="material-icons">delete_sweep</i> {{ __('delete') }}
                                    </a>
                                    <?php } ?>
                                </ul>
                            </div>
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
                        <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("users/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                        <i class="material-icons">delete_sweep</i> {{ __('deleteSelected') }}
                        </button>
                        <?php } ?>
                        <div class="dropup export-btn-holder mx-1">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">save</i> 
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <?php $export_print_link = add_query_params(['export' => 'print']); ?>
                                <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                <img src="{{ asset('images/print.png') }}" class="mr-2" /> PRINT
                            </a>
                            <?php $export_pdf_link = add_query_params(['export' => 'pdf']); ?>
                            <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                            <img src="{{ asset('images/pdf.png') }}" class="mr-2" /> PDF
                        </a>
                        <?php $export_csv_link = add_query_params(['export' => 'csv']); ?>
                        <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                        <img src="{{ asset('/images/csv.png') }}" class="mr-2" /> CSV
                    </a>
                    <?php $export_excel_link = add_query_params(['export' => 'excel']); ?>
                    <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                    <img src="{{ asset('images/xsl.png') }}" class="mr-2" /> EXCEL
                </a>
            </div>
        </div>
        <?php Html :: import_form('users/importdata' , __('importData'), 'CSV , JSON'); ?>
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
<!-- Detail Page Column -->
<?php if(!request()->has('subpage')){ ?>
<div class="col-12">
    <div class=" ">
        <div id="users-detail-page" class="master-detail-page"></div>
    </div>
</div>
<?php } ?>
</div>
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
