<?php

namespace App\Http\Requests;

use App\DTO\ExtraFieldEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetFieldsAdvertRequest extends FormRequest
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
            'fields' => [
                'filled',
                'array'
            ],
            'fields.*' => [
                Rule::enum(ExtraFieldEnum::class),
            ]
        ];
    }
}
