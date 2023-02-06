<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewUsers'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3 mb-3" >
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="material-icons">arrow_back</i>                                
                        {{ __('') }} 
                    </a>
                </div>
                <div class="col  " >
                    <div class=" h5 font-weight-bold text-primary" >
                        {{ __('userRegistration') }}
                    </div>
                </div>
                <div class="col-md-auto comp-grid " >
                    <div class=" ">
                        {{ __('alreadyHaveAnAccount') }}  <a class="btn btn-primary" href="<?php print_link('') ?>"> {{ __('login') }}</a>
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
                        <form id="users-userregister-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('auth.register_store') }}" method="post">
                            <!--[form-content-start]-->
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="email">{{ __('email') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-email-holder" class=" "> 
                                        <input id="ctrl-email" data-field="email"  value="<?php echo get_value('email') ?>" type="email" placeholder="{{ __('enterEmail') }}"  required="" name="email"  data-url="componentsdata/users_email_value_exist/" data-loading-msg="{{ __('checkingAvailability') }}" data-available-msg="{{ __('available') }}" data-unavailable-msg="{{ __('notAvailable') }}" class="form-control  ctrl-check-duplicate" />
                                        <div class="check-status"></div> 
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="password">{{ __('password') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-password-holder" class="input-group "> 
                                        <input id="ctrl-password" data-field="password"  value="<?php echo get_value('password') ?>" type="password" placeholder="{{ __('enterPassword') }}"  required="" name="password"  class="form-control  password password-strength" />
                                        <button type="button" class="btn btn-outline-secondary btn-toggle-password">
                                        <i class="material-icons">visibility</i>
                                        </button>
                                    </div>
                                    <div class="password-strength-msg">
                                        <small class="fw-bold">{{ __('shouldContain') }}</small>
                                        <small class="length chip">6 {{ __('charactersMinimum') }}</small>
                                        <small class="caps chip">{{ __('capitalLetter') }}</small>
                                        <small class="number chip">{{ __('number') }}</small>
                                        <small class="special chip">{{ __('symbol') }}</small>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="confirm_password">{{ __('confirmPassword') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-confirm_password-holder" class="input-group "> 
                                        <input id="ctrl-password-confirm" data-match="#ctrl-password"  class="form-control password-confirm " type="password" name="confirm_password" required placeholder="{{ __('confirmPassword') }}" />
                                        <button type="button" class="btn btn-outline-secondary btn-toggle-password">
                                        <i class="material-icons">visibility</i>
                                        </button>
                                        <div class="invalid-feedback">
                                            Password does not match
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="phone">{{ __('phone') }} </label>
                                    <div id="ctrl-phone-holder" class=" "> 
                                        <input id="ctrl-phone" data-field="phone"  value="<?php echo get_value('phone', "NULL") ?>" type="text" placeholder="{{ __('enterPhone') }}"  name="phone"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="photo">{{ __('photo') }} </label>
                                    <div id="ctrl-photo-holder" class=" "> 
                                        <div class="dropzone " input="#ctrl-photo" fieldname="photo" uploadurl="{{ url('fileuploader/upload/photo') }}"    data-multiple="false" dropmsg="{{ __('chooseFilesOrDropFilesHere') }}"    btntext="{{ __('browse') }}" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                            <input name="photo" id="ctrl-photo" data-field="photo" class="dropzone-input form-control" value="<?php echo get_value('photo') ?>" type="text"  />
                                            <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseAChooseFile') }}</div>-->
                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="username">{{ __('username') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-username-holder" class=" "> 
                                        <input id="ctrl-username" data-field="username"  value="<?php echo get_value('username') ?>" type="text" placeholder="{{ __('enterUsername') }}"  required="" name="username"  data-url="componentsdata/users_username_value_exist/" data-loading-msg="{{ __('checkingAvailability') }}" data-available-msg="{{ __('available') }}" data-unavailable-msg="{{ __('notAvailable') }}" class="form-control  ctrl-check-duplicate" />
                                        <div class="check-status"></div> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <!--[form-content-end]-->
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
<!--custom page css--><!--pagecss-->
</style>
@endsection
<!-- Page custom js -->
@section('pagejs')
<script>
    <!--pageautofill--><!--custom page js--><!--pagejs-->
</script>
@endsection
