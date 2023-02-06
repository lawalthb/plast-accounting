<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addCustomersDetails'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
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
                        {{ __('addNewGitCustomers') }}
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
                        <form id="git_customers-add-form"  novalidate role="form" enctype="multipart/form-data" class="form multi-form page-form" action="{{ route('git_customers.store') }}" method="post" >
                            @csrf
                            <div>
                                <table class="table table-striped table-sm" data-maxrow="20" data-minrow="1">
                                    <thead>
                                        <tr>
                                            <th class="bg-light"><label for="customer_name">{{ __('customerName') }}</label></th>
                                            <th class="bg-light"><label for="invoice_no">{{ __('invoiceNo') }}</label></th>
                                            <th class="bg-light"><label for="amount">{{ __('amount') }}</label></th>
                                            <th class="bg-light"><label for="comment">{{ __('comment') }}</label></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="100" class="text-right">
                                        <?php $template_id = "table-row-" . random_str(); ?>
                                        <button type="button" data-template="#<?php echo $template_id ?>" class="btn btn-sm btn-success btn-add-table-row"><i class="material-icons">add</i></button>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <!--[table row template]-->
                                <template id="<?php echo $template_id ?>">
                                <?php $row = "CURRENTROW"; // will be replaced with current row index. ?>
                                <tr data-row="<?php echo $row ?>" class="input-row">
                                <td>
                                    <div id="ctrl-customer_name-row<?php echo $row; ?>-holder" class=" ">
                                    <input id="ctrl-customer_name-row<?php echo $row; ?>" data-field="customer_name"  value="<?php echo get_value('customer_name') ?>" type="text" placeholder="{{ __('enterCustomerName') }}"  required="" name="row[<?php echo $row ?>][customer_name]"  class="form-control " />
                                </div>
                            </td>
                            <td>
                                <div id="ctrl-invoice_no-row<?php echo $row; ?>-holder" class=" ">
                                <input id="ctrl-invoice_no-row<?php echo $row; ?>" data-field="invoice_no"  value="<?php echo get_value('invoice_no') ?>" type="text" placeholder="{{ __('enterInvoiceNo') }}"  required="" name="row[<?php echo $row ?>][invoice_no]"  class="form-control " />
                            </div>
                        </td>
                        <td>
                            <div id="ctrl-amount-row<?php echo $row; ?>-holder" class=" ">
                            <input id="ctrl-amount-row<?php echo $row; ?>" data-field="amount"  value="<?php echo get_value('amount', "0.00") ?>" type="number" placeholder="{{ __('enterAmount') }}" step="0.1"  required="" name="row[<?php echo $row ?>][amount]"  class="form-control " />
                        </div>
                    </td>
                    <td>
                        <div id="ctrl-comment-row<?php echo $row; ?>-holder" class=" ">
                        <input id="ctrl-comment-row<?php echo $row; ?>" data-field="comment"  value="<?php echo get_value('comment') ?>" type="text" placeholder="{{ __('enterComment') }}"  name="row[<?php echo $row ?>][comment]"  class="form-control " />
                    </div>
                </td>
                <th class="text-center">
                <button type="button" class="btn-close btn-remove-table-row"></button>
                </th>
            </tr>
        </template>
        <!--[/table row template]-->
    </div>
    <div class="form-ajax-status"></div>
    <!--[form-button-start]-->
    <div class="form-group form-submit-btn-holder text-center mt-3">
        <button class="btn btn-primary" type="submit">
        {{ __('submit') }}
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
    
$(document).ready(function(){
	// custom javascript | jquery codes
});

</script>
@endsection
