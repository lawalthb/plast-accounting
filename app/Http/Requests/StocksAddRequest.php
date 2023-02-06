<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StocksAddRequest extends FormRequest
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
            
				"product_id" => "required|numeric",
				"particular" => "nullable|string",
				"reg_date" => "required|date",
				"stock_in" => "required|numeric",
				"stock_out" => "required|numeric",
				"stock_balance" => "required|numeric",
				"doc_no" => "required|string",
				"user_id" => "required",
				"company_id" => "required",
				"amount_in" => "required|numeric",
				"amount_out" => "required|numeric",
				"ledger_id" => "required",
            
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
