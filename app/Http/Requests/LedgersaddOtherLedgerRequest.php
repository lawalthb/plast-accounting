<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LedgersaddOtherLedgerRequest extends FormRequest
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
            
				"sub_account_group_id" => "required",
				"ledger_name" => "required|string",
				"marketer_id" => "required",
				"address" => "nullable",
				"email" => "nullable",
				"phone" => "nullable",
				"contact_person" => "nullable",
				"credit_amount" => "required|numeric|min:0",
				"debit_amount" => "required|numeric|min:0",
				"is_active" => "nullable",
				"code" => "nullable",
            
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
