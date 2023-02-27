<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("reports/add");
    $can_edit = $user->canAccess("reports/edit");
    $can_view = $user->canAccess("reports/view");
    $can_delete = $user->canAccess("reports/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = __('reports'); //set dynamic page title
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
                        {{ __('reports') }}
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
                <div class="col-md-2 comp-grid " >
                    <?php $menu_id = "menu-" . random_str(); ?>
                    <div class="mb-3 ">
                        <nav class="navbar navbar-expand-lg navbar-light">
                        <span class="navbar-brand mb-0 h4">Reports</span>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#<?php echo $menu_id ?>" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        </nav>  
                        <div class="collapse collapse-lg " id="<?php echo $menu_id ?>" >
                        <?php 
                            $arr_menu = [];
                            $menus = $comp_model->reportsid_list(); // Get menu items from database
                            if(!empty($menus)){
                            //build menu items into arrays
                            foreach($menus as $menu){
                            $count = $menu->num ?? null;
                            $arr_menu[] = array(
                            "path"=>"reports/adminlist/id/{$menu->value}?label={$menu->label}&tag=Name", 
                            "label"=>$menu->label, 
                            "count"=>$count, 
                            "icon"=>''
                            );
                            }
                            //call menu render helper.
                            Html :: render_menu($arr_menu , "nav nav-tabs flex-column");
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-10 comp-grid " >
                <?php Html::display_page_errors($errors); ?>
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
