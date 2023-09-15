<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormEntryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'max:100',
            ],
            'last_name' => [
                'required',
                'max:100',
            ],
            'attachment' => [
                'required',
                'image',
                'max:2048',
            ],
        ];
    }
}
