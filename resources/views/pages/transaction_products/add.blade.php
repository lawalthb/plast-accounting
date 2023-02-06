<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = __('addNewTransactionProducts'); //set dynamic page title
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
                        {{ __('addNewTransactionProducts') }}
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
                        <form id="transaction_products-add-form"  novalidate role="form" enctype="multipart/form-data" class="form multi-form page-form" action="{{ route('transaction_products.store') }}" method="post" >
                            @csrf
                            <div>
                                <table class="table table-striped table-sm" data-maxrow="50" data-minrow="1">
                                    <thead>
                                        <tr>
                                            <th class="bg-light"><label for="product_id">{{ __('productId') }}</label></th>
                                            <th class="bg-light"><label for="quantity">{{ __('quantity') }}</label></th>
                                            <th class="bg-light"><label for="rate">{{ __('rate') }}</label></th>
                                            <th class="bg-light"><label for="amount">{{ __('amount') }}</label></th>
                                            <th class="bg-light"><label for="comment">{{ __('comment') }}</label></th>
                                            <th class="bg-light"><label for="location_id">{{ __('locationId') }}</label></th>
                                            <th class="bg-light"><label for="company_id">{{ __('companyId') }}</label></th>
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
                                    <div id="ctrl-product_id-row<?php echo $row; ?>-holder" class=" ">
                                    <input id="ctrl-product_id-row<?php echo $row; ?>" data-field="product_id"  value="<?php echo get_value('product_id') ?>" type="number" placeholder="{{ __('enterProductId') }}" step="any"  required="" name="row[<?php echo $row ?>][product_id]"  class="form-control " />
                                </div>
                            </td>
                            <td>
                                <div id="ctrl-quantity-row<?php echo $row; ?>-holder" class=" ">
                                <input id="ctrl-quantity-row<?php echo $row; ?>" data-field="quantity"  value="<?php echo get_value('quantity', "0") ?>" type="number" placeholder="{{ __('enterQuantity') }}" step="0.1"  required="" name="row[<?php echo $row ?>][quantity]"  class="form-control " />
                            </div>
                        </td>
                        <td>
                            <div id="ctrl-rate-row<?php echo $row; ?>-holder" class=" ">
                            <input id="ctrl-rate-row<?php echo $row; ?>" data-field="rate"  value="<?php echo get_value('rate', "0.00") ?>" type="number" placeholder="{{ __('enterRate') }}" step="0.1"  required="" name="row[<?php echo $row ?>][rate]"  class="form-control " />
                        </div>
                    </td>
                    <td>
                        <div id="ctrl-amount-row<?php echo $row; ?>-holder" class=" ">
                        <input id="ctrl-amount-row<?php echo $row; ?>" data-field="amount"  value="<?php echo get_value('amount', "0.00") ?>" type="number" placeholder="{{ __('enterAmount') }}" step="0.1"  required="" name="row[<?php echo $row ?>][amount]"  class="form-control " />
                    </div>
                </td>
                <td>
                    <div id="ctrl-comment-row<?php echo $row; ?>-holder" class=" ">
                    <input id="ctrl-comment-row<?php echo $row; ?>" data-field="comment"  value="<?php echo get_value('comment', "NULL") ?>" type="text" placeholder="{{ __('enterComment') }}"  name="row[<?php echo $row ?>][comment]"  class="form-control " />
                </div>
            </td>
            <td>
                <div id="ctrl-location_id-row<?php echo $row; ?>-holder" class=" ">
                <input id="ctrl-location_id-row<?php echo $row; ?>" data-field="location_id"  value="<?php echo get_value('location_id') ?>" type="number" placeholder="{{ __('enterLocationId') }}" step="any"  required="" name="row[<?php echo $row ?>][location_id]"  class="form-control " />
            </div>
        </td>
        <td>
            <div id="ctrl-company_id-row<?php echo $row; ?>-holder" class=" ">
            <input id="ctrl-company_id-row<?php echo $row; ?>" data-field="company_id"  value="<?php echo get_value('company_id') ?>" type="number" placeholder="{{ __('enterCompanyId') }}" step="any"  required="" name="row[<?php echo $row ?>][company_id]"  class="form-control " />
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
