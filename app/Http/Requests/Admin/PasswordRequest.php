<?php

namespace App\Http\Requests\Admin;

use Laravel\Fortify\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'current_password' => 'required|current_password|min:8',
            'password' => [
                'required',
                'string',
                'different:current_password',
                'confirmed',
                new Password,
            ],
        ];
    }
}
