<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdvertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:200',
            ],
            'description' => [
                'required',
                'string',
                'max:2000'
            ],
            'price' => [
                'required',
                'integer',
                'between:1,999999999'
            ],
            'photos' => [
                'required',
                'array',
                'between:1,3'
            ],
            'photos.*' => [
                'url:https',
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'photos.0' => 'photo #1',
            'photos.1' => 'photo #2',
            'photos.2' => 'photo #3',
        ];
    }
}
