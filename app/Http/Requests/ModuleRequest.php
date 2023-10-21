<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255',Rule::unique('modules','name')->ignore($this->module)],
            'course_id' => ['required'],            
        ];
    }

    public function authorize()
    {
        return true;
    }
}