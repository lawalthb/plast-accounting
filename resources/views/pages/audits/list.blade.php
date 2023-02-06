<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("audits/add");
    $can_edit = $user->canAccess("audits/edit");
    $can_view = $user->canAccess("audits/view");
    $can_delete = $user->canAccess("audits/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = __('audits'); //set dynamic page title
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
                        {{ __('audits') }}
                    </div>
                </div>
                <div class="col-md-auto  " >
                    <a  class="btn " href="<?php print_link("audits/add") ?>" >
                    <i class="material-icons">add</i>                               
                    {{ __('addNewAudits') }} 
                </a>
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
                    <div id="audits-list-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/audits/", $field_name, $field_value); ?>
                            <table class="table table-hover table-striped table-sm text-left">
                                <thead class="table-header ">
                                    <tr>
                                        <th class="td-id <?php echo (get_value('orderby') == 'id' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('id', __('id'), ''); ?>
                                        </th>
                                        <th class="td-user_type <?php echo (get_value('orderby') == 'user_type' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('user_type', __('userType'), ''); ?>
                                        </th>
                                        <th class="td-user_id <?php echo (get_value('orderby') == 'user_id' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('user_id', __('userId'), ''); ?>
                                        </th>
                                        <th class="td-event <?php echo (get_value('orderby') == 'event' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('event', __('event'), ''); ?>
                                        </th>
                                        <th class="td-auditable_type <?php echo (get_value('orderby') == 'auditable_type' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('auditable_type', __('auditableType'), ''); ?>
                                        </th>
                                        <th class="td-auditable_id <?php echo (get_value('orderby') == 'auditable_id' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('auditable_id', __('auditableId'), ''); ?>
                                        </th>
                                        <th class="td-old_values <?php echo (get_value('orderby') == 'old_values' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('old_values', __('oldValues'), ''); ?>
                                        </th>
                                        <th class="td-new_values <?php echo (get_value('orderby') == 'new_values' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('new_values', __('newValues'), ''); ?>
                                        </th>
                                        <th class="td-url <?php echo (get_value('orderby') == 'url' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('url', __('url'), ''); ?>
                                        </th>
                                        <th class="td-ip_address <?php echo (get_value('orderby') == 'ip_address' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('ip_address', __('ipAddress'), ''); ?>
                                        </th>
                                        <th class="td-user_agent <?php echo (get_value('orderby') == 'user_agent' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('user_agent', __('userAgent'), ''); ?>
                                        </th>
                                        <th class="td-tags <?php echo (get_value('orderby') == 'tags' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('tags', __('tags'), ''); ?>
                                        </th>
                                        <th class="td-created_at <?php echo (get_value('orderby') == 'created_at' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('created_at', __('createdAt'), ''); ?>
                                        </th>
                                        <th class="td-updated_at <?php echo (get_value('orderby') == 'updated_at' ? 'sortedby' : null); ?>" >
                                        <?php Html :: get_field_order_link('updated_at', __('updatedAt'), ''); ?>
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
                                        <td class="td-id">
                                            <a href="<?php print_link("audits/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                        </td>
                                        <td class="td-user_type">
                                            <?php echo  $data['user_type'] ; ?>
                                        </td>
                                        <td class="td-user_id">
                                            <?php echo  $data['user_id'] ; ?>
                                        </td>
                                        <td class="td-event">
                                            <?php echo  $data['event'] ; ?>
                                        </td>
                                        <td class="td-auditable_type">
                                            <?php echo  $data['auditable_type'] ; ?>
                                        </td>
                                        <td class="td-auditable_id">
                                            <?php echo  $data['auditable_id'] ; ?>
                                        </td>
                                        <td class="td-old_values">
                                            <?php echo  $data['old_values'] ; ?>
                                        </td>
                                        <td class="td-new_values">
                                            <?php echo  $data['new_values'] ; ?>
                                        </td>
                                        <td class="td-url">
                                            <?php echo  $data['url'] ; ?>
                                        </td>
                                        <td class="td-ip_address">
                                            <?php echo  $data['ip_address'] ; ?>
                                        </td>
                                        <td class="td-user_agent">
                                            <?php echo  $data['user_agent'] ; ?>
                                        </td>
                                        <td class="td-tags">
                                            <?php echo  $data['tags'] ; ?>
                                        </td>
                                        <td class="td-created_at">
                                            <?php echo  $data['created_at'] ; ?>
                                        </td>
                                        <td class="td-updated_at">
                                            <?php echo  $data['updated_at'] ; ?>
                                        </td>
                                        <!--PageComponentEnd-->
                                        <td class="td-btn">
                                            <div class="dropdown" >
                                                <button data-bs-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                                <i class="material-icons">menu</i> 
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php if($can_view){ ?>
                                                    <a class="dropdown-item "   href="<?php print_link("audits/view/$rec_id"); ?>" >
                                                    <i class="material-icons">visibility</i> {{ __('view') }}
                                                </a>
                                                <?php } ?>
                                                <a class="dropdown-item "   href="<?php print_link("audits/edit/$rec_id"); ?>" >
                                                <i class="material-icons">edit</i> {{ __('edit') }}
                                            </a>
                                            <a class="dropdown-item "   href="<?php print_link("audits/delete/$rec_id"); ?>" >
                                            <i class="material-icons">delete_sweep</i> {{ __('delete') }}
                                        </a>
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
                            <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("audits/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                            <i class="material-icons">delete_sweep</i> {{ __('deleteSelected') }}
                            </button>
                            <?php } ?>
                            <div class="dropup export-btn-holder mx-1">
                                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">save</i> {{ __('export') }}
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
