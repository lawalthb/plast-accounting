<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersEditRequest extends FormRequest
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
		
		$rec_id = request()->route('rec_id');

        return [
            
				"firstname" => "filled|string",
				"lastname" => "filled|string",
				"email" => "filled|email|unique:users,email,$rec_id,id",
				"username" => "filled|string|unique:users,username,$rec_id,id",
				"phone" => "nullable|string",
				"photo" => "nullable",
				"company_id" => "nullable",
				"user_role_id" => "filled",
				"is_active" => "nullable",
				"user_type" => "nullable|string",
            
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
