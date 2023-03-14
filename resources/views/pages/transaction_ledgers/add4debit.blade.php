<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewTransactionLedgers'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="material-icons">arrow_back</i>                                
                         
                    </a>
                </div>
                <div class="col col-md-auto  " >
                    <div class=" h5 font-weight-bold text-primary" >
                        {{ __('addNewTransactionLedgers') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-9 comp-grid " >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class="card-1 border rounded page-content" >
                        <!--[form-start]-->
                        <form id="transaction_ledgers-add4debit-form"  novalidate role="form" enctype="multipart/form-data" class="form multi-form page-form" action="{{ route('transaction_ledgers.add4debit_store') }}" method="post" >
                            @csrf
                            <div>
                                <table class="table table-striped table-sm" data-maxrow="10" data-minrow="1">
                                    <thead>
                                        <tr>
                                            <th class="bg-light"><label for="ledger_id">{{ __('bankCashAccount') }}</label></th>
                                            <th class="bg-light"><label for="credit_id">{{ __('creditAmount') }}</label></th>
                                            <th class="bg-light"><label for="comment">{{ __('comment') }}</label></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="100" class="text-right">
                                        <?php $template_id = "table-row-" . random_str(); ?>
                                        <button type="button" data-template="#<?php echo $template_id ?>" class="btn btn-sm btn-success btn-add-table-row"><i class="material-icons">add</i></button>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <!--[table row template]-->
                                <template id="<?php echo $template_id ?>">
                                <?php $row = "CURRENTROW"; // will be replaced with current row index. ?>
                                <tr data-row="<?php echo $row ?>" class="input-row">
                                <td>
                                    <div id="ctrl-ledger_id-row<?php echo $row; ?>-holder" class=" ">
                                    <select required=""  id="ctrl-ledger_id-row<?php echo $row; ?>" data-field="ledger_id" name="row[<?php echo $row ?>][ledger_id]"  placeholder="{{ __('selectALedger') }}"    class="form-select" >
                                    <option value="">{{ __('selectALedger') }}</option>
                                    <?php 
                                        $options = $comp_model->ledger_id_option_list_3() ?? [];
                                        foreach($options as $option){
                                        $value = $option->value;
                                        $label = $option->label ?? $value;
                                        $selected = Html::get_field_selected('ledger_id', $value, "");
                                    ?>
                                    <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                    <?php echo $label; ?>
                                    </option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div id="ctrl-credit_id-row<?php echo $row; ?>-holder" class=" ">
                                <input id="ctrl-credit_id-row<?php echo $row; ?>" data-field="credit_id"  value="<?php echo get_value('credit_id') ?>" type="text" placeholder="{{ __('enterCreditAmount') }}"  required="" name="row[<?php echo $row ?>][credit_id]"  class="form-control " />
                            </div>
                        </td>
                        <td>
                            <div id="ctrl-comment-row<?php echo $row; ?>-holder" class=" ">
                            <input id="ctrl-comment-row<?php echo $row; ?>" data-field="comment"  value="<?php echo get_value('comment', "NULL") ?>" type="text" placeholder="{{ __('enterComment') }}"  name="row[<?php echo $row ?>][comment]"  class="form-control " />
                        </div>
                    </td>
                    <input id="ctrl-company_id-row<?php echo $row; ?>" data-field="company_id"  value="<?php echo get_value('company_id', auth()->user()->company_id) ?>" type="hidden" placeholder="{{ __('enterCompanyId') }}" list="company_id_list"  required="" name="row[<?php echo $row ?>][company_id]"  class="form-control " />
                    <datalist id="company_id_list">
                    <?php 
                        $options = $comp_model->company_id_option_list() ?? [];
                        foreach($options as $option){
                        $value = $option->value;
                        $label = $option->label ?? $value;
                    ?>
                    <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                    <?php
                        }
                    ?>
                    </datalist>
                    <th class="text-center">
                    <button type="button" class="btn-close btn-remove-table-row"></button>
                    </th>
                </tr>
            </template>
            <!--[/table row template]-->
        </div>
        <div class="form-ajax-status"></div>
        <!--[form-button-start]-->
        <div class="form-group form-submit-btn-holder text-center mt-3">
            <button class="btn btn-primary" type="submit">
            {{ __('submit') }}
            <i class="material-icons">send</i>
            </button>
        </div>
        <!--[form-button-end]-->
    </form>
    <!--[form-end]-->
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
    
$(document).ready(function(){
	// custom javascript | jquery codes
});

</script>
@endsection
