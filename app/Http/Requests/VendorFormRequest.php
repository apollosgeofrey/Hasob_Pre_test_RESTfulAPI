<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorFormRequest extends FormRequest
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
         //$this->redirect = url('api/r/newuser') . '#comment-form';
        $rules = [
            'name' => 'required|string|max:170',
            'category' => 'required|string|max:170',
        ];

        return $rules;
    }
}
