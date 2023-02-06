<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("git_insurance/add");
    $can_edit = $user->canAccess("git_insurance/edit");
    $can_view = $user->canAccess("git_insurance/view");
    $can_delete = $user->canAccess("git_insurance/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = __('gitInsurance'); //set dynamic page title
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
                        {{ __('gitInsurance') }}
                    </div>
                </div>
                <div class="col-md-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary" href="<?php print_link("git_insurance/add", true) ?>" >
                    <i class="material-icons">add</i>                               
                    {{ __('addNewGitInsurance') }} 
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
            <div class="col-md-2 comp-grid " >
                <div class="q-mb-sm q-pa-sm sticky-top" >
                    <?php $menu_id = "menu-" . random_str(); ?>
                    <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="h4">Filter by Is Active</div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#<?php echo $menu_id ?>" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    </nav>
                    <div class="collapse collapse-lg " id="<?php echo $menu_id ?>" >
                    <ul class="nav nav-pills flex-column">
                        <?php
                            $options = Menu::common_description();
                            if(!empty($options)){
                            foreach($options as $option){
                            $value = $option['value'];
                            $label = $option['label'];
                            $nav_link = add_query_params(array('git_insurance_is_active' => $value ) , false);
                            $is_active = is_active_link('git_insurance_is_active', $value);
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $is_active; ?>" href="<?php print_link($nav_link) ?>">
                            <?php echo $label ?>
                        </a>
                    </li>
                    <?php
                        }
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-10 comp-grid " >
        <?php Html::display_page_errors($errors); ?>
        <div class="filter-tags mb-2">
            <?php
                Html::filter_tag('git_insurance_is_active', 'Is Active', Menu::common_description());
            ?>
        </div>
        <div  class=" page-content" >
            <div id="git_insurance-adminlist-records">
                <div id="page-main-content" class="table-responsive">
                    <?php Html::page_bread_crumb("/git_insurance/adminlist", $field_name, $field_value); ?>
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
                                <th class="td-id <?php echo (get_value('orderby') == 'id' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('id', __('id'), ''); ?>
                                </th>
                                <th class="td-git_no <?php echo (get_value('orderby') == 'git_no' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('git_no', __('gitNo'), ''); ?>
                                </th>
                                <th class="td-vehicle_no <?php echo (get_value('orderby') == 'vehicle_no' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('vehicle_no', __('vehicleNo'), ''); ?>
                                </th>
                                <th class="td-item_type <?php echo (get_value('orderby') == 'item_type' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('item_type', __('itemType'), ''); ?>
                                </th>
                                <th class="td-reg_date <?php echo (get_value('orderby') == 'reg_date' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('reg_date', __('regDate'), ''); ?>
                                </th>
                                <th class="td-driver_name <?php echo (get_value('orderby') == 'driver_name' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('driver_name', __('driverName'), ''); ?>
                                </th>
                                <th class="td-load_from <?php echo (get_value('orderby') == 'load_from' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('load_from', __('loadFrom'), ''); ?>
                                </th>
                                <th class="td-going_to <?php echo (get_value('orderby') == 'going_to' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('going_to', __('goingTo'), ''); ?>
                                </th>
                                <th class="td-total_amount <?php echo (get_value('orderby') == 'total_amount' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('total_amount', __('totalAmount'), ''); ?>
                                </th>
                                <th class="td-mail_sent <?php echo (get_value('orderby') == 'mail_sent' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('mail_sent', __('mailSent'), ''); ?>
                                </th>
                                <th class="td-charges <?php echo (get_value('orderby') == 'charges' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('charges', __('charges'), ''); ?>
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
                                <td class="td-id">
                                    <a href="<?php print_link("git_insurance/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                </td>
                                <td class="td-git_no">
                                    <?php echo  $data['git_no'] ; ?>
                                </td>
                                <td class="td-vehicle_no">
                                    <?php echo  $data['vehicle_no'] ; ?>
                                </td>
                                <td class="td-item_type">
                                    <?php echo  $data['item_type'] ; ?>
                                </td>
                                <td class="td-reg_date">
                                    <?php echo  $data['reg_date'] ; ?>
                                </td>
                                <td class="td-driver_name">
                                    <?php echo  $data['driver_name'] ; ?>
                                </td>
                                <td class="td-load_from">
                                    <?php echo  $data['load_from'] ; ?>
                                </td>
                                <td class="td-going_to">
                                    <?php echo  $data['going_to'] ; ?>
                                </td>
                                <td class="td-total_amount">
                                    <?php echo  $data['total_amount'] ; ?>
                                </td>
                                <td class="td-mail_sent">
                                    <?php echo  $data['mail_sent'] ; ?>
                                </td>
                                <td class="td-charges">
                                    <?php echo  $data['charges'] ; ?>
                                </td>
                                <!--PageComponentEnd-->
                                <td class="td-btn">
                                    <div class="dropdown" >
                                        <button data-bs-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                        <i class="material-icons">menu</i> 
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php if($can_view){ ?>
                                            <a class="dropdown-item "   href="<?php print_link("git_insurance/view/$rec_id"); ?>" >
                                            <i class="material-icons">visibility</i> {{ __('view') }}
                                        </a>
                                        <?php } ?>
                                        <?php if($can_edit){ ?>
                                        <a class="dropdown-item "   href="<?php print_link("git_insurance/edit/$rec_id"); ?>" >
                                        <i class="material-icons">edit</i> {{ __('edit') }}
                                    </a>
                                    <?php } ?>
                                    <?php if($can_delete){ ?>
                                    <a class="dropdown-item record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal" href="<?php print_link("git_insurance/delete/$rec_id"); ?>" >
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
                    <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("git_insurance/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
