<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Source_DocumentsEditRequest extends FormRequest
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
				"numbering" => "nullable|string",
				"document_type" => "filled",
				"have_comment" => "filled|numeric",
				"auto_print" => "filled|numeric",
				"display_title" => "nullable|string",
				"declaration" => "nullable",
				"is_active" => "filled|string",
				"user_id" => "filled",
				"company_id" => "filled",
				"for_inventory" => "filled|string",
            
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
