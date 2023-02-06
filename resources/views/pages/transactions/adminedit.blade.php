<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('editTransactions'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
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
                        {{ __('editTransactions') }}
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("transactions/adminedit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="trans_no">{{ __('transNo') }} </label>
                                    <div id="ctrl-trans_no-holder" class=" "> 
                                        <input id="ctrl-trans_no" data-field="trans_no" data-mask-value="col-sm-6" data-mask-clearifnotmatch="true" data-mask-reverse="true" value="<?php  echo $data['trans_no']; ?>" type="text" placeholder="{{ __('enterTransNo') }}"  name="trans_no"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="reference">{{ __('reference') }} </label>
                                    <div id="ctrl-reference-holder" class=" "> 
                                        <input id="ctrl-reference" data-field="reference"  value="<?php  echo $data['reference']; ?>" type="text" placeholder="{{ __('enterReference') }}"  name="reference"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="trans_date">{{ __('transDate') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-trans_date-holder" class="input-group "> 
                                        <input id="ctrl-trans_date" data-field="trans_date" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['trans_date']; ?>" type="datetime" name="trans_date" placeholder="{{ __('enterTransDate') }}" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
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
                                            $selected = ( $value == $data['party_ledger_id'] ? 'selected' : null );
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
                                            $selected = ( $value == $data['against_ledger_id'] ? 'selected' : null );
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
                                            $selected = ( $value == $data['document_type_id'] ? 'selected' : null );
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
                                        <input id="ctrl-document_type_code" data-field="document_type_code"  value="<?php  echo $data['document_type_code']; ?>" type="number" placeholder="{{ __('enterDocumentTypeCode') }}" step="any"  required="" name="document_type_code"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="total_debit">{{ __('totalDebit') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-total_debit-holder" class=" "> 
                                        <input id="ctrl-total_debit" data-field="total_debit"  value="<?php  echo $data['total_debit']; ?>" type="number" placeholder="{{ __('enterTotalDebit') }}" step="0.1"  required="" name="total_debit"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="total_credit">{{ __('totalCredit') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-total_credit-holder" class=" "> 
                                        <input id="ctrl-total_credit" data-field="total_credit"  value="<?php  echo $data['total_credit']; ?>" type="number" placeholder="{{ __('enterTotalCredit') }}" step="0.1"  required="" name="total_credit"  class="form-control " />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-ajax-status"></div>
                        <!--[form-content-end]-->
                        <!--[form-button-start]-->
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">
                            {{ __('update') }}
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
    <!--pageautofill-->
$(document).ready(function(){
	// custom javascript | jquery codes
});

</script>
@endsection
