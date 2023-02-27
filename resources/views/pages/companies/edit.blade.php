<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('editCompanies'); //set dynamic page title
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
                        {{ __('editCompanies') }}
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("companies/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="name">{{ __('name') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-name-holder" class=" "> 
                                        <input id="ctrl-name" data-field="name"  value="<?php  echo $data['name']; ?>" type="text" placeholder="{{ __('enterName') }}"  required="" name="name"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="slogan">{{ __('slogan') }} </label>
                                    <div id="ctrl-slogan-holder" class=" "> 
                                        <input id="ctrl-slogan" data-field="slogan"  value="<?php  echo $data['slogan']; ?>" type="text" placeholder="{{ __('enterSlogan') }}"  name="slogan"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="address">{{ __('address') }} </label>
                                    <div id="ctrl-address-holder" class=" "> 
                                        <textarea placeholder="{{ __('enterAddress') }}" id="ctrl-address" data-field="address"  rows="2" name="address" class=" form-control"><?php  echo $data['address']; ?></textarea>
                                        <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseEnterText') }}</div>-->
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="website">{{ __('website') }} </label>
                                    <div id="ctrl-website-holder" class=" "> 
                                        <input id="ctrl-website" data-field="website"  value="<?php  echo $data['website']; ?>" type="text" placeholder="{{ __('enterWebsite') }}"  name="website"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="com_email">{{ __('companysEmail') }} </label>
                                    <div id="ctrl-com_email-holder" class=" "> 
                                        <input id="ctrl-com_email" data-field="com_email"  value="<?php  echo $data['com_email']; ?>" type="email" placeholder="{{ __('enterCompanysEmail') }}"  name="com_email"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="com_phone">{{ __('companysPhone') }} </label>
                                    <div id="ctrl-com_phone-holder" class=" "> 
                                        <input id="ctrl-com_phone" data-field="com_phone"  value="<?php  echo $data['com_phone']; ?>" type="text" placeholder="{{ __('enterCompanysPhone') }}"  name="com_phone"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="logo">{{ __('logo') }} </label>
                                    <div id="ctrl-logo-holder" class=" "> 
                                        <div class="dropzone " input="#ctrl-logo" fieldname="logo" uploadurl="{{ url('fileuploader/upload/logo') }}"    data-multiple="false" dropmsg="{{ __('chooseFilesOrDropFilesHere') }}"    btntext="{{ __('browse') }}" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                            <input name="logo" id="ctrl-logo" data-field="logo" class="dropzone-input form-control" value="<?php  echo $data['logo']; ?>" type="text"  />
                                            <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseAChooseFile') }}</div>-->
                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                        </div>
                                    </div>
                                    <?php Html :: uploaded_files_list($data['logo'], '#ctrl-logo'); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="favicon">{{ __('favicon') }} </label>
                                    <div id="ctrl-favicon-holder" class=" "> 
                                        <div class="dropzone " input="#ctrl-favicon" fieldname="favicon" uploadurl="{{ url('fileuploader/upload/favicon') }}"    data-multiple="false" dropmsg="{{ __('chooseFilesOrDropFilesHere') }}"    btntext="{{ __('browse') }}" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                            <input name="favicon" id="ctrl-favicon" data-field="favicon" class="dropzone-input form-control" value="<?php  echo $data['favicon']; ?>" type="text"  />
                                            <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseAChooseFile') }}</div>-->
                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                        </div>
                                    </div>
                                    <?php Html :: uploaded_files_list($data['favicon'], '#ctrl-favicon'); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="signature">{{ __('signature') }} </label>
                                    <div id="ctrl-signature-holder" class=" "> 
                                        <div class="dropzone " input="#ctrl-signature" fieldname="signature" uploadurl="{{ url('fileuploader/upload/signature') }}"    data-multiple="false" dropmsg="{{ __('chooseFilesOrDropFilesHere') }}"    btntext="{{ __('browse') }}" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                            <input name="signature" id="ctrl-signature" data-field="signature" class="dropzone-input form-control" value="<?php  echo $data['signature']; ?>" type="text"  />
                                            <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseAChooseFile') }}</div>-->
                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                        </div>
                                    </div>
                                    <?php Html :: uploaded_files_list($data['signature'], '#ctrl-signature'); ?>
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
