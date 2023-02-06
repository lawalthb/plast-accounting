<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('editTransactionProducts'); //set dynamic page title
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
                        {{ __('editTransactionProducts') }}
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("transaction_products/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <label class="control-label" for="product_id">{{ __('productId') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-product_id-holder" class=" "> 
                                    <input id="ctrl-product_id" data-field="product_id"  value="<?php  echo $data['product_id']; ?>" type="number" placeholder="{{ __('enterProductId') }}" step="any"  required="" name="product_id"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="quantity">{{ __('quantity') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-quantity-holder" class=" "> 
                                    <input id="ctrl-quantity" data-field="quantity"  value="<?php  echo $data['quantity']; ?>" type="number" placeholder="{{ __('enterQuantity') }}" step="0.1"  required="" name="quantity"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="rate">{{ __('rate') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-rate-holder" class=" "> 
                                    <input id="ctrl-rate" data-field="rate"  value="<?php  echo $data['rate']; ?>" type="number" placeholder="{{ __('enterRate') }}" step="0.1"  required="" name="rate"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="amount">{{ __('amount') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-amount-holder" class=" "> 
                                    <input id="ctrl-amount" data-field="amount"  value="<?php  echo $data['amount']; ?>" type="number" placeholder="{{ __('enterAmount') }}" step="0.1"  required="" name="amount"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="comment">{{ __('comment') }} </label>
                                <div id="ctrl-comment-holder" class=" "> 
                                    <input id="ctrl-comment" data-field="comment"  value="<?php  echo $data['comment']; ?>" type="text" placeholder="{{ __('enterComment') }}"  name="comment"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="location_id">{{ __('locationId') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-location_id-holder" class=" "> 
                                    <input id="ctrl-location_id" data-field="location_id"  value="<?php  echo $data['location_id']; ?>" type="number" placeholder="{{ __('enterLocationId') }}" step="any"  required="" name="location_id"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="company_id">{{ __('companyId') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-company_id-holder" class=" "> 
                                    <input id="ctrl-company_id" data-field="company_id"  value="<?php  echo $data['company_id']; ?>" type="number" placeholder="{{ __('enterCompanyId') }}" step="any"  required="" name="company_id"  class="form-control " />
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
