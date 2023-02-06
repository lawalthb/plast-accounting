<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionsadminEditRequest extends FormRequest
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
				"trans_date" => "filled|date",
				"party_ledger_id" => "filled",
				"against_ledger_id" => "filled",
				"document_type_id" => "filled",
				"document_type_code" => "filled|numeric",
				"total_debit" => "filled|numeric",
				"total_credit" => "filled|numeric",
            
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
