<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Git_InsuranceAddRequest extends FormRequest
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
            
				"git_no" => "required|string",
				"reg_date" => "required|date",
				"vehicle_no" => "required|string|min:3",
				"driver_name" => "required|string",
				"load_from" => "required|string",
				"going_to" => "required|string",
				"total_amount" => "required|numeric|min:0",
				"charges" => "nullable|numeric",
				"item_type" => "required|string",
				"mail_sent" => "required",
            
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
