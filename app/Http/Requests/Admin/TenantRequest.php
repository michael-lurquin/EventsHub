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
        $rules = [];

        if ( $this->currentTab === 'address' )
        {
            $rules = [
                'street' => 'nullable|string|max:500',
                'post_code' => 'nullable|string|max:10',
                'city' => 'nullable|string|max:60',
                'state' => 'nullable|string|max:60',
                'country_code' => 'nullable|string|size:3',
            ];
        }
        else if ( $this->currentTab === 'owner' )
        {
            $rules = [
                'owner_id' => 'required|exists:users,id',
            ];
        }
        else
        {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|string|max:255',
                'ends_at' => 'nullable|date_format:Y-m-d|after_or_equal:today',
                'about' => 'nullable|max:500',
                'logo_url' => 'nullable|image|mimes:png,jpg|max:5120',
                'url' => 'nullable|url|max:255',
            ];
    
            if ( $this->getMethod() === 'POST' )
            {
                $rules['subdomain'] = [
                    'required',
                    'string',
                    'max:255',
                    'unique:tenants,subdomain',
                ];
            }
            else
            {
                $rules['subdomain'] = [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('tenants')->ignore($this->tenant->id),
                ];
            }
        }

        return $rules;
    }
}
