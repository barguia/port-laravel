<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class CtlProcessHierarchyRequest extends FormRequest
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
            'hierarchy' => [
                'required',
                'min:3',
                'max:255',
                'unique:ctl_process_hierarchies,hierarchy,'.$this->route('hierarchy')
            ],
            'depth' => 'required|numeric|min:0',
        ];
    }
}
