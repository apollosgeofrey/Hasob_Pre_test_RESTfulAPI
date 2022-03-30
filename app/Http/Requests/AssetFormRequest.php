<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetFormRequest extends FormRequest
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
            'type' => 'required|string',
            'serialNumber' => 'required|string|unique:asset_models,serialNumber',
            'description' => 'string|required',
            'picturePath' => 'string',
            'purchasePrice' => 'required|numeric|max:10000000',
            'location' => 'string',
            /*'current_password', //this can be added if need for authentication*/
        ];

        return $rules;
    }
}
