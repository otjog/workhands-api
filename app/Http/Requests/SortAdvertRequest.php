<?php

namespace App\Http\Requests;

use App\DTO\SortFieldEnum;
use App\DTO\SortOrderEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SortAdvertRequest extends FormRequest
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
            'sort' => [
                'filled',
                Rule::enum(SortFieldEnum::class),
            ],
            'order' => [
                'filled',
                Rule::enum(SortOrderEnum::class),
            ],

        ];
    }
}
