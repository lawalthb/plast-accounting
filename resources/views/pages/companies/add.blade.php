<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewCompanies'); //set dynamic page title
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
                        {{ __('addNewCompanies') }}
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
                        <form id="companies-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('companies.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="name">{{ __('name') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-name-holder" class=" "> 
                                        <input id="ctrl-name" data-field="name"  value="<?php echo get_value('name') ?>" type="text" placeholder="{{ __('enterName') }}"  required="" name="name"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="slogan">{{ __('slogan') }} </label>
                                    <div id="ctrl-slogan-holder" class=" "> 
                                        <input id="ctrl-slogan" data-field="slogan"  value="<?php echo get_value('slogan', "NULL") ?>" type="text" placeholder="{{ __('enterSlogan') }}"  name="slogan"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="address">{{ __('address') }} </label>
                                    <div id="ctrl-address-holder" class=" "> 
                                        <textarea placeholder="{{ __('enterAddress') }}" id="ctrl-address" data-field="address"  rows="5" name="address" class=" form-control"><?php echo get_value('address') ?></textarea>
                                        <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseEnterText') }}</div>-->
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="logo">{{ __('logo') }} </label>
                                    <div id="ctrl-logo-holder" class=" "> 
                                        <input id="ctrl-logo" data-field="logo"  value="<?php echo get_value('logo', "'def_logo.png'") ?>" type="text" placeholder="{{ __('enterLogo') }}"  name="logo"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="website">{{ __('website') }} </label>
                                    <div id="ctrl-website-holder" class=" "> 
                                        <input id="ctrl-website" data-field="website"  value="<?php echo get_value('website', "NULL") ?>" type="text" placeholder="{{ __('enterWebsite') }}"  name="website"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="favicon">{{ __('favicon') }} </label>
                                    <div id="ctrl-favicon-holder" class=" "> 
                                        <input id="ctrl-favicon" data-field="favicon"  value="<?php echo get_value('favicon', "'def_icon.png'") ?>" type="text" placeholder="{{ __('enterFavicon') }}"  name="favicon"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="com_email">{{ __('comEmail') }} </label>
                                    <div id="ctrl-com_email-holder" class=" "> 
                                        <input id="ctrl-com_email" data-field="com_email"  value="<?php echo get_value('com_email', "NULL") ?>" type="email" placeholder="{{ __('enterComEmail') }}"  name="com_email"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="com_phone">{{ __('comPhone') }} </label>
                                    <div id="ctrl-com_phone-holder" class=" "> 
                                        <input id="ctrl-com_phone" data-field="com_phone"  value="<?php echo get_value('com_phone', "NULL") ?>" type="text" placeholder="{{ __('enterComPhone') }}"  name="com_phone"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="signature">{{ __('signature') }} </label>
                                    <div id="ctrl-signature-holder" class=" "> 
                                        <input id="ctrl-signature" data-field="signature"  value="<?php echo get_value('signature', "NULL") ?>" type="text" placeholder="{{ __('enterSignature') }}"  name="signature"  class="form-control " />
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
