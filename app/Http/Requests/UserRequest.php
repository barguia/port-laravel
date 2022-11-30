<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
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
            'id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:55',
            'email' => 'required|email|unique:users,email,'.$this->route('user'),
            'password' => 'required|confirmed',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function validator(Factory $factory, Request $request)
    {
        $validator = $factory->make(
            $this->input(),
            $this->rules(),
            $this->messages(),
            $this->attributes()
        );

        if ($this->route('user') && $this->route('user') != auth()->user()->id) {
            throw ValidationException::withMessages([
                'email' => array("You can't change another user"),
            ]);
        }

        return $validator;
    }
}
