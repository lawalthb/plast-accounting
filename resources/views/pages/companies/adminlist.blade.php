<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("companies/add");
    $can_edit = $user->canAccess("companies/edit");
    $can_view = $user->canAccess("companies/view");
    $can_delete = $user->canAccess("companies/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = __('companies'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">
                <div class="col col-md-auto  " >
                    <div class=" h5 font-weight-bold text-primary" >
                        {{ __('companies') }}
                    </div>
                </div>
                <div class="col-md-3  " >
                    <!-- Page drop down search component -->
                    <form  class="search" action="{{ url()->current() }}" method="get">
                        <input type="hidden" name="page" value="1" />
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="{{ __('search') }}" />
                            <button class="btn btn-primary"><i class="material-icons">search</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-12 comp-grid " >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class=" page-content" >
                        <div id="companies-adminlist-records">
                            <?php
                                if($total_records){
                            ?>
                            <div id="page-main-content">
                                <?php Html::page_bread_crumb("/companies/adminlist", $field_name, $field_value); ?>
                                <div class="row gutter-lg page-data">
                                    <!--record-->
                                    <?php
                                        $counter = 0;
                                        foreach($records as $data){
                                        $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                        $counter++;
                                    ?>
                                    <!--PageComponentStart-->
                                    <div class=" col-12 col-md-4">
                                        <div class="bg-light mb-3 card-1 p-2 border rounded">
                                            <a data-page-id="companies-detail-page" class="btn btn-sm btn-secondary open-master-detail-page" href="<?php print_link("companies/masterdetail/$data[id]"); ?>">
                                            <i class="material-icons">more_vert</i> 
                                        </a>
                                        <div class="p-2">
                                            <a href="<?php print_link("companies/view/$data[id]") ?>">
                                            <span class="text-muted d-inline-block mr-2 d-block">
                                            {{ __('id') }}
                                            </span>
                                            <?php echo $data['id']; ?></a>
                                        </div>
                                        <div class="p-2">
                                            <span class="text-muted d-inline-block mr-2 d-block">
                                            {{ __('name') }}
                                            </span>
                                            <?php echo  $data['name'] ; ?>
                                        </div>
                                        <div class="p-2">
                                            <span class="text-muted d-inline-block mr-2 d-block">
                                            {{ __('address') }}
                                            </span>
                                            <?php echo str_truncate( $data['address'] , 20,'...'); ?>
                                        </div>
                                        <div class="p-2">
                                            <a href="<?php print_link("mailto:$data[com_email]") ?>">
                                            <span class="text-muted d-inline-block mr-2 d-block">
                                            {{ __('email') }}
                                            </span>
                                            <?php echo $data['com_email']; ?></a>
                                        </div>
                                        <div class="p-2">
                                            <?php 
                                                Html :: page_img($data['logo'], '50px', '50px', "small", 1); 
                                            ?>
                                        </div>
                                        <div class="p-2">
                                            <span class="text-muted d-inline-block mr-2 d-block">
                                            {{ __('dateCreated') }}
                                            </span>
                                            <?php echo  $data['date_created'] ; ?>
                                        </div>
                                        <div class="d-flex gap-1 justify-content-between">
                                            <?php if($can_edit){ ?>
                                            <a class="btn btn-sm btn-success has-tooltip "    href="<?php print_link("companies/edit/$rec_id"); ?>" >
                                            <i class="material-icons">edit</i> {{ __('edit') }}
                                        </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!--PageComponentEnd-->
                            <?php 
                                }
                            ?>
                            <!--endrecord-->
                        </div>
                        <div class="row gutter-lg search-data"></div>
                        <div>
                        </div>
                    </div>
                    <?php
                        if($show_footer){
                    ?>
                    <div class=" mt-3">
                        <div class="row justify-content-between">   
                            <div class="col-md-auto">   
                            </div>
                            <div class="col">       
                                <?php
                                    if($show_pagination == true){
                                    $pager = new Pagination($total_records, $record_count);
                                    $pager->show_page_count = false;
                                    $pager->show_record_count = true;
                                    $pager->show_page_limit =false;
                                    $pager->limit = $limit;
                                    $pager->show_page_number_list = true;
                                    $pager->pager_link_range=5;
                                    $pager->render();
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                        }
                        else{
                    ?>
                    <div class="text-muted  animated bounce p-3">
                        <h4><i class="material-icons">block</i> {{ __('noRecordFound') }}</h4>
                    </div>
                    <?php
                        }
                    ?>
                </div>
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
