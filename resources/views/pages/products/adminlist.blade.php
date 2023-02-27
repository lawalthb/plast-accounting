<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("products/add");
    $can_edit = $user->canAccess("products/edit");
    $can_view = $user->canAccess("products/view");
    $can_delete = $user->canAccess("products/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $products_category_option_list_2 = $comp_model->products_category_option_list_2();
    $pageTitle = __('products'); //set dynamic page title
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
                        {{ __('products') }}
                    </div>
                </div>
                <div class="col-md-auto  " >
                    <?php if($can_add){ ?>
                    <?php $modal_id = "modal-" . random_str(); ?>
                    <a href="<?php print_link("products/add", true) ?>"  class="btn btn-primary open-page-modal" >
                    <i class="material-icons">add</i>                                   
                    {{ __('addNewProducts') }} 
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
            <div class="col-2 comp-grid " >
                <div class="q-mb-sm q-pa-sm sticky-top" >
                    <?php $menu_id = "menu-" . random_str(); ?>
                    <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="h4">Categories</div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#<?php echo $menu_id ?>" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    </nav>
                    <div class="collapse collapse-lg " id="<?php echo $menu_id ?>" >
                    <ul class="nav nav-pills">
                        <?php 
                            $options = $products_category_option_list_2 ?? [];
                            foreach($options as $option){
                            $value = $option->value;
                            $label = $option->label ?? $value;
                            $nav_link = add_query_params(['products_category' => $value] , false);
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo is_active_link('products_category', $value); ?>" href="<?php print_link($nav_link) ?>">
                            <?php echo $label; ?>
                        </a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="q-mb-sm q-pa-sm sticky-top" >
            <?php $menu_id = "menu-" . random_str(); ?>
            <nav class="navbar navbar-expand-lg navbar-light">
            <div class="h4">Dead Stock</div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#<?php echo $menu_id ?>" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
            </button>
            </nav>
            <div class="collapse collapse-lg " id="<?php echo $menu_id ?>" >
            <ul class="nav nav-pills">
                <?php
                    $options = Menu::common_description();
                    if(!empty($options)){
                    foreach($options as $option){
                    $value = $option['value'];
                    $label = $option['label'];
                    $nav_link = add_query_params(array('products_dead_stock' => $value ) , false);
                    $is_active = is_active_link('products_dead_stock', $value);
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
<div class="q-mb-sm q-pa-sm sticky-top" >
    <?php $menu_id = "menu-" . random_str(); ?>
    <nav class="navbar navbar-expand-lg navbar-light">
    <div class="h4">Is Active</div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#<?php echo $menu_id ?>" aria-expanded="false">
    <span class="navbar-toggler-icon"></span>
    </button>
    </nav>
    <div class="collapse collapse-lg " id="<?php echo $menu_id ?>" >
    <ul class="nav nav-pills">
        <?php
            $options = Menu::common_description();
            if(!empty($options)){
            foreach($options as $option){
            $value = $option['value'];
            $label = $option['label'];
            $nav_link = add_query_params(array('products_is_active' => $value ) , false);
            $is_active = is_active_link('products_is_active', $value);
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
<div class="col-10 comp-grid " >
    <?php Html::display_page_errors($errors); ?>
    <div class="filter-tags mb-2">
        <?php
            Html::filter_tag('products_category', 'Category', $products_category_option_list_2);
        ?>
        <?php
            Html::filter_tag('products_dead_stock', 'Dead Stock', Menu::common_description());
        ?>
        <?php
            Html::filter_tag('products_is_active', 'Is Active', Menu::common_description());
        ?>
    </div>
    <div  class=" page-content" >
        <div id="products-adminlist-records">
            <div id="page-main-content" class="table-responsive">
                <div class="ajax-page-load-indicator" style="display:none">
                    <div class="text-center d-flex justify-content-center load-indicator">
                        <span class="loader mr-3"></span>
                        <span class="fw-bold">{{ __('loading') }}</span>
                    </div>
                </div>
                <?php Html::page_bread_crumb("/products/adminlist", $field_name, $field_value); ?>
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
                            <th class="td-category <?php echo (get_value('orderby') == 'category' ? 'sortedby' : null); ?>" >
                            <?php Html :: get_field_order_link('category', __('category'), ''); ?>
                            </th>
                            <th class="td-qty <?php echo (get_value('orderby') == 'qty' ? 'sortedby' : null); ?>" >
                            <?php Html :: get_field_order_link('qty', __('qty'), ''); ?>
                            </th>
                            <th class="td-selling_price" > {{ __('sellingPrice') }}</th>
                            <th class="td-purchase_price" > {{ __('purchasePrice') }}</th>
                            <th class="td-user_id <?php echo (get_value('orderby') == 'user_id' ? 'sortedby' : null); ?>" >
                            <?php Html :: get_field_order_link('user_id', __('userId'), ''); ?>
                            </th>
                            <th class="td-unit <?php echo (get_value('orderby') == 'unit' ? 'sortedby' : null); ?>" >
                            <?php Html :: get_field_order_link('unit', __('unit'), ''); ?>
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
                                <?php echo  $data['name'] ; ?>
                            </td>
                            <td class="td-category">
                                <?php echo  $data['category'] ; ?>
                            </td>
                            <td class="td-qty">
                                <?php echo  $data['qty'] ; ?>
                            </td>
                            <td class="td-selling_price">
                                <?php echo  $data['selling_price'] ; ?>
                            </td>
                            <td class="td-purchase_price">
                                <?php echo  $data['purchase_price'] ; ?>
                            </td>
                            <td class="td-user_id">
                                <?php echo  $data['user_id'] ; ?>
                            </td>
                            <td class="td-unit">
                                <?php echo  $data['unit'] ; ?>
                            </td>
                            <!--PageComponentEnd-->
                            <td class="td-btn">
                                <?php if($can_view){ ?>
                                <a class="btn btn-sm btn-primary has-tooltip "    href="<?php print_link("products/adminview/$rec_id"); ?>" >
                                <i class="material-icons">visibility</i> {{ __('view') }}
                            </a>
                            <?php } ?>
                            <?php if($can_edit){ ?>
                            <a class="btn btn-sm btn-success has-tooltip "    href="<?php print_link("products/edit/$rec_id"); ?>" >
                            <i class="material-icons">edit</i> {{ __('edit') }}
                        </a>
                        <?php } ?>
                        <?php if($can_delete){ ?>
                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal"  href="<?php print_link("products/delete/$rec_id"); ?>" >
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
                <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("products/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
