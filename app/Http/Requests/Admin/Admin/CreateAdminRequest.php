<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'gender' => ['required'],
            'age' => ['required', 'numeric' , 'min:18' , 'max:100'],
            'status' => ['required' , 'numeric'],
            'type' => ['required' , 'string' ],
            'phone' => ['required', 'numeric', 'digits:10'],
            'img'=> ['required'],
        ];
    }
}
