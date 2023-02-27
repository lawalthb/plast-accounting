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
                        {{ __('companyRegistration') }}
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
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="name">{{ __('name') }} <span class="text-danger">*</span></label>
                                        <div id="ctrl-name-holder" class=" "> 
                                            <input id="ctrl-name" data-field="name"  value="<?php echo get_value('name') ?>" type="text" placeholder="{{ __('enterName') }}"  required="" name="name"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="slogan">{{ __('slogan') }} </label>
                                        <div id="ctrl-slogan-holder" class=" "> 
                                            <input id="ctrl-slogan" data-field="slogan"  value="<?php echo get_value('slogan') ?>" type="text" placeholder="{{ __('enterSlogan') }}"  name="slogan"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="address">{{ __('address') }} </label>
                                        <div id="ctrl-address-holder" class=" "> 
                                            <textarea placeholder="{{ __('enterAddress') }}" id="ctrl-address" data-field="address"  rows="2" name="address" class=" form-control"><?php echo get_value('address') ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseEnterText') }}</div>-->
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="website">{{ __('website') }} </label>
                                        <div id="ctrl-website-holder" class=" "> 
                                            <input id="ctrl-website" data-field="website"  value="<?php echo get_value('website') ?>" type="text" placeholder="{{ __('enterWebsite') }}"  name="website"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="com_email">{{ __('companysEmail') }} </label>
                                        <div id="ctrl-com_email-holder" class=" "> 
                                            <input id="ctrl-com_email" data-field="com_email"  value="<?php echo get_value('com_email') ?>" type="email" placeholder="{{ __('enterCompanysEmail') }}"  name="com_email"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="com_phone">{{ __('companysPhone') }} </label>
                                        <div id="ctrl-com_phone-holder" class=" "> 
                                            <input id="ctrl-com_phone" data-field="com_phone"  value="<?php echo get_value('com_phone') ?>" type="text" placeholder="{{ __('enterCompanysPhone') }}"  name="com_phone"  class="form-control " />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="logo">{{ __('logo') }} </label>
                                        <div id="ctrl-logo-holder" class=" "> 
                                            <div class="dropzone " input="#ctrl-logo" fieldname="logo" uploadurl="{{ url('fileuploader/upload/logo') }}"    data-multiple="false" dropmsg="{{ __('chooseFilesOrDropFilesHere') }}"    btntext="{{ __('browse') }}" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                <input name="logo" id="ctrl-logo" data-field="logo" class="dropzone-input form-control" value="<?php echo get_value('logo') ?>" type="text"  />
                                                <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseAChooseFile') }}</div>-->
                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="favicon">{{ __('favicon') }} </label>
                                        <div id="ctrl-favicon-holder" class=" "> 
                                            <div class="dropzone " input="#ctrl-favicon" fieldname="favicon" uploadurl="{{ url('fileuploader/upload/favicon') }}"    data-multiple="false" dropmsg="{{ __('chooseFilesOrDropFilesHere') }}"    btntext="{{ __('browse') }}" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                <input name="favicon" id="ctrl-favicon" data-field="favicon" class="dropzone-input form-control" value="<?php echo get_value('favicon') ?>" type="text"  />
                                                <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseAChooseFile') }}</div>-->
                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <div class="bg-light p-2 subform">
                                <h4 class="record-title">Add New Users</h4>
                                <hr />
                                @csrf
                                <div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="firstname">{{ __('firstname') }} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div id="ctrl-firstname-holder" class=" ">
                                                        <input id="ctrl-firstname" data-field="firstname"  value="<?php echo get_value('firstname') ?>" type="text" placeholder="{{ __('enterFirstname') }}"  required="" name="users[firstname]"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="lastname">{{ __('lastname') }} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div id="ctrl-lastname-holder" class=" ">
                                                        <input id="ctrl-lastname" data-field="lastname"  value="<?php echo get_value('lastname') ?>" type="text" placeholder="{{ __('enterLastname') }}"  required="" name="users[lastname]"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="email">{{ __('email') }} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div id="ctrl-email-holder" class=" ">
                                                        <input id="ctrl-email" data-field="email"  value="<?php echo get_value('email') ?>" type="email" placeholder="{{ __('enterEmail') }}"  required="" name="users[email]"  data-url="componentsdata/users_email_value_exist/" data-loading-msg="[html-lang-0131]" data-available-msg="[html-lang-0133]" data-unavailable-msg="[html-lang-0132]" class="form-control  ctrl-check-duplicate" />
                                                        <div class="check-status"></div> 
                                                    </div>
                                                    <small class="form-text">Password is 123456</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="username">{{ __('username') }} <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div id="ctrl-username-holder" class=" ">
                                                        <input id="ctrl-username" data-field="username"  value="<?php echo get_value('username') ?>" type="text" placeholder="{{ __('enterUsername') }}"  required="" name="users[username]"  data-url="componentsdata/users_username_value_exist/" data-loading-msg="[html-lang-0131]" data-available-msg="[html-lang-0133]" data-unavailable-msg="[html-lang-0132]" class="form-control  ctrl-check-duplicate" />
                                                        <div class="check-status"></div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="phone">{{ __('phone') }} </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div id="ctrl-phone-holder" class=" ">
                                                        <input id="ctrl-phone" data-field="phone"  value="<?php echo get_value('phone') ?>" type="text" placeholder="{{ __('enterPhone') }}"  name="users[phone]"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="photo">{{ __('photo') }} </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div id="ctrl-photo-holder" class=" ">
                                                        <div class="dropzone " input="#ctrl-photo" fieldname="photo" uploadurl="{{ url('fileuploader/upload/photo') }}"    data-multiple="false" dropmsg="{{ __('chooseFilesOrDropFilesHere') }}"    btntext="[html-lang-0082]" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                                            <input name="users[photo]" id="ctrl-photo" data-field="photo" class="dropzone-input form-control" value="<?php echo get_value('photo') ?>" type="text"  />
                                                            <!--<div class="invalid-feedback animated bounceIn text-center">[html-lang-0129]</div>-->
                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="ctrl-company_id" data-field="company_id"  value="<?php echo get_value('company_id', auth()->user()->company_id) ?>" type="hidden" placeholder="{{ __('enterCompanyId') }}" list="company_id_list"  name="users[company_id]"  class="form-control " />
                                    <datalist id="company_id_list">
                                    <?php 
                                        $options = $comp_model->company_id_option_list() ?? [];
                                        foreach($options as $option){
                                        $value = $option->value;
                                        $label = $option->label ?? $value;
                                    ?>
                                    <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                    <?php
                                        }
                                    ?>
                                    </datalist>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="user_role_id">{{ __('userRole') }} <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div id="ctrl-user_role_id-holder" class=" ">
                                                    <select required=""  id="ctrl-user_role_id" data-field="user_role_id" name="users[user_role_id]"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                                    <option value="">{{ __('selectAValue') }}</option>
                                                    <?php 
                                                        $options = $comp_model->user_role_id_option_list() ?? [];
                                                        foreach($options as $option){
                                                        $value = $option->value;
                                                        $label = $option->label ?? $value;
                                                        $selected = Html::get_field_selected('user_role_id', $value, "");
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
