<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'nullable',
                'string',
                'min:10',
                'max:50'
            ],
            'description' => [
                'nullable',
                'string',
                'min:10',
                'max:255'
            ],
            'content' => [
                'nullable',
                'string',
                'min:50',
                'max:1500'
            ],
        ];
    }
}
