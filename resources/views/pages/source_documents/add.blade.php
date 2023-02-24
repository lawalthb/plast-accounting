<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewSourceDocuments'); //set dynamic page title
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
                        {{ __('addNewSourceDocuments') }}
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
                        <form id="source_documents-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="{{ route('source_documents.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="name">{{ __('name') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-name-holder" class=" "> 
                                        <input id="ctrl-name" data-field="name"  value="<?php echo get_value('name') ?>" type="text" placeholder="{{ __('enterName') }}"  required="" name="name"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="numbering">{{ __('numbering') }} </label>
                                    <div id="ctrl-numbering-holder" class=" "> 
                                        <input id="ctrl-numbering" data-field="numbering"  value="<?php echo get_value('numbering', "'Automatic'") ?>" type="text" placeholder="{{ __('enterNumbering') }}"  name="numbering"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="document_type">{{ __('documentType') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-document_type-holder" class=" "> 
                                        <select required=""  id="ctrl-document_type" data-field="document_type" name="document_type"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                        <option value="">{{ __('selectAValue') }}</option>
                                        <?php 
                                            $options = $comp_model->document_type_option_list() ?? [];
                                            foreach($options as $option){
                                            $value = $option->value;
                                            $label = $option->label ?? $value;
                                            $selected = Html::get_field_selected('document_type', $value, "");
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
                                    <label class="control-label" for="have_comment">{{ __('haveComment') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-have_comment-holder" class=" "> 
                                        <input id="ctrl-have_comment" data-field="have_comment"  value="<?php echo get_value('have_comment', "1") ?>" type="number" placeholder="{{ __('enterHaveComment') }}" step="any"  required="" name="have_comment"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="auto_print">{{ __('autoPrint') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-auto_print-holder" class=" "> 
                                        <input id="ctrl-auto_print" data-field="auto_print"  value="<?php echo get_value('auto_print', "0") ?>" type="number" placeholder="{{ __('enterAutoPrint') }}" step="any"  required="" name="auto_print"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="display_title">{{ __('displayTitle') }} </label>
                                    <div id="ctrl-display_title-holder" class=" "> 
                                        <input id="ctrl-display_title" data-field="display_title"  value="<?php echo get_value('display_title', "NULL") ?>" type="text" placeholder="{{ __('enterDisplayTitle') }}"  name="display_title"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="declaration">{{ __('declaration') }} </label>
                                    <div id="ctrl-declaration-holder" class=" "> 
                                        <textarea placeholder="{{ __('enterDeclaration') }}" id="ctrl-declaration" data-field="declaration"  rows="5" name="declaration" class=" form-control"><?php echo get_value('declaration') ?></textarea>
                                        <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseEnterText') }}</div>-->
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label" for="is_active">{{ __('isActive') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-is_active-holder" class=" "> 
                                        <input id="ctrl-is_active" data-field="is_active"  value="<?php echo get_value('is_active', "'Yes'") ?>" type="text" placeholder="{{ __('enterIsActive') }}"  required="" name="is_active"  class="form-control " />
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
                                            $selected = Html::get_field_selected('user_id', $value, "");
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
                                    <label class="control-label" for="for_inventory">{{ __('forInventory') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-for_inventory-holder" class=" "> 
                                        <input id="ctrl-for_inventory" data-field="for_inventory"  value="<?php echo get_value('for_inventory', "'Yes'") ?>" type="text" placeholder="{{ __('enterForInventory') }}"  required="" name="for_inventory"  class="form-control " />
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
