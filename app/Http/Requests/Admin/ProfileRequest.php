<?php

namespace App\Http\Requests\Admin;

use App\Models\Tenant;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    private Tenant $tenant;

    public function __construct()
    {
        $this->tenant = auth()->user()->currentTenant;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->tenant->isOwner();
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
            'subdomain' => 'required|string|max:255|unique:tenants,subdomain,id',
            'subdomain' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tenants')->ignore($this->tenant->id),
            ],
            'about' => 'nullable|max:500',
            'logo_url' => 'nullable|image|mimes:png,jpg|max:5120',
        ];
    }
}
