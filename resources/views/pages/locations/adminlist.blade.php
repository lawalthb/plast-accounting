<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("locations/add");
    $can_edit = $user->canAccess("locations/edit");
    $can_view = $user->canAccess("locations/view");
    $can_delete = $user->canAccess("locations/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = __('locations'); //set dynamic page title
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
                        {{ __('locations') }}
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
                    <div class=" "><div>Add Location</div>
                </div>
                <div class=" reset-grids">
                    <?php
                        $params = ['show_header' => false]; //new query param
                        $query = array_merge(request()->query(), $params);
                        $queryParams = http_build_query($query);
                        $url = url("locations/add?$queryParams");
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
                    <div id="locations-adminlist-records">
                        <div id="page-main-content" class="table-responsive">
                            <div class="ajax-page-load-indicator" style="display:none">
                                <div class="text-center d-flex justify-content-center load-indicator">
                                    <span class="loader mr-3"></span>
                                    <span class="fw-bold">{{ __('loading') }}</span>
                                </div>
                            </div>
                            <?php Html::page_bread_crumb("/locations/adminlist", $field_name, $field_value); ?>
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
                                        <th class="td-name <?php echo (get_value('orderby') == 'name' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('name', __('name'), ''); ?>
                                        </th>
                                        <th class="td-created_by <?php echo (get_value('orderby') == 'created_by' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('created_by', __('createdBy'), ''); ?>
                                        </th>
                                        <th class="td-is_active <?php echo (get_value('orderby') == 'is_active' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('is_active', __('isActive'), ''); ?>
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
                                        <td class="td-name">
                                            <span <?php if($can_edit){ ?> data-source='<?php print_link('componentsdata/customer_name_option_list'); ?>' 
                                            data-value="<?php echo $data['name']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("locations/edit/" . urlencode($data['id'])); ?>" 
                                            data-name="name" 
                                            data-title="Enter Name" 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="text" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo  $data['name'] ; ?>
                                            </span>
                                        </td>
                                        <td class="td-created_by">
                                            <?php echo  $data['created_by'] ; ?>
                                        </td>
                                        <td class="td-is_active">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu::common_description()); ?>' 
                                            data-value="<?php echo $data['is_active']; ?>" 
                                            data-pk="<?php echo $data['id'] ?>" 
                                            data-url="<?php print_link("locations/edit/" . urlencode($data['id'])); ?>" 
                                            data-name="is_active" 
                                            data-title="Enter Is Active" 
                                            data-placement="left" 
                                            data-toggle="click" 
                                            data-type="radiolist" 
                                            data-mode="popover" 
                                            data-showbuttons="left" 
                                            class="is-editable" <?php } ?>>
                                            <?php echo  $data['is_active'] ; ?>
                                            </span>
                                        </td>
                                        <td class="td-date_created">
                                            <?php echo  $data['date_created'] ; ?>
                                        </td>
                                        <!--PageComponentEnd-->
                                        <td class="td-btn">
                                            <?php if($can_delete){ ?>
                                            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal"  href="<?php print_link("locations/delete/$rec_id"); ?>" >
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
                                    <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("locations/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
