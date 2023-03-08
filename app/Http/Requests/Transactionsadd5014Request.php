<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Transactionsadd5014Request extends FormRequest
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
            
				"trans_no" => "nullable|string",
				"reference" => "nullable|string",
				"trans_date" => "required|date",
				"party_ledger_id" => "required",
				"against_ledger_id" => "nullable",
				"document_type_id" => "nullable",
				"document_type_code" => "required",
				"total_debit" => "required|numeric",
				"total_credit" => "required",
            
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
