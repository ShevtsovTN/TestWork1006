<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:10',
                'max:100'
            ],
            'description' => [
                'required',
                'string',
                'min:10',
                'max:255'
            ],
            'content' => [
                'required',
                'string',
                'min:50',
                'max:1500'
            ],
        ];
    }
}
