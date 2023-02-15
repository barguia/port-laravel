<?php

namespace App\Http\Requests\Ecommerce;

use Illuminate\Foundation\Http\FormRequest;

class CtlProcessRequest extends FormRequest
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
            'process' => [
                'required',
                'min:3',
                'max:255',
                'unique:ctl_process,process,'.$this->route('process')
            ],
            'ctl_process_hierarchy_id' => [
                'required',
                'exists:ctl_process_hierarchies,id'
            ],
            'ctl_process_id' => [
                'nullable',
                'exists:ctl_process,id'
            ]
        ];
    }
}
