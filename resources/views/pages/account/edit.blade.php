<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
?>
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-9 comp-grid " >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class="card-1 border rounded page-content" >
                        <!--[form-start]-->
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("account/edit"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <label class="control-label" for="firstname">{{ __('firstname') }} </label>
                                <div id="ctrl-firstname-holder" class=" "> 
                                    <input id="ctrl-firstname" data-field="firstname"  value="<?php  echo $data['firstname']; ?>" type="text" placeholder="{{ __('enterFirstname') }}"  name="firstname"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="lastname">{{ __('lastname') }} </label>
                                <div id="ctrl-lastname-holder" class=" "> 
                                    <input id="ctrl-lastname" data-field="lastname"  value="<?php  echo $data['lastname']; ?>" type="text" placeholder="{{ __('enterLastname') }}"  name="lastname"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="role_id">{{ __('roleId') }} </label>
                                <div id="ctrl-role_id-holder" class=" "> 
                                    <input id="ctrl-role_id" data-field="role_id"  value="<?php  echo $data['role_id']; ?>" type="number" placeholder="{{ __('enterRoleId') }}" step="any"  name="role_id"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="phone">{{ __('phone') }} </label>
                                <div id="ctrl-phone-holder" class=" "> 
                                    <input id="ctrl-phone" data-field="phone"  value="<?php  echo $data['phone']; ?>" type="text" placeholder="{{ __('enterPhone') }}"  name="phone"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
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
                            <div class="form-group ">
                                <label class="control-label" for="user_type">{{ __('userType') }} </label>
                                <div id="ctrl-user_type-holder" class=" "> 
                                    <input id="ctrl-user_type" data-field="user_type"  value="<?php  echo $data['user_type']; ?>" type="text" placeholder="{{ __('enterUserType') }}"  name="user_type"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="is_active">{{ __('isActive') }} </label>
                                <div id="ctrl-is_active-holder" class=" "> 
                                    <input id="ctrl-is_active" data-field="is_active"  value="<?php  echo $data['is_active']; ?>" type="text" placeholder="{{ __('enterIsActive') }}"  name="is_active"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="company_id">{{ __('companyId') }} </label>
                                <div id="ctrl-company_id-holder" class=" "> 
                                    <input id="ctrl-company_id" data-field="company_id"  value="<?php  echo $data['company_id']; ?>" type="number" placeholder="{{ __('enterCompanyId') }}" step="any"  name="company_id"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="username">{{ __('username') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-username-holder" class=" "> 
                                    <input id="ctrl-username" data-field="username"  value="<?php  echo $data['username']; ?>" type="text" placeholder="{{ __('enterUsername') }}"  required="" name="username"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="user_role_id">{{ __('userRoleId') }} </label>
                                <div id="ctrl-user_role_id-holder" class=" "> 
                                    <select  id="ctrl-user_role_id" data-field="user_role_id" name="user_role_id"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                    <option value="">{{ __('selectAValue') }}</option>
                                    <?php
                                        $options = $comp_model->role_id_option_list() ?? [];
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
