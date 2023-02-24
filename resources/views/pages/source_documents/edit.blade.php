<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('editSourceDocuments'); //set dynamic page title
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
                        {{ __('editSourceDocuments') }}
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("source_documents/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <label class="control-label" for="name">{{ __('name') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-name-holder" class=" "> 
                                    <input id="ctrl-name" data-field="name"  value="<?php  echo $data['name']; ?>" type="text" placeholder="{{ __('enterName') }}"  required="" name="name"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="numbering">{{ __('numbering') }} </label>
                                <div id="ctrl-numbering-holder" class=" "> 
                                    <input id="ctrl-numbering" data-field="numbering"  value="<?php  echo $data['numbering']; ?>" type="text" placeholder="{{ __('enterNumbering') }}"  name="numbering"  class="form-control " />
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
                                        $selected = ( $value == $data['document_type'] ? 'selected' : null );
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
                                    <input id="ctrl-have_comment" data-field="have_comment"  value="<?php  echo $data['have_comment']; ?>" type="number" placeholder="{{ __('enterHaveComment') }}" step="any"  required="" name="have_comment"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="auto_print">{{ __('autoPrint') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-auto_print-holder" class=" "> 
                                    <input id="ctrl-auto_print" data-field="auto_print"  value="<?php  echo $data['auto_print']; ?>" type="number" placeholder="{{ __('enterAutoPrint') }}" step="any"  required="" name="auto_print"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="display_title">{{ __('displayTitle') }} </label>
                                <div id="ctrl-display_title-holder" class=" "> 
                                    <input id="ctrl-display_title" data-field="display_title"  value="<?php  echo $data['display_title']; ?>" type="text" placeholder="{{ __('enterDisplayTitle') }}"  name="display_title"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="declaration">{{ __('declaration') }} </label>
                                <div id="ctrl-declaration-holder" class=" "> 
                                    <textarea placeholder="{{ __('enterDeclaration') }}" id="ctrl-declaration" data-field="declaration"  rows="5" name="declaration" class=" form-control"><?php  echo $data['declaration']; ?></textarea>
                                    <!--<div class="invalid-feedback animated bounceIn text-center">{{ __('pleaseEnterText') }}</div>-->
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="is_active">{{ __('isActive') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-is_active-holder" class=" "> 
                                    <input id="ctrl-is_active" data-field="is_active"  value="<?php  echo $data['is_active']; ?>" type="text" placeholder="{{ __('enterIsActive') }}"  required="" name="is_active"  class="form-control " />
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
                                        $selected = ( $value == $data['user_id'] ? 'selected' : null );
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
                                        $selected = ( $value == $data['company_id'] ? 'selected' : null );
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
                                    <input id="ctrl-for_inventory" data-field="for_inventory"  value="<?php  echo $data['for_inventory']; ?>" type="text" placeholder="{{ __('enterForInventory') }}"  required="" name="for_inventory"  class="form-control " />
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
