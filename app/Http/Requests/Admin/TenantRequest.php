<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255',
            'subdomain' => [
                'required',
                'string',
                'max:255',
                'unique:tenants,subdomain',
                // Rule::unique('tenants')->ignore($this->tenant->id),
            ],
            'ends_at' => 'nullable|date_format:Y-m-d|after_or_equal:today',
            'about' => 'nullable|max:500',
            'logo_url' => 'nullable|image|mimes:png,jpg|max:5120',
            'url' => 'nullable|url|max:255',
        ];
    }
}
