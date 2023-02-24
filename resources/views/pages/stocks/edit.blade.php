<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('editStocks'); //set dynamic page title
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
                        {{ __('editStocks') }}
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("stocks/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <label class="control-label" for="product_id">{{ __('productId') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-product_id-holder" class=" "> 
                                    <input id="ctrl-product_id" data-field="product_id"  value="<?php  echo $data['product_id']; ?>" type="number" placeholder="{{ __('enterProductId') }}" step="any"  required="" name="product_id"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="particular">{{ __('particular') }} </label>
                                <div id="ctrl-particular-holder" class=" "> 
                                    <input id="ctrl-particular" data-field="particular"  value="<?php  echo $data['particular']; ?>" type="text" placeholder="{{ __('enterParticular') }}"  name="particular"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="reg_date">{{ __('regDate') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-reg_date-holder" class="input-group "> 
                                    <input id="ctrl-reg_date" data-field="reg_date" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['reg_date']; ?>" type="datetime" name="reg_date" placeholder="{{ __('enterRegDate') }}" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                    <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="stock_in">{{ __('stockIn') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-stock_in-holder" class=" "> 
                                    <input id="ctrl-stock_in" data-field="stock_in"  value="<?php  echo $data['stock_in']; ?>" type="number" placeholder="{{ __('enterStockIn') }}" step="0.1"  required="" name="stock_in"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="stock_out">{{ __('stockOut') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-stock_out-holder" class=" "> 
                                    <input id="ctrl-stock_out" data-field="stock_out"  value="<?php  echo $data['stock_out']; ?>" type="number" placeholder="{{ __('enterStockOut') }}" step="0.1"  required="" name="stock_out"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="stock_balance">{{ __('stockBalance') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-stock_balance-holder" class=" "> 
                                    <input id="ctrl-stock_balance" data-field="stock_balance"  value="<?php  echo $data['stock_balance']; ?>" type="number" placeholder="{{ __('enterStockBalance') }}" step="0.1"  required="" name="stock_balance"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="doc_no">{{ __('docNo') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-doc_no-holder" class=" "> 
                                    <input id="ctrl-doc_no" data-field="doc_no"  value="<?php  echo $data['doc_no']; ?>" type="text" placeholder="{{ __('enterDocNo') }}"  required="" name="doc_no"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="user_id">{{ __('userId') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-user_id-holder" class=" "> 
                                    <select required=""  id="ctrl-user_id" data-field="user_id" name="user_id"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                    <option value="">{{ __('selectAValue') }}</option>
                                    <?php
                                        $options = $comp_model->updated_by_option_list() ?? [];
                                        foreach($options as $option){
                                        $value = $option->value;
                                        $label = $option->label ?? $value;
                                        $selected = ( $value == $data['user_id'] ? 'selected' : null );
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
                            <div class="form-group ">
                                <label class="control-label" for="amount_in">{{ __('amountIn') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-amount_in-holder" class=" "> 
                                    <input id="ctrl-amount_in" data-field="amount_in"  value="<?php  echo $data['amount_in']; ?>" type="number" placeholder="{{ __('enterAmountIn') }}" step="0.1"  required="" name="amount_in"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="amount_out">{{ __('amountOut') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-amount_out-holder" class=" "> 
                                    <input id="ctrl-amount_out" data-field="amount_out"  value="<?php  echo $data['amount_out']; ?>" type="number" placeholder="{{ __('enterAmountOut') }}" step="0.1"  required="" name="amount_out"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="ledger_id">{{ __('ledgerId') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-ledger_id-holder" class=" "> 
                                    <select required=""  id="ctrl-ledger_id" data-field="ledger_id" name="ledger_id"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                    <option value="">{{ __('selectAValue') }}</option>
                                    <?php
                                        $options = $comp_model->ledger_id_option_list() ?? [];
                                        foreach($options as $option){
                                        $value = $option->value;
                                        $label = $option->label ?? $value;
                                        $selected = ( $value == $data['ledger_id'] ? 'selected' : null );
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
