<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("document_types/add");
    $can_edit = $user->canAccess("document_types/edit");
    $can_view = $user->canAccess("document_types/view");
    $can_delete = $user->canAccess("document_types/delete");
    $pageTitle = __('documentTypesDetails'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="view" data-page-url="{{ url()->full() }}">
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
                        {{ __('documentTypesDetails') }}
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
                <div class="col-md-12 comp-grid " >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class=" page-content" >
                        <?php
                            $counter = 0;
                            if($data){
                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                            $counter++;
                        ?>
                        <div id="page-main-content" class=" px-3 mb-3">
                            <div class="row gutter-lg ">
                                <div class="col">
                                    <div class="page-data">
                                        <!--PageComponentStart-->
                                        <div class="mb-3 row row gutter-lg">
                                            <div class=" col-12 col-md-4">
                                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('id') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['id'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 col-md-4">
                                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('name') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['name'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 col-md-4">
                                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('methodNumbering') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['method_numbering'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 col-md-4">
                                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('prefix') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['prefix'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 col-md-4">
                                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('startingNum') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['starting_num'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 col-md-4">
                                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('commonDescription') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['common_description'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 col-md-4">
                                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('printOnsave') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['print_onsave'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 col-md-4">
                                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('descEachLine') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['desc_each_line'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 col-md-4">
                                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('documentCode') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['document_code'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 col-md-4">
                                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('companyId') }}</small>
                                                            <div class="fw-bold">
                                                                <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("companies/view/$data[company_id]?subpage=1") ?>">
                                                                <i class="material-icons">visibility</i> <?php echo "Companies Detail" ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-12 col-md-4">
                                            <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <small class="text-muted">{{ __('dateCreated') }}</small>
                                                        <div class="fw-bold">
                                                            <?php echo  $data['date_created'] ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-12 col-md-4">
                                            <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <small class="text-muted">{{ __('dateUpdated') }}</small>
                                                        <div class="fw-bold">
                                                            <?php echo  $data['date_updated'] ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-12 col-md-4">
                                            <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <small class="text-muted">{{ __('prefixChar') }}</small>
                                                        <div class="fw-bold">
                                                            <?php echo  $data['prefix_char'] ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-12 col-md-4">
                                            <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <small class="text-muted">{{ __('createdBy') }}</small>
                                                        <div class="fw-bold">
                                                            <?php echo  $data['created_by'] ; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--PageComponentEnd-->
                                    <div class="d-flex gap-1 justify-content-start">
                                        <?php if($can_edit){ ?>
                                        <a class="btn btn-sm btn-success has-tooltip "   title="{{ __('edit') }}" href="<?php print_link("document_types/edit/$rec_id"); ?>" >
                                        <i class="material-icons">edit</i> {{ __('edit') }}
                                    </a>
                                    <?php } ?>
                                    <?php if($can_delete){ ?>
                                    <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal" title="{{ __('delete') }}" href="<?php print_link("document_types/delete/$rec_id?redirect=document_types"); ?>" >
                                    <i class="material-icons">delete_sweep</i> {{ __('delete') }}
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- Detail Page Column -->
                    <?php if(!request()->has('subpage')){ ?>
                    <div class="col-12">
                        <div class="my-3 p-1 ">
                            @include("pages.document_types.detail-pages", ["masterRecordId" => $rec_id])
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php
                }
                else{
            ?>
            <!-- Empty Record Message -->
            <div class="text-muted p-3">
                <i class="material-icons">block</i> {{ __('noRecordFound') }}
            </div>
            <?php
                }
            ?>
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
