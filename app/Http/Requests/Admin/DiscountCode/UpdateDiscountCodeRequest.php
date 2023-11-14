<?php

namespace App\Http\Requests\Admin\DiscountCode;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountCodeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code_name' => ['required', 'string'],
            'discount_value' => ['required', 'numeric' , 'min:0' , 'max:100'],
            'status' => ['required' , 'numeric'],
        ];
    }
}
