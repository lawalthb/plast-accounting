<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("roles/add");
    $can_edit = $user->canAccess("roles/edit");
    $can_view = $user->canAccess("roles/view");
    $can_delete = $user->canAccess("roles/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = __('roles'); //set dynamic page title
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
                        {{ __('roles') }}
                    </div>
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
                <div class="col-md-4 comp-grid " >
                    <div class=" reset-grids">
                        <?php
                            $params = []; //new query param
                            $query = array_merge(request()->query(), $params);
                            $queryParams = http_build_query($query);
                            $url = url("roles/add?$queryParams");
                        ?>
                        <div class="ajax-inline-page" data-url="{{ $url }}" >
                            <div class="ajax-page-load-indicator">
                                <div class="text-center d-flex justify-content-center load-indicator">
                                    <span class="loader mr-3"></span>
                                    <span class="fw-bold">{{ __('loading') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 comp-grid " >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class=" page-content" >
                        <div id="roles-adminlist-records">
                            <div class="row gutter-lg ">
                                <div class="col">
                                    <div id="page-main-content" class="table-responsive">
                                        <div class="ajax-page-load-indicator" style="display:none">
                                            <div class="text-center d-flex justify-content-center load-indicator">
                                                <span class="loader mr-3"></span>
                                                <span class="fw-bold">{{ __('loading') }}</span>
                                            </div>
                                        </div>
                                        <?php Html::page_bread_crumb("/roles/adminlist", $field_name, $field_value); ?>
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
                                                    <th class="td-role_id <?php echo (get_value('orderby') == 'role_id' ? 'sortedby' : null); ?>" >
                                                    <?php Html :: get_field_order_link('role_id', __('roleId'), ''); ?>
                                                    </th>
                                                    <th class="td-role_name <?php echo (get_value('orderby') == 'role_name' ? 'sortedby' : null); ?>" >
                                                    <?php Html :: get_field_order_link('role_name', __('roleName'), ''); ?>
                                                    </th>
                                                    <th class="td-date_created <?php echo (get_value('orderby') == 'date_created' ? 'sortedby' : null); ?>" >
                                                    <?php Html :: get_field_order_link('date_created', __('dateCreated'), ''); ?>
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
                                                    $rec_id = ($data['role_id'] ? urlencode($data['role_id']) : null);
                                                    $counter++;
                                                ?>
                                                <tr>
                                                    <?php if($can_delete){ ?>
                                                    <td class=" td-checkbox">
                                                        <label class="form-check-label">
                                                        <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['role_id'] ?>" type="checkbox" />
                                                        </label>
                                                    </td>
                                                    <?php } ?>
                                                    <!--PageComponentStart-->
                                                    <td class="td-masterdetailbtn">
                                                        <a data-page-id="roles-detail-page" class="btn btn-sm btn-secondary open-master-detail-page" href="<?php print_link("roles/masterdetail/$data[role_id]"); ?>">
                                                        <i class="material-icons">more_vert</i> 
                                                    </a>
                                                </td>
                                                <td class="td-role_id">
                                                    <a href="<?php print_link("roles/view/$data[role_id]") ?>"><?php echo $data['role_id']; ?></a>
                                                </td>
                                                <td class="td-role_name">
                                                    <?php echo  $data['role_name'] ; ?>
                                                </td>
                                                <td class="td-date_created">
                                                    <?php echo  $data['date_created'] ; ?>
                                                </td>
                                                <!--PageComponentEnd-->
                                                <td class="td-btn">
                                                    <?php if($can_view){ ?>
                                                    <a class="btn btn-sm btn-primary has-tooltip "    href="<?php print_link("roles/view/$rec_id"); ?>" >
                                                    <i class="material-icons">visibility</i> {{ __('view') }}
                                                </a>
                                                <?php } ?>
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-success has-tooltip "    href="<?php print_link("roles/edit/$rec_id"); ?>" >
                                                <i class="material-icons">edit</i> {{ __('edit') }}
                                            </a>
                                            <?php } ?>
                                            <?php if($can_delete){ ?>
                                            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal"  href="<?php print_link("roles/delete/$rec_id"); ?>" >
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
                                    <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("roles/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
                        <div id="roles-detail-page" class="master-detail-page"></div>
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
