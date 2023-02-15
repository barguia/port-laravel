<?php

namespace App\Http\Requests\Workflow;

use Illuminate\Foundation\Http\FormRequest;

class CtlProductRequest extends FormRequest
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
            'product' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:ctl_products,product,'.$this->route('product'),
            ],
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0.01'
        ];
    }
}
