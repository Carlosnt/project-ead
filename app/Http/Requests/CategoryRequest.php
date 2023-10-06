<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('categories','name')->ignore($this->category)],
            'description' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}