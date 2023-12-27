<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status' => ['required']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
