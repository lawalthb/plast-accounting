<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('editTransactionLedgers'); //set dynamic page title
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
                        {{ __('editTransactionLedgers') }}
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("transaction_ledgers/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <label class="control-label" for="ledger_id">{{ __('ledgerId') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-ledger_id-holder" class=" "> 
                                    <input id="ctrl-ledger_id" data-field="ledger_id"  value="<?php  echo $data['ledger_id']; ?>" type="number" placeholder="{{ __('enterLedgerId') }}" step="any"  required="" name="ledger_id"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="debit_id">{{ __('debitId') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-debit_id-holder" class=" "> 
                                    <input id="ctrl-debit_id" data-field="debit_id"  value="<?php  echo $data['debit_id']; ?>" type="number" placeholder="{{ __('enterDebitId') }}" step="0.1"  required="" name="debit_id"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="credit_id">{{ __('creditId') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-credit_id-holder" class=" "> 
                                    <input id="ctrl-credit_id" data-field="credit_id"  value="<?php  echo $data['credit_id']; ?>" type="number" placeholder="{{ __('enterCreditId') }}" step="0.1"  required="" name="credit_id"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="comment">{{ __('comment') }} </label>
                                <div id="ctrl-comment-holder" class=" "> 
                                    <input id="ctrl-comment" data-field="comment"  value="<?php  echo $data['comment']; ?>" type="number" placeholder="{{ __('enterComment') }}" step="any"  name="comment"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="company_id">{{ __('companyId') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-company_id-holder" class=" "> 
                                    <select required=""  id="ctrl-company_id" data-field="company_id" name="company_id"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                    <option value="">{{ __('selectAValue') }}</option>
                                    <?php
                                        $options = $comp_model->company_id_option_list() ?? [];
                                        foreach($options as $option){
                                        $value = $option->value;
                                        $label = $option->label ?? $value;
                                        $selected = ( $value == $data['company_id'] ? 'selected' : null );
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
