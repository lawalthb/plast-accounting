<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StocksEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		
        return [
            
				"product_id" => "filled|numeric",
				"particular" => "nullable|string",
				"reg_date" => "filled|date",
				"stock_in" => "filled|numeric",
				"stock_out" => "filled|numeric",
				"stock_balance" => "filled|numeric",
				"doc_no" => "filled|string",
				"user_id" => "filled",
				"company_id" => "filled",
				"amount_in" => "filled|numeric",
				"amount_out" => "filled|numeric",
				"ledger_id" => "filled",
            
        ];
    }

	public function messages()
    {
        return [
			
            //using laravel default validation messages
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            //eg = 'name' => 'trim|capitalize|escape'
        ];
    }
}
