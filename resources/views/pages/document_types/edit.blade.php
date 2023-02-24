<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('editDocumentTypes'); //set dynamic page title
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
                        {{ __('editDocumentTypes') }}
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("document_types/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="name">{{ __('name') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-name-holder" class=" "> 
                                        <input id="ctrl-name" data-field="name"  value="<?php  echo $data['name']; ?>" type="text" placeholder="{{ __('enterName') }}"  required="" name="name"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="method_numbering">{{ __('methodNumbering') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-method_numbering-holder" class=" "> 
                                        <?php
                                            $options = Menu::method_numbering();
                                            $field_value = $data['method_numbering'];
                                            if(!empty($options)){
                                            foreach($options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            //check if value is among checked options
                                            $checked = Html::get_record_checked($field_value, $value);
                                        ?>
                                        <label class="form-check form-check-inline">
                                        <input class="form-check-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio" required=""   name="method_numbering" />
                                        <span class="form-check-label"><?php echo $label ?></span>
                                        </label>
                                        <?php
                                            }
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="prefix">{{ __('prefix') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-prefix-holder" class=" "> 
                                        <?php
                                            $options = Menu::prefix();
                                            $field_value = $data['prefix'];
                                            if(!empty($options)){
                                            foreach($options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            //check if value is among checked options
                                            $checked = Html::get_record_checked($field_value, $value);
                                        ?>
                                        <label class="form-check form-check-inline">
                                        <input class="form-check-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio" required=""   name="prefix" />
                                        <span class="form-check-label"><?php echo $label ?></span>
                                        </label>
                                        <?php
                                            }
                                            }
                                        ?>
                                    </div>
                                    <small class="form-text">if No is choosed, Prefix charatars will not appear </small>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="prefix_char">{{ __('prefixCharacter') }} </label>
                                    <div id="ctrl-prefix_char-holder" class=" "> 
                                        <input id="ctrl-prefix_char" data-field="prefix_char"  value="<?php  echo $data['prefix_char']; ?>" type="text" placeholder="{{ __('enterPrefixCharacter') }}"  name="prefix_char"  class="form-control " />
                                    </div>
                                    <small class="form-text">eg. INV</small>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="starting_num">{{ __('startingNum') }} </label>
                                    <div id="ctrl-starting_num-holder" class=" "> 
                                        <input id="ctrl-starting_num" data-field="starting_num"  value="<?php  echo $data['starting_num']; ?>" type="number" placeholder="{{ __('enterStartingNum') }}" min="1" step="1"  name="starting_num"  class="form-control " />
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="common_description">{{ __('commonDescription') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-common_description-holder" class=" "> 
                                        <?php
                                            $options = Menu::common_description();
                                            $field_value = $data['common_description'];
                                            if(!empty($options)){
                                            foreach($options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            //check if value is among checked options
                                            $checked = Html::get_record_checked($field_value, $value);
                                        ?>
                                        <label class="form-check form-check-inline">
                                        <input class="form-check-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio" required=""   name="common_description" />
                                        <span class="form-check-label"><?php echo $label ?></span>
                                        </label>
                                        <?php
                                            }
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="print_onsave">{{ __('printOnSave') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-print_onsave-holder" class=" "> 
                                        <?php
                                            $options = Menu::common_description();
                                            $field_value = $data['print_onsave'];
                                            if(!empty($options)){
                                            foreach($options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            //check if value is among checked options
                                            $checked = Html::get_record_checked($field_value, $value);
                                        ?>
                                        <label class="form-check form-check-inline">
                                        <input class="form-check-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio" required=""   name="print_onsave" />
                                        <span class="form-check-label"><?php echo $label ?></span>
                                        </label>
                                        <?php
                                            }
                                            }
                                        ?>
                                    </div>
                                    <small class="form-text">If Yes, document will be printed after you safe</small>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="desc_each_line">{{ __('acceptDescriptionOnEachItem') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-desc_each_line-holder" class=" "> 
                                        <?php
                                            $options = Menu::common_description();
                                            $field_value = $data['desc_each_line'];
                                            if(!empty($options)){
                                            foreach($options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            //check if value is among checked options
                                            $checked = Html::get_record_checked($field_value, $value);
                                        ?>
                                        <label class="form-check form-check-inline">
                                        <input class="form-check-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio" required=""   name="desc_each_line" />
                                        <span class="form-check-label"><?php echo $label ?></span>
                                        </label>
                                        <?php
                                            }
                                            }
                                        ?>
                                    </div>
                                    <small class="form-text">If Yes, comment will be requested on each item line</small>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="control-label" for="document_code">{{ __('under') }} <span class="text-danger">*</span></label>
                                    <div id="ctrl-document_code-holder" class=" "> 
                                        <select required=""  id="ctrl-document_code" data-field="document_code" name="document_code"  placeholder="{{ __('selectAValue') }}"    class="form-select" >
                                        <option value="">{{ __('selectAValue') }}</option>
                                        <?php
                                            $options = $comp_model->document_code_option_list() ?? [];
                                            foreach($options as $option){
                                            $value = $option->value;
                                            $label = $option->label ?? $value;
                                            $selected = ( $value == $data['document_code'] ? 'selected' : null );
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
                                <label class="control-label" for="created_by">{{ __('createdBy') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-created_by-holder" class=" "> 
                                    <input id="ctrl-created_by" data-field="created_by"  value="<?php  echo $data['created_by']; ?>" type="number" placeholder="{{ __('enterCreatedBy') }}" step="any"  required="" name="created_by"  class="form-control " />
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
