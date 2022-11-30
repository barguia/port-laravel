<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AclProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'profile' => [
                'required',
                'min:3',
                'max:50',
                'unique:acl_profiles,profile,'.$this->route('profile')
            ]
        ];
    }
}
