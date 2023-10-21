<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    public function rules()
    {
        return [
            'image' => ['required','image','mimes:jpg,png,jpeg,gif,svg','max:1024']
        ];
    }

    public function authorize()
    {
        return true;
    }
}