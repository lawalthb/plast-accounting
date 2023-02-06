<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewGitInsurance'); //set dynamic page title
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
                        {{ __('addNewGitInsurance') }}
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
                        <form id="git_insurance-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('git_insurance.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="git_no">{{ __('gitNo') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-git_no-holder" class=" "> 
                                            <input id="ctrl-git_no" data-field="git_no"  value="{{App\Http\Controllers\Git_InsuranceController::git_next_no()}}" type="text" placeholder="{{ __('enterGitNo') }}"  readonly required="" name="git_no"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="reg_date">{{ __('regDate') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-reg_date-holder" class="input-group "> 
                                            <input id="ctrl-reg_date" data-field="reg_date" class="form-control datepicker  datepicker"  required="" value="<?php echo get_value('reg_date') ?>" type="datetime" name="reg_date" placeholder="{{ __('enterRegDate') }}" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                            <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="vehicle_no">{{ __('vehicleNo') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-vehicle_no-holder" class=" "> 
                                            <input id="ctrl-vehicle_no" data-field="vehicle_no"  value="<?php echo get_value('vehicle_no') ?>" type="text" placeholder="{{ __('enterVehicleNo') }}" minlength="3"  required="" name="vehicle_no"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="driver_name">{{ __('driverName') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-driver_name-holder" class=" "> 
                                            <input id="ctrl-driver_name" data-field="driver_name"  value="<?php echo get_value('driver_name') ?>" type="text" placeholder="{{ __('enterDriverName') }}"  required="" name="driver_name"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="load_from">{{ __('loadFrom') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-load_from-holder" class=" "> 
                                            <input id="ctrl-load_from" data-field="load_from"  value="<?php echo get_value('load_from') ?>" type="text" placeholder="{{ __('enterLoadFrom') }}"  required="" name="load_from"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="going_to">{{ __('goingTo') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-going_to-holder" class=" "> 
                                            <input id="ctrl-going_to" data-field="going_to"  value="<?php echo get_value('going_to') ?>" type="text" placeholder="{{ __('enterGoingTo') }}"  required="" name="going_to"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="total_amount">{{ __('totalAmount') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-total_amount-holder" class=" "> 
                                            <input id="ctrl-total_amount" data-field="total_amount"  value="<?php echo get_value('total_amount', "0.00") ?>" type="number" placeholder="{{ __('enterTotalAmount') }}" min="0" step="0.1"  readonly required="" name="total_amount"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="charges">{{ __('charges') }} </label>
                                        <div id="ctrl-charges-holder" class=" "> 
                                            <input id="ctrl-charges" data-field="charges"  value="<?php echo get_value('charges', "NULL") ?>" type="number" placeholder="{{ __('enterCharges') }}" step="0.1"  name="charges"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="item_type">{{ __('itemType') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-item_type-holder" class=" "> 
                                            <input id="ctrl-item_type" data-field="item_type"  value="<?php echo get_value('item_type') ?>" type="text" placeholder="{{ __('enterItemType') }}"  required="" name="item_type"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="mail_sent">{{ __('sendMailOnsubmit') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-mail_sent-holder" class=" "> 
                                            <?php
                                                $options = Menu::common_description();
                                                if(!empty($options)){
                                                foreach($options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                //check if current option is checked option
                                                $checked = Html::get_field_checked('mail_sent', $value, "No");
                                            ?>
                                            <label class="form-check form-check-inline">
                                            <input class="form-check-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio" required=""   name="mail_sent" />
                                            <span class="form-check-label"><?php echo $label ?></span>
                                            </label>
                                            <?php
                                                }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <div class="bg-light p-2 subform">
                                <h4 class="record-title">Add Customers Details</h4>
                                <hr />
                                @csrf
                                <div>
                                    <table class="table table-striped table-sm" data-maxrow="20" data-minrow="1">
                                        <thead>
                                            <tr>
                                                <th class="bg-light"><label for="customer_name">{{ __('customerName') }}</label></th>
                                                <th class="bg-light"><label for="invoice_no">{{ __('invoiceNo') }}</label></th>
                                                <th class="bg-light"><label for="amount">{{ __('amount') }}</label></th>
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
                                        <div id="ctrl-customer_name-row<?php echo $row; ?>-holder" class=" ">
                                        <input id="ctrl-customer_name-row<?php echo $row; ?>" data-field="customer_name"  value="<?php echo get_value('customer_name') ?>" type="text" placeholder="{{ __('enterCustomerName') }}"  required="" name="git_customers[<?php echo $row ?>][customer_name]"  class="form-control " />
                                    </div>
                                </td>
                                <td>
                                    <div id="ctrl-invoice_no-row<?php echo $row; ?>-holder" class=" ">
                                    <input id="ctrl-invoice_no-row<?php echo $row; ?>" data-field="invoice_no"  value="<?php echo get_value('invoice_no') ?>" type="text" placeholder="{{ __('enterInvoiceNo') }}"  required="" name="git_customers[<?php echo $row ?>][invoice_no]"  class="form-control " />
                                </div>
                            </td>
                            <td>
                                <div id="ctrl-amount-row<?php echo $row; ?>-holder" class=" ">
                                <input id="ctrl-amount-row<?php echo $row; ?>" data-field="amount"  value="<?php echo get_value('amount', "0.00") ?>" type="number" placeholder="{{ __('enterAmount') }}" step="0.1"  required="" name="git_customers[<?php echo $row ?>][amount]"  class="form-control " />
                            </div>
                        </td>
                        <td>
                            <div id="ctrl-comment-row<?php echo $row; ?>-holder" class=" ">
                            <input id="ctrl-comment-row<?php echo $row; ?>" data-field="comment"  value="<?php echo get_value('comment') ?>" type="text" placeholder="{{ __('enterComment') }}"  name="git_customers[<?php echo $row ?>][comment]"  class="form-control " />
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
