<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = __('superadmin'); // set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid " >
                    <div class=" h5 font-weight-bold" >
                        {{ __('superadmin') }}
                    </div>
                    <hr />
                </div>
                <div class="col-md-3 comp-grid " >
                    <?php $rec_count = $comp_model->getcount_companies();  ?>
                    <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("companies") ?>' >
                    <div class="row gutter-sm align-items-center">
                        <div class="col-auto" style="opacity: 1;">
                            <i class="material-icons">extension</i>
                        </div>
                        <div class="col">
                            <div class="flex-column justify-content align-center">
                                <div class="title">Companies</div>
                                <small class="">Total Companies</small>
                            </div>
                            <h2 class="value"><?php echo $rec_count; ?></h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 comp-grid " >
                <?php $rec_count = $comp_model->getcount_users();  ?>
                <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("users") ?>' >
                <div class="row gutter-sm align-items-center">
                    <div class="col-auto" style="opacity: 1;">
                        <i class="material-icons">extension</i>
                    </div>
                    <div class="col">
                        <div class="flex-column justify-content align-center">
                            <div class="title">Users</div>
                            <small class="">Total Users</small>
                        </div>
                        <h2 class="value"><?php echo $rec_count; ?></h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 comp-grid " >
            <?php $rec_count = $comp_model->getcount_transactions();  ?>
            <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("transactions") ?>' >
            <div class="row gutter-sm align-items-center">
                <div class="col-auto" style="opacity: 1;">
                    <i class="material-icons">extension</i>
                </div>
                <div class="col">
                    <div class="flex-column justify-content align-center">
                        <div class="title">Transactions</div>
                        <small class="">Total Transactions</small>
                    </div>
                    <h2 class="value"><?php echo $rec_count; ?></h2>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 comp-grid " >
        <?php $rec_count = $comp_model->getcount_products();  ?>
        <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("products") ?>' >
        <div class="row gutter-sm align-items-center">
            <div class="col-auto" style="opacity: 1;">
                <i class="material-icons">extension</i>
            </div>
            <div class="col">
                <div class="flex-column justify-content align-center">
                    <div class="title">Products</div>
                    <small class="">Total Products</small>
                </div>
                <h2 class="value"><?php echo $rec_count; ?></h2>
            </div>
        </div>
    </a>
</div>
<div class="col-md-3 comp-grid " >
    <?php $rec_count = $comp_model->getcount_locations();  ?>
    <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("locations") ?>' >
    <div class="row gutter-sm align-items-center">
        <div class="col-auto" style="opacity: 1;">
            <i class="material-icons">extension</i>
        </div>
        <div class="col">
            <div class="flex-column justify-content align-center">
                <div class="title">Locations</div>
                <small class="">Total Locations</small>
            </div>
            <h2 class="value"><?php echo $rec_count; ?></h2>
        </div>
    </div>
</a>
</div>
<div class="col-md-3 comp-grid " >
    <?php $rec_count = $comp_model->getcount_gitinsurance();  ?>
    <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("git_insurance") ?>' >
    <div class="row gutter-sm align-items-center">
        <div class="col-auto" style="opacity: 1;">
            <i class="material-icons">extension</i>
        </div>
        <div class="col">
            <div class="flex-column justify-content align-center">
                <div class="title">Git Insurance</div>
                <small class="">Total Git Insurance</small>
            </div>
            <h2 class="value"><?php echo $rec_count; ?></h2>
        </div>
    </div>
</a>
</div>
<div class="col-md-3 comp-grid " >
    <?php $rec_count = $comp_model->getcount_ledgers();  ?>
    <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("ledgers") ?>' >
    <div class="row gutter-sm align-items-center">
        <div class="col-auto" style="opacity: 1;">
            <i class="material-icons">extension</i>
        </div>
        <div class="col">
            <div class="flex-column justify-content align-center">
                <div class="title">Ledgers</div>
                <small class="">Total Ledgers</small>
            </div>
            <h2 class="value"><?php echo $rec_count; ?></h2>
        </div>
    </div>
</a>
</div>
<div class="col-md-3 comp-grid " >
    <?php $rec_count = $comp_model->getcount_documenttypes();  ?>
    <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("document_types") ?>' >
    <div class="row gutter-sm align-items-center">
        <div class="col-auto" style="opacity: 1;">
            <i class="material-icons">extension</i>
        </div>
        <div class="col">
            <div class="flex-column justify-content align-center">
                <div class="title">Document Types</div>
                <small class="">Total Document Types</small>
            </div>
            <h2 class="value"><?php echo $rec_count; ?></h2>
        </div>
    </div>
</a>
</div>
</div>
</div>
</div>
<div  class="mb-3" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-6 comp-grid " >
                <div class=" ">
                    <?php
                        $params = ['show_header' => false, 'show_footer' => false, 'show_pagination' => false, 'limit' => 10]; //new query param
                        $query = array_merge(request()->query(), $params);
                        $queryParams = http_build_query($query);
                        $url = url("companies/dashboardlist?$queryParams");
                    ?>
                    <div class="ajax-inline-page" data-url="{{ $url }}" >
                        <div class="ajax-page-load-indicator">
                            <div class="text-center d-flex justify-content-center load-indicator">
                                <span class="loader mr-3"></span>
                                <span class="fw-bold">{{ __('loading') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 comp-grid " >
                <div class=" ">
                    <?php
                        $params = ['show_header' => false, 'show_footer' => false, 'show_pagination' => false, 'limit' => 20]; //new query param
                        $query = array_merge(request()->query(), $params);
                        $queryParams = http_build_query($query);
                        $url = url("products/superdashboardlist?$queryParams");
                    ?>
                    <div class="ajax-inline-page" data-url="{{ $url }}" >
                        <div class="ajax-page-load-indicator">
                            <div class="text-center d-flex justify-content-center load-indicator">
                                <span class="loader mr-3"></span>
                                <span class="fw-bold">{{ __('loading') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
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
