<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255',Rule::unique('courses','name')->ignore($this->course)],
            'category_id' => ['required'],            
            'image' => ['nullable'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}