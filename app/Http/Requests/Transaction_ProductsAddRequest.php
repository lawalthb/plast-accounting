<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Transaction_ProductsAddRequest extends FormRequest
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
            
				"row.*.product_id" => "required|numeric",
				"row.*.quantity" => "required|numeric",
				"row.*.rate" => "required|numeric",
				"row.*.amount" => "required|numeric",
				"row.*.comment" => "nullable|string",
				"row.*.location_id" => "required|numeric",
				"row.*.company_id" => "required|numeric",
            
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
