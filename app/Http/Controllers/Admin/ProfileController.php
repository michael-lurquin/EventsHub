<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Repositories\Tenant\TenantRepository;

class ProfileController extends Controller
{
    public function profile()
    {
        $tenant = auth()->user()->currentTenant;

        return view('admin.profile', compact('tenant'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $tenant = auth()->user()->currentTenant;

        $repoTenant = new TenantRepository();
        
        $repoTenant->update($tenant, $request->validated());

        if ( $request->hasFile('logo_url') ) $repoTenant->updateLogo($tenant, $request->file('logo_url'));

        return redirect()->back()->with('success', 'Profile updated!');
    }
}
