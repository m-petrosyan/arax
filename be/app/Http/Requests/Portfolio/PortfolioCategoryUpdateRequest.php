<?php

namespace App\Http\Requests\Portfolio;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PortfolioCategoryUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'unique:portfolio_categories,name,'.request()->route('portfolio_category')->id,
            ],
            'description' => ['nullable', 'string', 'min:2'],
        ];
    }
}
