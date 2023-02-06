<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('editGitCustomers'); //set dynamic page title
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
                        {{ __('editGitCustomers') }}
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-vertical needs-validation" action="<?php print_link("git_customers/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <label class="control-label" for="customer_name">{{ __('customerName') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-customer_name-holder" class=" "> 
                                    <input id="ctrl-customer_name" data-field="customer_name"  value="<?php  echo $data['customer_name']; ?>" type="text" placeholder="{{ __('enterCustomerName') }}"  required="" name="customer_name"  class="form-control " />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label class="control-label" for="invoice_no">{{ __('invoiceNo') }} <span class="text-danger">*</span></label>
                                <div id="ctrl-invoice_no-holder" class=" "> 
                                    <input id="ctrl-invoice_no" data-field="invoice_no"  value="<?php  echo $data['invoice_no']; ?>" type="text" placeholder="{{ __('enterInvoiceNo') }}"  required="" name="invoice_no"  class="form-control " />
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
