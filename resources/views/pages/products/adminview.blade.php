<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("products/add");
    $can_edit = $user->canAccess("products/edit");
    $can_view = $user->canAccess("products/view");
    $can_delete = $user->canAccess("products/delete");
    $pageTitle = __('productsDetails'); //set dynamic page title
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
                        {{ __('productsDetails') }}
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
                                                    <small class="text-muted">{{ __('category') }}</small>
                                                    <div class="fw-bold">
                                                        <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("product_categories/view/$data[category]?subpage=1") ?>">
                                                        <?php echo $data['product_categories_name'] ?>
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
                                                <small class="text-muted">{{ __('image') }}</small>
                                                <div class="fw-bold">
                                                    <?php 
                                                        Html :: page_img($data['image'], 'auto', 'auto', "", 1); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-12 col-md-4">
                                    <div class="bg-light mb-3 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">{{ __('mfgDate') }}</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['mfg_date'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-12 col-md-4">
                                    <div class="bg-light mb-3 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">{{ __('expDate') }}</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['exp_date'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-12 col-md-4">
                                    <div class="bg-light mb-3 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">{{ __('qty') }}</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['qty'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-12 col-md-4">
                                    <div class="bg-light mb-3 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">{{ __('sellingPrice') }}</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['selling_price'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-12 col-md-4">
                                    <div class="bg-light mb-3 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">{{ __('purchasePrice') }}</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['purchase_price'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-12 col-md-4">
                                    <div class="bg-light mb-3 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">{{ __('deadStock') }}</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['dead_stock'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-12 col-md-4">
                                    <div class="bg-light mb-3 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">{{ __('isActive') }}</small>
                                                <div class="fw-bold">
                                                    <?php echo  $data['is_active'] ; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-12 col-md-4">
                                    <div class="bg-light mb-3 card-1 p-2 border rounded">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <small class="text-muted">{{ __('username') }}</small>
                                                <div class="fw-bold">
                                                    <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("users/view/$data[user_id]?subpage=1") ?>">
                                                    <?php echo $data['users_username'] ?>
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
                                            <small class="text-muted">{{ __('unit') }}</small>
                                            <div class="fw-bold">
                                                <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("units/view/$data[unit]?subpage=1") ?>">
                                                <?php echo $data['units_name'] ?>
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
                    </div>
                    <!--PageComponentEnd-->
                    <div class="d-flex gap-1 justify-content-start">
                        <?php if($can_edit){ ?>
                        <a class="btn btn-sm btn-success has-tooltip "   title="{{ __('edit') }}" href="<?php print_link("products/edit/$rec_id"); ?>" >
                        <i class="material-icons">edit</i> {{ __('edit') }}
                    </a>
                    <?php } ?>
                    <?php if($can_delete){ ?>
                    <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal" title="{{ __('delete') }}" href="<?php print_link("products/delete/$rec_id?redirect=products"); ?>" >
                    <i class="material-icons">delete_sweep</i> {{ __('delete') }}
                </a>
                <?php } ?>
            </div>
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
