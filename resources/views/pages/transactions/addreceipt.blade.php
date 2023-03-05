<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewTransactions'); //set dynamic page title
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
                        Add New Receipt
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
                <div class="col-12 col-md-12 comp-grid " >
                    <?php Html::display_page_errors($errors); ?>
                    <div class=" "><div>
                    </div>
                </div>
                <div  class="card-1 border rounded page-content" >
                    <!--[form-start]-->
                    <form id="transactions-addreceipt-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('transactions.addreceipt_store') }}" method="post">
                        @csrf
                        <div>
                            <div class="row">
                                <div class="form-group col-sm-3">
                                    <label class="control-label" for="trans_no">{{ __('receiptNo') }} </label>
                                    <div id="ctrl-trans_no-holder" class=" "> 
                                        <input id="ctrl-trans_no" data-field="trans_no" data-mask-value="col-sm-6" data-mask-clearifnotmatch="true" data-mask-reverse="true" value="<?php 
                                        if(isset($_GET['method_numbering']) && $_GET['method_numbering']=="Automatic"){
                                        $doc_id = $_GET['document_type'] ; echo getNextReceiptNo($doc_id);}else{
                                            echo "";
                                        }
                                         ?>" type="text" placeholder="{{ __('enterReceiptNo') }}"  name="trans_no"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label class="control-label" for="reference">{{ __('reference') }} </label>
                                    <div id="ctrl-reference-holder" class=" "> 
                                        <input id="ctrl-reference" data-field="reference"  value="<?php echo get_value('reference') ?>" type="text" placeholder="{{ __('enterReference') }}"  name="reference"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="trans_date">{{ __('transDate') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-trans_date-holder" class="input-group "> 
                                        <input id="ctrl-trans_date" data-field="trans_date" class="form-control datepicker  datepicker"  required="" value="<?php echo get_value('trans_date', date('Y-m-d', strtotime('+0day'))) ?>" type="datetime" name="trans_date" placeholder="{{ __('enterTransDate') }}" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                        <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="party_ledger_id">{{ __('accountBankCash') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-party_ledger_id-holder" class=" "> 
                                        <select required=""  id="ctrl-party_ledger_id" data-field="party_ledger_id" name="party_ledger_id"  placeholder="{{ __('selectAAccount') }}"    class="form-select" >
                                        <option value="">{{ __('selectAAccount') }}</option>
                                        <?php 
                                            $options = $comp_model->party_ledger_id_option_list() ?? [];
                                            foreach($options as $option){
                                            $value = $option->value;
                                            $label = $option->label ?? $value;
                                            $selected = Html::get_field_selected('party_ledger_id', $value, "");
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
                                <input id="ctrl-against_ledger_id" data-field="against_ledger_id"  value="<?php echo  getCompanyDirectIncomeId(); ?>" type="hidden" placeholder="{{ __('selectALedger') }}" list="against_ledger_id_list"  name="against_ledger_id"  class="form-control " />
                                <datalist id="against_ledger_id_list">
                                <?php 
                                    $options = $comp_model->ledger_id_option_list() ?? [];
                                    foreach($options as $option){
                                    $value = $option->value;
                                    $label = $option->label ?? $value;
                                ?>
                                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                <?php
                                    }
                                ?>
                                </datalist>
                                <input id="ctrl-document_type_id" data-field="document_type_id"  value="<?php echo $_GET['document_type'] ;?>" type="hidden" placeholder="{{ __('enterDocumentTypeId') }}" list="document_type_id_list"  name="document_type_id"  class="form-control " />
                                <datalist id="document_type_id_list">
                                <?php 
                                    $options = $comp_model->document_type_id_option_list() ?? [];
                                    foreach($options as $option){
                                    $value = $option->value;
                                    $label = $option->label ?? $value;
                                ?>
                                <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                <?php
                                    }
                                ?>
                                </datalist>
                                <input id="ctrl-document_type_code" data-field="document_type_code"  value="<?php echo get_value('document_type_code', "5014") ?>" type="hidden" placeholder="{{ __('enterDocumentTypeCode') }}"  required="" name="document_type_code"  class="form-control " />
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="total_debit">{{ __('totalAmount') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-total_debit-holder" class=" "> 
                                        <input id="ctrl-total_debit" data-field="total_debit"  value="<?php echo get_value('total_debit', "0.00") ?>" type="number" placeholder="{{ __('enterTotalAmount') }}" step="0.1"  readonly required="" name="total_debit"  class="form-control " />
                                    </div>
                                </div>
                                <input id="ctrl-total_credit" data-field="total_credit"  value="<?php echo get_value('total_credit', "0.00") ?>" type="hidden" placeholder="{{ __('enterTotalCredit') }}"  required="" name="total_credit"  class="form-control " />
                            </div>
                        </div>
                        <div class="form-ajax-status"></div>
                        <div class="bg-light p-2 subform">
                            <!-- <h4 class="record-title">Add New Transaction Ledgers</h4> -->
                            <!-- <hr /> -->
                            @csrf
                            <div>
                                <table class="table table-striped table-sm" data-maxrow="10" data-minrow="1">
                                    <thead>
                                        <tr>
                                            <th class="bg-light"><label for="ledger_id">{{ __('ledgerName') }}</label></th>
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
                                    <select required=""  id="ctrl-ledger_id-row<?php echo $row; ?>" data-field="ledger_id" name="transaction_ledgers[<?php echo $row ?>][ledger_id]"  placeholder="{{ __('selectALedger') }}"    class="form-select" >
                                    <option value="">{{ __('selectALedger') }}</option>
                                    <?php 
                                        $options = $comp_model->transaction_ledgers_ledger_id_option_list() ?? [];
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
                                <input id="ctrl-credit_id-row<?php echo $row; ?>" data-field="credit_id"  value="<?php echo get_value('credit_id') ?>" type="text" placeholder="{{ __('enterCreditAmount') }}"  required="" name="transaction_ledgers[<?php echo $row ?>][credit_id]"  class="form-control credit_value " />
                            </div>
                        </td>
                        <td>
                            <div id="ctrl-comment-row<?php echo $row; ?>-holder" class=" ">
                            <input id="ctrl-comment-row<?php echo $row; ?>" data-field="comment"  value="<?php echo get_value('comment', "NULL") ?>" type="text" placeholder="{{ __('enterComment') }}"  name="transaction_ledgers[<?php echo $row ?>][comment]"  class="form-control " />
                        </div>
                    </td>
                    <input id="ctrl-company_id-row<?php echo $row; ?>" data-field="company_id"  value="<?php echo get_value('company_id', auth()->user()->company_id) ?>" type="hidden" placeholder="{{ __('enterCompanyId') }}" list="company_id_list"  required="" name="transaction_ledgers[<?php echo $row ?>][company_id]"  class="form-control " />
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
    </div>
    <div class="bg-light p-2 subform">
        <!-- <h4 class="record-title">Add New Narrations</h4> -->
        <!-- <hr /> -->
        @csrf
        <div>
            <div class="form-group ">
                <label class="control-label" for="narration">{{ __('narration') }} </label>
                <div id="ctrl-narration-holder" class=" "> 
                    <textarea placeholder="{{ __('enterNarration') }}" id="ctrl-narration" data-field="narration"  rows="2" name="narrations[narration]" class=" form-control"><?php echo get_value('narration') ?></textarea>
                    <!--<div class="invalid-feedback animated bounceIn text-center">[html-lang-0130]</div>-->
                </div>
            </div>
        </div>
        <div class="form-ajax-status"></div>
    </div>
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

$(document).on("change", ".credit_value", function(){
    var sum = 0;
    $(".credit_value").each(function(){
        sum += +$(this).val();
    });
   $("#ctrl-total_debit").val(sum);
  //alert(sum);
});


</script>
@endsection
