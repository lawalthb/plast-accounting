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
                        {{ __('addNewTransactions') }}
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
                <div class="col-12 col-md-9 comp-grid " >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class="card-1 border rounded page-content" >
                        <!--[form-start]-->
                        <form id="transactions-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('transactions.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="trans_no">{{ __('transNo') }} </label>
                                        <div id="ctrl-trans_no-holder" class=" "> 
                                            <input id="ctrl-trans_no" data-field="trans_no" data-mask-value="col-sm-6" data-mask-clearifnotmatch="true" data-mask-reverse="true" value="<?php echo get_value('trans_no', "NULL") ?>" type="text" placeholder="{{ __('enterTransNo') }}"  name="trans_no"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="reference">{{ __('reference') }} </label>
                                        <div id="ctrl-reference-holder" class=" "> 
                                            <input id="ctrl-reference" data-field="reference"  value="<?php echo get_value('reference', "NULL") ?>" type="text" placeholder="{{ __('enterReference') }}"  name="reference"  class="form-control " />
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
                                        <label class="control-label" for="party_ledger_id">{{ __('partyLedgerId') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-party_ledger_id-holder" class=" "> 
                                            <select required=""  id="ctrl-party_ledger_id" data-field="party_ledger_id" name="party_ledger_id"  placeholder="{{ __('selectACustomer') }}"    class="form-select" >
                                            <option value="">{{ __('selectACustomer') }}</option>
                                            <?php 
                                                $options = $comp_model->ledger_id_option_list() ?? [];
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
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="against_ledger_id">{{ __('againstLedgerId') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-against_ledger_id-holder" class=" "> 
                                            <select required=""  id="ctrl-against_ledger_id" data-field="against_ledger_id" name="against_ledger_id"  placeholder="{{ __('selectALedger') }}"    class="form-select" >
                                            <option value="">{{ __('selectALedger') }}</option>
                                            <?php 
                                                $options = $comp_model->ledger_id_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('against_ledger_id', $value, "");
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
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="document_type_id">{{ __('documentTypeId') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-document_type_id-holder" class=" "> 
                                            <select required=""  id="ctrl-document_type_id" data-field="document_type_id" name="document_type_id"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                            <option value="">{{ __('selectAValue') }}</option>
                                            <?php 
                                                $options = $comp_model->document_type_id_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = Html::get_field_selected('document_type_id', $value, "");
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
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="document_type_code">{{ __('documentTypeCode') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-document_type_code-holder" class=" "> 
                                            <input id="ctrl-document_type_code" data-field="document_type_code"  value="<?php echo get_value('document_type_code') ?>" type="number" placeholder="{{ __('enterDocumentTypeCode') }}" step="any"  required="" name="document_type_code"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="total_debit">{{ __('totalDebit') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-total_debit-holder" class=" "> 
                                            <input id="ctrl-total_debit" data-field="total_debit"  value="<?php echo get_value('total_debit') ?>" type="number" placeholder="{{ __('enterTotalDebit') }}" step="0.1"  required="" name="total_debit"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="total_credit">{{ __('totalCredit') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-total_credit-holder" class=" "> 
                                            <input id="ctrl-total_credit" data-field="total_credit"  value="<?php echo get_value('total_credit') ?>" type="number" placeholder="{{ __('enterTotalCredit') }}" step="0.1"  required="" name="total_credit"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <div class="bg-light p-2 subform">
                                <h4 class="record-title">Add New Transaction Products</h4>
                                <hr />
                                @csrf
                                <div>
                                    <table class="table table-striped table-sm" data-maxrow="50" data-minrow="1">
                                        <thead>
                                            <tr>
                                                <th class="bg-light"><label for="product_id">{{ __('productId') }}</label></th>
                                                <th class="bg-light"><label for="quantity">{{ __('quantity') }}</label></th>
                                                <th class="bg-light"><label for="rate">{{ __('rate') }}</label></th>
                                                <th class="bg-light"><label for="amount">{{ __('amount') }}</label></th>
                                                <th class="bg-light"><label for="comment">{{ __('comment') }}</label></th>
                                                <th class="bg-light"><label for="location_id">{{ __('locationId') }}</label></th>
                                                <th class="bg-light"><label for="company_id">{{ __('companyId') }}</label></th>
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
                                        <div id="ctrl-product_id-row<?php echo $row; ?>-holder" class=" ">
                                        <input id="ctrl-product_id-row<?php echo $row; ?>" data-field="product_id"  value="<?php echo get_value('product_id') ?>" type="number" placeholder="{{ __('enterProductId') }}" step="any"  required="" name="transaction_products[<?php echo $row ?>][product_id]"  class="form-control " />
                                    </div>
                                </td>
                                <td>
                                    <div id="ctrl-quantity-row<?php echo $row; ?>-holder" class=" ">
                                    <input id="ctrl-quantity-row<?php echo $row; ?>" data-field="quantity"  value="<?php echo get_value('quantity', "0") ?>" type="number" placeholder="{{ __('enterQuantity') }}" step="0.1"  required="" name="transaction_products[<?php echo $row ?>][quantity]"  class="form-control " />
                                </div>
                            </td>
                            <td>
                                <div id="ctrl-rate-row<?php echo $row; ?>-holder" class=" ">
                                <input id="ctrl-rate-row<?php echo $row; ?>" data-field="rate"  value="<?php echo get_value('rate', "0.00") ?>" type="number" placeholder="{{ __('enterRate') }}" step="0.1"  required="" name="transaction_products[<?php echo $row ?>][rate]"  class="form-control " />
                            </div>
                        </td>
                        <td>
                            <div id="ctrl-amount-row<?php echo $row; ?>-holder" class=" ">
                            <input id="ctrl-amount-row<?php echo $row; ?>" data-field="amount"  value="<?php echo get_value('amount', "0.00") ?>" type="number" placeholder="{{ __('enterAmount') }}" step="0.1"  required="" name="transaction_products[<?php echo $row ?>][amount]"  class="form-control " />
                        </div>
                    </td>
                    <td>
                        <div id="ctrl-comment-row<?php echo $row; ?>-holder" class=" ">
                        <input id="ctrl-comment-row<?php echo $row; ?>" data-field="comment"  value="<?php echo get_value('comment', "NULL") ?>" type="text" placeholder="{{ __('enterComment') }}"  name="transaction_products[<?php echo $row ?>][comment]"  class="form-control " />
                    </div>
                </td>
                <td>
                    <div id="ctrl-location_id-row<?php echo $row; ?>-holder" class=" ">
                    <input id="ctrl-location_id-row<?php echo $row; ?>" data-field="location_id"  value="<?php echo get_value('location_id') ?>" type="number" placeholder="{{ __('enterLocationId') }}" step="any"  required="" name="transaction_products[<?php echo $row ?>][location_id]"  class="form-control " />
                </div>
            </td>
            <td>
                <div id="ctrl-company_id-row<?php echo $row; ?>-holder" class=" ">
                <input id="ctrl-company_id-row<?php echo $row; ?>" data-field="company_id"  value="<?php echo get_value('company_id') ?>" type="number" placeholder="{{ __('enterCompanyId') }}" step="any"  required="" name="transaction_products[<?php echo $row ?>][company_id]"  class="form-control " />
            </div>
        </td>
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
    <h4 class="record-title">Add New Transaction Ledgers</h4>
    <hr />
    @csrf
    <div>
        <div class="form-group ">
            <div class="row">
                <div class="col-sm-4">
                    <label class="control-label" for="ledger_id">{{ __('ledgerId') }} <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-8">
                    <div id="ctrl-ledger_id-holder" class=" ">
                        <input id="ctrl-ledger_id" data-field="ledger_id"  value="<?php echo get_value('ledger_id') ?>" type="number" placeholder="{{ __('enterLedgerId') }}" step="any"  required="" name="transaction_ledgers[ledger_id]"  class="form-control " />
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group ">
            <div class="row">
                <div class="col-sm-4">
                    <label class="control-label" for="debit_id">{{ __('debitId') }} <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-8">
                    <div id="ctrl-debit_id-holder" class=" ">
                        <input id="ctrl-debit_id" data-field="debit_id"  value="<?php echo get_value('debit_id', "0.00") ?>" type="number" placeholder="{{ __('enterDebitId') }}" step="0.1"  required="" name="transaction_ledgers[debit_id]"  class="form-control " />
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group ">
            <div class="row">
                <div class="col-sm-4">
                    <label class="control-label" for="credit_id">{{ __('creditId') }} <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-8">
                    <div id="ctrl-credit_id-holder" class=" ">
                        <input id="ctrl-credit_id" data-field="credit_id"  value="<?php echo get_value('credit_id', "0.00") ?>" type="number" placeholder="{{ __('enterCreditId') }}" step="0.1"  required="" name="transaction_ledgers[credit_id]"  class="form-control " />
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group ">
            <div class="row">
                <div class="col-sm-4">
                    <label class="control-label" for="comment">{{ __('comment') }} </label>
                </div>
                <div class="col-sm-8">
                    <div id="ctrl-comment-holder" class=" ">
                        <input id="ctrl-comment" data-field="comment"  value="<?php echo get_value('comment', "NULL") ?>" type="number" placeholder="{{ __('enterComment') }}" step="any"  name="transaction_ledgers[comment]"  class="form-control " />
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group ">
            <div class="row">
                <div class="col-sm-4">
                    <label class="control-label" for="company_id">{{ __('companyId') }} <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-8">
                    <div id="ctrl-company_id-holder" class=" ">
                        <select required=""  id="ctrl-company_id" data-field="company_id" name="transaction_ledgers[company_id]"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                        <option value="">{{ __('selectAValue') }}</option>
                        <?php 
                            $options = $comp_model->company_id_option_list() ?? [];
                            foreach($options as $option){
                            $value = $option->value;
                            $label = $option->label ?? $value;
                            $selected = Html::get_field_selected('company_id', $value, "");
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
            </div>
        </div>
    </div>
    <div class="form-ajax-status"></div>
</div>
<div class="bg-light p-2 subform">
    <h4 class="record-title">Add New Narrations</h4>
    <hr />
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

</script>
@endsection
