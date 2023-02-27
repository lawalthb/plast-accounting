<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Document_TypesEditRequest extends FormRequest
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
            
				"name" => "filled|string",
				"method_numbering" => "filled",
				"prefix" => "filled",
				"prefix_char" => "nullable|string",
				"starting_num" => "nullable|numeric|min:1",
				"common_description" => "filled",
				"print_onsave" => "filled",
				"desc_each_line" => "filled",
				"document_code" => "filled",
				"created_by" => "filled",
            
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
