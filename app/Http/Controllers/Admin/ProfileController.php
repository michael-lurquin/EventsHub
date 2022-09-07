<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Repositories\Tenant\TenantRepository;
use App\Http\Requests\Admin\Profile\DetailRequest;
use App\Http\Requests\Admin\Profile\CompanyRequest;
use App\Http\Requests\Admin\Profile\PasswordRequest;

class ProfileController extends Controller
{
    private TenantRepository $tenantRepository;
    private UserRepository $userRepository;

    public function __construct(TenantRepository $tenantRepository, UserRepository $userRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->userRepository = $userRepository;
    }

    public function details()
    {
        return view('admin.profile.details')->with([
            'user' => auth()->user(),
        ]);
    }

    public function updateDetails(DetailRequest $request)
    {
        $this->userRepository->update($request->user(), $request->only(['last_name', 'first_name', 'email']));

        if ( $request->hasFile('photo_url') ) $this->userRepository->updatePhoto($request->user(), $request->file('photo_url'));

        return redirect()->route('admin.profile.details')->with('success', 'Profile details updated!');
    }

    public function company()
    {
        return view('admin.profile.company')->with([
            'user' => auth()->user(),
            'tenant' => auth()->user()->currentTenant,
        ]);
    }

    public function updateCompany(CompanyRequest $request)
    {
        $tenant = $request->user()->currentTenant;

        $this->tenantRepository->update($tenant, $request->only(['name', 'email', 'subdomain', 'about', 'url']));

        if ( $request->hasFile('logo_url') ) $this->tenantRepository->updateLogo($tenant, $request->file('logo_url'));

        if ( $request->has('address') ) $this->tenantRepository->updateAddress($tenant, $request->get('address'));

        return redirect()->route('admin.profile.company')->with('success', 'Profile company updated!');
    }

    public function password()
    {
        return view('admin.profile.password')->with([
            'user' => auth()->user(),
        ]);
    }

    public function updatePassword(PasswordRequest $request)
    {
        $this->userRepository->changePassword($request->user(), $request->get('password'));

        return redirect()->route('admin.profile.password')->with('success', 'Password changed!');
    }
}
