<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'required', 'email', 'string', 'max:255', Rule::unique('users','email')->ignore($this->user)],
            'password' => ['nullable','string', 'min:6','max:15'],
            'image' => ['nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1024']
        ];
    }

    public function authorize()
    {
        return true;
    }
}