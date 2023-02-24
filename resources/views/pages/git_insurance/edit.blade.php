<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('editGitInsurance'); //set dynamic page title
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
                        {{ __('editGitInsurance') }}
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("git_insurance/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="git_no">{{ __('gitNo') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-git_no-holder" class=" "> 
                                        <input id="ctrl-git_no" data-field="git_no"  value="<?php  echo $data['git_no']; ?>" type="text" placeholder="{{ __('enterGitNo') }}"  required="" name="git_no"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="reg_date">{{ __('regDate') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-reg_date-holder" class="input-group "> 
                                        <input id="ctrl-reg_date" data-field="reg_date" class="form-control datepicker  datepicker"  required="" value="<?php  echo $data['reg_date']; ?>" type="datetime" name="reg_date" placeholder="{{ __('enterRegDate') }}" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                        <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="vehicle_no">{{ __('vehicleNo') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-vehicle_no-holder" class=" "> 
                                        <input id="ctrl-vehicle_no" data-field="vehicle_no"  value="<?php  echo $data['vehicle_no']; ?>" type="text" placeholder="{{ __('enterVehicleNo') }}" minlength="3"  required="" name="vehicle_no"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="driver_name">{{ __('driverName') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-driver_name-holder" class=" "> 
                                        <input id="ctrl-driver_name" data-field="driver_name"  value="<?php  echo $data['driver_name']; ?>" type="text" placeholder="{{ __('enterDriverName') }}"  required="" name="driver_name"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="load_from">{{ __('loadFrom') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-load_from-holder" class=" "> 
                                        <input id="ctrl-load_from" data-field="load_from"  value="<?php  echo $data['load_from']; ?>" type="text" placeholder="{{ __('enterLoadFrom') }}"  required="" name="load_from"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="going_to">{{ __('goingTo') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-going_to-holder" class=" "> 
                                        <input id="ctrl-going_to" data-field="going_to"  value="<?php  echo $data['going_to']; ?>" type="text" placeholder="{{ __('enterGoingTo') }}"  required="" name="going_to"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="total_amount">{{ __('totalAmount') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-total_amount-holder" class=" "> 
                                        <input id="ctrl-total_amount" data-field="total_amount"  value="<?php  echo $data['total_amount']; ?>" type="number" placeholder="{{ __('enterTotalAmount') }}" min="0" step="0.1"  readonly required="" name="total_amount"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="charges">{{ __('charges') }} </label>
                                    <div id="ctrl-charges-holder" class=" "> 
                                        <input id="ctrl-charges" data-field="charges"  value="<?php  echo $data['charges']; ?>" type="number" placeholder="{{ __('enterCharges') }}" step="0.1"  name="charges"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="item_type">{{ __('itemType') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-item_type-holder" class=" "> 
                                        <input id="ctrl-item_type" data-field="item_type"  value="<?php  echo $data['item_type']; ?>" type="text" placeholder="{{ __('enterItemType') }}"  required="" name="item_type"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="mail_sent">{{ __('sendMailOnsubmit') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-mail_sent-holder" class=" "> 
                                        <?php
                                            $options = Menu::common_description();
                                            $field_value = $data['mail_sent'];
                                            if(!empty($options)){
                                            foreach($options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            //check if value is among checked options
                                            $checked = Html::get_record_checked($field_value, $value);
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
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="is_active">{{ __('isActive') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-is_active-holder" class=" "> 
                                        <input id="ctrl-is_active" data-field="is_active"  value="<?php  echo $data['is_active']; ?>" type="text" placeholder="{{ __('enterIsActive') }}"  required="" name="is_active"  class="form-control " />
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
                <div class=" ">
                    <?php
                        $params = ['show_header' => false, 'limit' => 20]; //new query param
                        $query = array_merge(request()->query(), $params);
                        $queryParams = http_build_query($query);
                        $url = url("git_customers/index/git_customers.git_insurance_id/$data[id]?$queryParams");
                    ?>
                    <div class="ajax-inline-page" data-url="{{ $url }}" >
                        <div class="ajax-page-load-indicator">
                            <div class="text-center d-flex justify-content-center load-indicator">
                                <span class="loader mr-3"></span>
                                <span class="fw-bold">{{ __('loading') }}</span>
                            </div>
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
