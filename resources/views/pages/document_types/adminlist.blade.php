<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("document_types/add");
    $can_edit = $user->canAccess("document_types/edit");
    $can_view = $user->canAccess("document_types/view");
    $can_delete = $user->canAccess("document_types/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $document_types_document_code_option_list = $comp_model->document_types_document_code_option_list();
    $pageTitle = __('documentTypes'); //set dynamic page title
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
                        {{ __('documentTypes') }}
                    </div>
                </div>
                <div class="col-md-auto  " >
                    <?php if($can_add){ ?>
                    <?php $modal_id = "modal-" . random_str(); ?>
                    <a href="<?php print_link("document_types/adminadd", true) ?>"  class="btn btn-primary open-page-modal" >
                    <i class="material-icons">add</i>                                   
                    {{ __('addNewDocumentTypes') }} 
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
            <div class="col-md-2 comp-grid " >
                <div class="q-mb-sm q-pa-sm sticky-top" >
                    <?php $menu_id = "menu-" . random_str(); ?>
                    <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="h4">Document Under</div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#<?php echo $menu_id ?>" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    </nav>
                    <div class="collapse collapse-lg " id="<?php echo $menu_id ?>" >
                    <ul class="nav nav-pills flex-column">
                        <?php 
                            $options = $document_types_document_code_option_list ?? [];
                            foreach($options as $option){
                            $value = $option->value;
                            $label = $option->label ?? $value;
                            $nav_link = add_query_params(['document_types_document_code' => $value] , false);
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo is_active_link('document_types_document_code', $value); ?>" href="<?php print_link($nav_link) ?>">
                            <?php echo $label; ?>
                        </a>
                    </li>
                    <?php
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
                Html::filter_tag('document_types_document_code', 'Under', $document_types_document_code_option_list);
            ?>
        </div>
        <div  class=" page-content" >
            <div id="document_types-adminlist-records">
                <div id="page-main-content" class="table-responsive">
                    <div class="ajax-page-load-indicator" style="display:none">
                        <div class="text-center d-flex justify-content-center load-indicator">
                            <span class="loader mr-3"></span>
                            <span class="fw-bold">{{ __('loading') }}</span>
                        </div>
                    </div>
                    <?php Html::page_bread_crumb("/document_types/adminlist", $field_name, $field_value); ?>
                    <table class="table table-hover table-striped table-sm text-left">
                        <thead class="table-header ">
                            <tr>
                                <th class="td-" > </th><th class="td-id" > {{ __('make') }}</th>
                                <th class="td-name <?php echo (get_value('orderby') == 'name' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('name', __('name'), ''); ?>
                                </th>
                                <th class="td-method_numbering <?php echo (get_value('orderby') == 'method_numbering' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('method_numbering', __('methodNumbering'), ''); ?>
                                </th>
                                <th class="td-prefix <?php echo (get_value('orderby') == 'prefix' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('prefix', __('prefix'), ''); ?>
                                </th>
                                <th class="td-starting_num" > {{ __('startingNum') }}</th>
                                <th class="td-common_description" > {{ __('commonDescription') }}</th>
                                <th class="td-print_onsave" > {{ __('printOnsave') }}</th>
                                <th class="td-desc_each_line" > {{ __('descEachLine') }}</th>
                                <th class="td-document_code <?php echo (get_value('orderby') == 'document_code' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('document_code', __('under'), ''); ?>
                                </th>
                                <th class="td-prefix_char <?php echo (get_value('orderby') == 'prefix_char' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('prefix_char', __('prefixChar'), ''); ?>
                                </th>
                                <th class="td-created_by <?php echo (get_value('orderby') == 'created_by' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('created_by', __('createdBy'), ''); ?>
                                </th>
                                <th class="td-no_view <?php echo (get_value('orderby') == 'no_view' ? 'sortedby' : null); ?>" >
                                <?php Html :: get_field_order_link('no_view', __('noView'), ''); ?>
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
                                    <a data-page-id="document_types-detail-page" class="btn btn-sm btn-secondary open-master-detail-page" href="<?php print_link("document_types/masterdetail/$data[id]"); ?>">
                                    <i class="material-icons">more_vert</i> 
                                </a>
                            </td>
                            <td class="td-id"><strong> <a href="/transactions/add<?php echo $data['document_code']; ?>?document_type=<?php echo $data['id']; ?>&method_numbering=<?php echo  $data['method_numbering']; ?>" class="btn btn-primary">
                            <i class="material-icons">add</i>New
                        </a></strong></td>
                        <td class="td-name">
                            <?php echo  $data['name'] ; ?>
                        </td>
                        <td class="td-method_numbering">
                            <?php echo  $data['method_numbering'] ; ?>
                        </td>
                        <td class="td-prefix">
                            <?php echo  $data['prefix'] ; ?>
                        </td>
                        <td class="td-starting_num">
                            <?php echo  $data['starting_num'] ; ?>
                        </td>
                        <td class="td-common_description">
                            <?php echo  $data['common_description'] ; ?>
                        </td>
                        <td class="td-print_onsave">
                            <?php echo  $data['print_onsave'] ; ?>
                        </td>
                        <td class="td-desc_each_line">
                            <?php echo  $data['desc_each_line'] ; ?>
                        </td>
                        <td class="td-document_code">
                            <?php echo  $data['document_code'] ; ?>
                        </td>
                        <td class="td-prefix_char">
                            <?php echo  $data['prefix_char'] ; ?>
                        </td>
                        <td class="td-created_by">
                            <?php echo  $data['created_by'] ; ?>
                        </td>
                        <td class="td-no_view">
                            <?php echo  $data['no_view'] ; ?>
                        </td>
                        <!--PageComponentEnd-->
                        <td class="td-btn">
                            <?php if($can_edit){ ?>
                            <a class="btn btn-sm btn-success has-tooltip "    href="<?php print_link("document_types/edit/$rec_id"); ?>" >
                            <i class="material-icons">edit</i> {{ __('edit') }}
                        </a>
                        <?php } ?>
                        <?php if($can_delete){ ?>
                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal"  href="<?php print_link("document_types/delete/$rec_id"); ?>" >
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
                <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("document_types/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
