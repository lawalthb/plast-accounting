<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Document_TypesAddRequest extends FormRequest
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
            
				"name" => "required|string",
				"method_numbering" => "required",
				"prefix" => "required",
				"prefix_char" => "nullable|string",
				"starting_num" => "nullable|numeric|min:1",
				"common_description" => "required",
				"print_onsave" => "required",
				"desc_each_line" => "required",
				"document_code" => "required",
				"created_by" => "required",
				"date_created" => "nullable|date",
            
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
