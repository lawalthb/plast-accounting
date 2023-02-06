<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Git_InsuranceEditRequest extends FormRequest
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
            
				"git_no" => "filled|string",
				"reg_date" => "filled|date",
				"vehicle_no" => "filled|string|min:3",
				"driver_name" => "filled|string",
				"load_from" => "filled|string",
				"going_to" => "filled|string",
				"total_amount" => "filled|numeric|min:0",
				"charges" => "nullable|numeric",
				"item_type" => "filled|string",
				"mail_sent" => "filled",
				"is_active" => "filled|string",
            
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
