<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("transactions/add");
    $can_edit = $user->canAccess("transactions/edit");
    $can_view = $user->canAccess("transactions/view");
    $can_delete = $user->canAccess("transactions/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $transactions_id_option_list_2 = $comp_model->transactions_id_option_list_2();
    $pageTitle = __('transactions'); //set dynamic page title
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
                        {{ __('transactionsAdmin') }}
                    </div>
                </div>
                <div class="col-md-auto  " >
                    <div class=" "><div>
                        <form action="/transactions/add">
                            <div class="input-group">
                                <select class="form-select" name="document_type">
                                <option>Select Document</option>
                                <?php 
                                    $options = $transactions_id_option_list_2 ?? [];
                                    foreach($options as $option){
                                    $value = $option->value;
                                    $label = $option->label ?? $value;
                                    $selected = Html::get_field_selected('transactions_id', $value);
                                ?>
                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                <?php echo $label; ?>
                                </option>
                                <?php
                                    }
                                ?>
                                </select>
                                <span class="input-group-text"><input class=" btn btn-primary" type="submit" value="Add"></span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="q-mb-sm q-pa-sm ">
                    <select   name="transactions_id" class="form-select custom " style="display:none">
                    <option value="">{{ __('selectAValue') }}</option>
                    <?php 
                        $options = $transactions_id_option_list_2 ?? [];
                        foreach($options as $option){
                        $value = $option->value;
                        $label = $option->label ?? $value;
                        $selected = Html::get_field_selected('transactions_id', $value);
                    ?>
                    <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                    <?php echo $label; ?>
                    </option>
                    <?php
                        }
                    ?>
                    </select>
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
            <div class="col-2 comp-grid " >
                <form method="get" action="" class="form">
                    <div class="mb-5 sticky-top" >
                        <?php $menu_id = "menu-" . random_str(); ?>
                        <nav class="navbar navbar-expand-lg navbar-light">
                        <div class="h4">Doc Type</div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#<?php echo $menu_id ?>" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        </nav>
                        <div class="collapse collapse-lg " id="<?php echo $menu_id ?>" >
                        <ul class="nav nav-pills flex-column nav-justified nav-fill">
                            <?php 
                                $options = $transactions_id_option_list_2 ?? [];
                                foreach($options as $option){
                                $value = $option->value;
                                $label = $option->label ?? $value;
                                $nav_link = add_query_params(['transactions_document_type_id' => $value] , false);
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo is_active_link('transactions_document_type_id', $value); ?>" href="<?php print_link($nav_link) ?>">
                                <?php echo $label; ?>
                            </a>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class=" "><div class="gaphere"><br /><br /><br /></div>
        </div>
        <div class="q-mb-sm q-pa-sm mt-5 ">
            <label class="fw-bold p-2">Filter by Trans Date</label>
            <div class="">
                <input class="form-control datepicker"  value="<?php echo get_value('transactions_trans_date') ?>" type="datetime"  name="transactions_trans_date" placeholder="{{ __('selectDate') }}" data-enable-time="" data-date-format="Y-m-d" data-alt-format="M j, Y" data-inline="false" data-no-calendar="false" data-mode="range"  />
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
            Html::filter_tag('transactions_id', 'Id', $transactions_id_option_list_2);
        ?>
        <?php
            Html::filter_tag('transactions_document_type_id', 'Document Type', $transactions_id_option_list_2);
        ?>
        <?php
            Html::filter_tag_date('transactions_trans_date', 'Trans Date', 'jS F, Y');
        ?>
    </div>
    <div  class=" page-content" >
        <div id="transactions-adminlist-records">
            <div class="row gutter-lg ">
                <div class="col">
                    <div id="page-main-content" class="table-responsive">
                        <?php Html::page_bread_crumb("/transactions/adminlist", $field_name, $field_value); ?>
                        <table class="table table-hover table-striped text-left table-borderless">
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
                                    <th class="td-trans_date <?php echo (get_value('orderby') == 'trans_date' ? 'sortedby' : null); ?>" >
                                    <?php Html :: get_field_order_link('trans_date', __('transDate'), ''); ?>
                                    </th>
                                    <th class="td-reference <?php echo (get_value('orderby') == 'reference' ? 'sortedby' : null); ?>" >
                                    <?php Html :: get_field_order_link('reference', __('reference'), ''); ?>
                                    </th>
                                    <th class="td-party_ledger_id <?php echo (get_value('orderby') == 'party_ledger_id' ? 'sortedby' : null); ?>" >
                                    <?php Html :: get_field_order_link('party_ledger_id', __('partyLedgerId'), ''); ?>
                                    </th>
                                    <th class="td-against_ledger_id <?php echo (get_value('orderby') == 'against_ledger_id' ? 'sortedby' : null); ?>" >
                                    <?php Html :: get_field_order_link('against_ledger_id', __('againstLedgerId'), ''); ?>
                                    </th>
                                    <th class="td-document_type_id <?php echo (get_value('orderby') == 'document_type_id' ? 'sortedby' : null); ?>" >
                                    <?php Html :: get_field_order_link('document_type_id', __('documentTypeId'), ''); ?>
                                    </th>
                                    <th class="td-document_type_code <?php echo (get_value('orderby') == 'document_type_code' ? 'sortedby' : null); ?>" >
                                    <?php Html :: get_field_order_link('document_type_code', __('documentTypeCode'), ''); ?>
                                    </th>
                                    <th class="td-total_debit <?php echo (get_value('orderby') == 'total_debit' ? 'sortedby' : null); ?>" >
                                    <?php Html :: get_field_order_link('total_debit', __('totalDebit'), ''); ?>
                                    </th>
                                    <th class="td-total_credit <?php echo (get_value('orderby') == 'total_credit' ? 'sortedby' : null); ?>" >
                                    <?php Html :: get_field_order_link('total_credit', __('totalCredit'), ''); ?>
                                    </th>
                                    <th class="td-created_by <?php echo (get_value('orderby') == 'created_by' ? 'sortedby' : null); ?>" >
                                    <?php Html :: get_field_order_link('created_by', __('createdBy'), ''); ?>
                                    </th>
                                    <th class="td-trans_no <?php echo (get_value('orderby') == 'trans_no' ? 'sortedby' : null); ?>" >
                                    <?php Html :: get_field_order_link('trans_no', __('transNo'), ''); ?>
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
                                        <a data-page-id="transactions-detail-page" class="btn btn-sm btn-secondary open-master-detail-page" href="<?php print_link("transactions/masterdetail/$data[id]"); ?>">
                                        <i class="material-icons">more_vert</i> 
                                    </a>
                                </td>
                                <td class="td-id">
                                    <a href="<?php print_link("transactions/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                </td>
                                <td class="td-trans_date">
                                    <?php echo  $data['trans_date'] ; ?>
                                </td>
                                <td class="td-reference">
                                    <?php echo  $data['reference'] ; ?>
                                </td>
                                <td class="td-party_ledger_id">
                                    <?php echo  $data['party_ledger_id'] ; ?>
                                </td>
                                <td class="td-against_ledger_id">
                                    <?php echo  $data['against_ledger_id'] ; ?>
                                </td>
                                <td class="td-document_type_id">
                                    <?php echo  $data['document_type_id'] ; ?>
                                </td>
                                <td class="td-document_type_code">
                                    <?php echo  $data['document_type_code'] ; ?>
                                </td>
                                <td class="td-total_debit">
                                    <?php echo  $data['total_debit'] ; ?>
                                </td>
                                <td class="td-total_credit">
                                    <?php echo  $data['total_credit'] ; ?>
                                </td>
                                <td class="td-created_by">
                                    <?php echo  $data['created_by'] ; ?>
                                </td>
                                <td class="td-trans_no">
                                    <?php echo  $data['trans_no'] ; ?>
                                </td>
                                <!--PageComponentEnd-->
                                <td class="td-btn">
                                    <div class="dropdown" >
                                        <button data-bs-toggle="dropdown" class="dropdown-toggle btn text-primary btn-flat btn-sm">
                                        <i class="material-icons">menu</i> 
                                        </button>
                                        <ul class="dropdown-menu">
                                            <?php if($can_view){ ?>
                                            <a class="dropdown-item "   href="<?php print_link("transactions/view/$rec_id"); ?>" >
                                            <i class="material-icons">visibility</i> {{ __('view') }}
                                        </a>
                                        <?php } ?>
                                        <?php if($can_edit){ ?>
                                        <a class="dropdown-item "   href="<?php print_link("transactions/edit/$rec_id"); ?>" >
                                        <i class="material-icons">edit</i> {{ __('edit') }}
                                    </a>
                                    <?php } ?>
                                    <?php if($can_delete){ ?>
                                    <a class="dropdown-item record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal" href="<?php print_link("transactions/delete/$rec_id"); ?>" >
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
                    <button data-prompt-msg="{{ __('promptDeleteRecords') }}" data-display-style="modal" data-url="<?php print_link("transactions/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
<!-- Detail Page Column -->
<?php if(!request()->has('subpage')){ ?>
<div class="col-12">
    <div class=" ">
        <div id="transactions-detail-page" class="master-detail-page"></div>
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
