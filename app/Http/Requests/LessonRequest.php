<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('lessons','name')->ignore($this->lesson)],
            'course_id' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}