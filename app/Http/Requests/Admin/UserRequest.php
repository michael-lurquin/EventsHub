<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'photo_url' => 'nullable|image|mimes:png,jpg|max:5120',
        ];
    
        if ( $this->getMethod() === 'POST' )
        {
            $rules['email'] = [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ];
        }
        else
        {
            $rules['email'] = [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user->id),
            ];
        }

        return $rules;
    }
}
