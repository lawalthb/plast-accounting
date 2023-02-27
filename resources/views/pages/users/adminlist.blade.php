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
<section class="page ajax-page" data-page-type="list" data-page-url="{{ url()->full() }}">
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
                    <?php $modal_id = "modal-" . random_str(); ?>
                    <a href="<?php print_link("users/adminadd", true) ?>"  class="btn btn-primary open-page-modal" >
                    <i class="material-icons">add</i>                                   
                    {{ __('addNewUsers') }} 
                </a>
                <div data-backdrop="true" id="<?php  echo $modal_id ?>" class="modal fade"  role="dialog" aria-labelledby="<?php  echo $modal_id ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0 ">
                        </div>
                        <div style="top: 5px; right:5px; z-index: 999;" class="position-absolute">
                            <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <div class="ajax-page-load-indicator" style="display:none">
                                        <div class="text-center d-flex justify-content-center load-indicator">
                                            <span class="loader mr-3"></span>
                                            <span class="fw-bold">{{ __('loading') }}</span>
                                        </div>
                                    </div>
                                    <table class="table table-hover table-striped table-sm text-left">
                                        <thead class="table-header ">
                                            <tr>
                                                <th class="td-" > </th>
                                                <th class="td-firstname <?php echo (get_value('orderby') == 'firstname' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('firstname', __('firstname'), ''); ?>
                                                </th>
                                                <th class="td-lastname <?php echo (get_value('orderby') == 'lastname' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('lastname', __('lastname'), ''); ?>
                                                </th>
                                                <th class="td-email <?php echo (get_value('orderby') == 'email' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('email', __('email'), ''); ?>
                                                </th>
                                                <th class="td-username <?php echo (get_value('orderby') == 'username' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('username', __('username'), ''); ?>
                                                </th>
                                                <th class="td-user_role_id <?php echo (get_value('orderby') == 'user_role_id' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('user_role_id', __('userRoleId'), ''); ?>
                                                </th>
                                                <th class="td-phone <?php echo (get_value('orderby') == 'phone' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('phone', __('phone'), ''); ?>
                                                </th>
                                                <th class="td-photo <?php echo (get_value('orderby') == 'photo' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('photo', __('photo'), ''); ?>
                                                </th>
                                                <th class="td-date_join <?php echo (get_value('orderby') == 'date_join' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('date_join', __('dateJoin'), ''); ?>
                                                </th>
                                                <th class="td-is_active <?php echo (get_value('orderby') == 'is_active' ? 'sortedby' : null); ?>" >
                                                <?php Html :: get_field_order_link('is_active', __('isActive'), ''); ?>
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
                                                <!--PageComponentStart-->
                                                <td class="td-masterdetailbtn">
                                                    <a data-page-id="users-detail-page" class="btn btn-sm btn-secondary open-master-detail-page" href="<?php print_link("users/masterdetail/$data[id]"); ?>">
                                                    <i class="material-icons">more_vert</i> 
                                                </a>
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
                                            <td class="td-username">
                                                <?php echo  $data['username'] ; ?>
                                            </td>
                                            <td class="td-user_role_id">
                                                <?php echo  $data['user_role_id'] ; ?>
                                            </td>
                                            <td class="td-phone">
                                                <a href="<?php print_link("tel:$data[phone]") ?>"><?php echo $data['phone']; ?></a>
                                            </td>
                                            <td class="td-photo">
                                                <?php 
                                                    Html :: page_img($data['photo'], '50px', '50px', "small", 1); 
                                                ?>
                                            </td>
                                            <td class="td-date_join">
                                                <span title="<?php echo human_datetime($data['date_join']); ?>" class="has-tooltip">
                                                <?php echo relative_date($data['date_join']); ?>
                                                </span>
                                            </td>
                                            <td class="td-is_active">
                                                <?php echo  $data['is_active'] ; ?>
                                            </td>
                                            <!--PageComponentEnd-->
                                            <td class="td-btn">
                                                <div class="dropdown" >
                                                    <button data-bs-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                    <i class="material-icons">menu</i> 
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <?php if($can_edit){ ?>
                                                        <a class="dropdown-item "   href="<?php print_link("users/adminedit/$rec_id"); ?>" >
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
                    $pager->ajax_page = true;
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
