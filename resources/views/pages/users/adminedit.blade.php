<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('editUsers'); //set dynamic page title
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
                        {{ __('editUsers') }}
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("users/adminedit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="firstname">{{ __('firstname') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-firstname-holder" class=" "> 
                                        <input id="ctrl-firstname" data-field="firstname"  value="<?php  echo $data['firstname']; ?>" type="text" placeholder="{{ __('enterFirstname') }}"  required="" name="firstname"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="lastname">{{ __('lastname') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-lastname-holder" class=" "> 
                                        <input id="ctrl-lastname" data-field="lastname"  value="<?php  echo $data['lastname']; ?>" type="text" placeholder="{{ __('enterLastname') }}"  required="" name="lastname"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="email">{{ __('email') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-email-holder" class=" "> 
                                        <input id="ctrl-email" data-field="email"  value="<?php  echo $data['email']; ?>" type="email" placeholder="{{ __('enterEmail') }}"  required="" name="email"  data-url="componentsdata/users_email_value_exist/" data-loading-msg="{{ __('checkingAvailability') }}" data-available-msg="{{ __('available') }}" data-unavailable-msg="{{ __('notAvailable') }}" class="form-control  ctrl-check-duplicate" />
                                        <div class="check-status"></div> 
                                    </div>
                                    <small class="form-text">Click reset Forgot Password to change password</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="username">{{ __('username') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-username-holder" class=" "> 
                                        <input id="ctrl-username" data-field="username"  value="<?php  echo $data['username']; ?>" type="text" placeholder="{{ __('enterUsername') }}"  required="" name="username"  data-url="componentsdata/users_username_value_exist/" data-loading-msg="{{ __('checkingAvailability') }}" data-available-msg="{{ __('available') }}" data-unavailable-msg="{{ __('notAvailable') }}" class="form-control  ctrl-check-duplicate" />
                                        <div class="check-status"></div> 
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="phone">{{ __('phone') }} </label>
                                    <div id="ctrl-phone-holder" class=" "> 
                                        <input id="ctrl-phone" data-field="phone"  value="<?php  echo $data['phone']; ?>" type="text" placeholder="{{ __('enterPhone') }}"  name="phone"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="photo">{{ __('photo') }} </label>
                                    <div id="ctrl-photo-holder" class=" "> 
                                        <div class="dropzone " input="#ctrl-photo" fieldname="photo" uploadurl="{{ url('fileuploader/upload/photo') }}"    data-multiple="false" dropmsg="{{ __('chooseFilesOrDropFilesHere') }}"    btntext="{{ __('browse') }}" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="1">
                                            <input name="photo" id="ctrl-photo" data-field="photo" class="dropzone-input form-control" value="<?php  echo $data['photo']; ?>" type="text"  />
                                            <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseAChooseFile') }}</div>-->
                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                        </div>
                                    </div>
                                    <?php Html :: uploaded_files_list($data['photo'], '#ctrl-photo'); ?>
                                </div>
                            </div>
                            <input id="ctrl-company_id" data-field="company_id"  value="<?php  echo $data['company_id']; ?>" type="hidden" placeholder="{{ __('enterCompanyId') }}" list="company_id_list"  name="company_id"  class="form-control " />
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
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="user_role_id">{{ __('userRole') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-user_role_id-holder" class=" "> 
                                        <select required=""  id="ctrl-user_role_id" data-field="user_role_id" name="user_role_id"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                        <option value="">{{ __('selectAValue') }}</option>
                                        <?php
                                            $options = $comp_model->user_role_id_option_list_2() ?? [];
                                            foreach($options as $option){
                                            $value = $option->value;
                                            $label = $option->label ?? $value;
                                            $selected = ( $value == $data['user_role_id'] ? 'selected' : null );
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
                            <div class="form-group ">
                                <label class="control-label" for="is_active">{{ __('isActive') }} </label>
                                <div id="ctrl-is_active-holder" class=" "> 
                                    <?php
                                        $options = Menu::common_description();
                                        $field_value = $data['is_active'];
                                        if(!empty($options)){
                                        foreach($options as $option){
                                        $value = $option['value'];
                                        $label = $option['label'];
                                        //check if value is among checked options
                                        $checked = Html::get_record_checked($field_value, $value);
                                    ?>
                                    <label class="form-check form-check-inline">
                                    <input class="form-check-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio"   name="is_active" />
                                    <span class="form-check-label"><?php echo $label ?></span>
                                    </label>
                                    <?php
                                        }
                                        }
                                    ?>
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
