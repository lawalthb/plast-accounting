<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewReports'); //set dynamic page title
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
                        {{ __('addNewReports') }}
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
                        <form id="reports-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('reports.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="name">{{ __('name') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-name-holder" class=" "> 
                                        <input id="ctrl-name" data-field="name"  value="<?php echo get_value('name') ?>" type="text" placeholder="{{ __('enterName') }}"  required="" name="name"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="link">{{ __('link') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-link-holder" class=" "> 
                                        <input id="ctrl-link" data-field="link"  value="<?php echo get_value('link', "'#'") ?>" type="text" placeholder="{{ __('enterLink') }}"  required="" name="link"  class="form-control " />
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
                                <div class="form-group ">
                                    <label class="control-label" for="is_active">{{ __('isActive') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-is_active-holder" class=" "> 
                                        <input id="ctrl-is_active" data-field="is_active"  value="<?php echo get_value('is_active', "'Yes'") ?>" type="text" placeholder="{{ __('enterIsActive') }}"  required="" name="is_active"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="no_views">{{ __('noViews') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-no_views-holder" class=" "> 
                                        <input id="ctrl-no_views" data-field="no_views"  value="<?php echo get_value('no_views', "0") ?>" type="number" placeholder="{{ __('enterNoViews') }}" step="any"  required="" name="no_views"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="last_view_time">{{ __('lastViewTime') }} </label>
                                    <div id="ctrl-last_view_time-holder" class="input-group "> 
                                        <input id="ctrl-last_view_time" data-field="last_view_time" class="form-control datepicker  datepicker" value="<?php echo get_value('last_view_time', "NULL") ?>" type="datetime"  name="last_view_time" placeholder="{{ __('enterLastViewTime') }}" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="F j, Y - H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                        <span class="input-group-text"><i class="material-icons">date_range</i></span>
                                    </div>
                                </div>
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
