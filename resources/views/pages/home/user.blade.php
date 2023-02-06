<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = __('user'); // set dynamic page title
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
                        {{ __('user') }}
                    </div>
                    <hr />
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
