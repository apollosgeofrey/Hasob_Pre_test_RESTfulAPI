<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
        if (request()->isMethod('POST')) {
         $rules = [
                'firstName' => 'required|string|max:100',
                'lastName' => 'required|string|max:100',
                'middleName' => 'string|max:100',
                'email' => 'required|unique:users,email',
                'phoneNumber' => 'required|numeric',
                'password' => 'required|string',/*'current_password', //this can be added if need for authentication*/
            ];
        } else if(request()->isMethod('PUT')) {
            $rules = [
                'token' => 'required',
                'firstName' => 'sometimes|string|max:100',
                'lastName' => 'sometimes|string|max:100',
                'middleName' => 'string|max:100',
                'phoneNumber' => 'sometimes|numeric',
                'password' => 'sometimes|string',/*'current_password', //this can be added if need for authentication*/
            ];
        }
        return $rules;
    }
}
    