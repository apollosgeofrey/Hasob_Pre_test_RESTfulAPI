<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetAssignmentFormRequest extends FormRequest
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
        $rules = [
            'assetId' => 'required|numeric|exists:asset_models,id',
            'assignmentDate' => 'string|max:100',
            'status' => 'string|max:100',
            'assignedUserId' => 'required|numeric|exists:users,id',
            'assignedBy' => 'required|string',/*'current_password', //this can be added if need for authentication*/
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'assetId.exists' => 'The asset ID passed does not exits in our Assets Record',
            'assignedUserId.exists'  => 'The User ID passed does not exits in our Users Records',
        ];

        return $messages;
    }
}
