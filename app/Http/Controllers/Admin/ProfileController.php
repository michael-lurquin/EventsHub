<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Admin\ProfileRequest;
use App\Http\Requests\Admin\PasswordRequest;
use App\Repositories\Tenant\TenantRepository;

class ProfileController extends Controller
{
    private TenantRepository $tenantRepository;
    private UserRepository $userRepository;

    public function __construct(TenantRepository $tenantRepository, UserRepository $userRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->userRepository = $userRepository;
    }

    public function account()
    {
        return view('admin.profile.account')->with([
            'user' => auth()->user(),
        ]);
    }

    public function updateAccount(UserRequest $request)
    {
        $this->userRepository->update($request->user(), $request->only(['last_name', 'first_name', 'email']));

        if ( $request->hasFile('photo_url') ) $this->userRepository->updatePhoto($request->user(), $request->file('photo_url'));

        return redirect()->back()->with('success', 'Profile account updated!');
    }

    public function company()
    {
        $countries = listOfCountries();

        return view('admin.profile.company', compact('countries'))->with([
            'user' => auth()->user(),
            'tenant' => auth()->user()->load('currentTenant.address')->currentTenant,
        ]);
    }

    public function updateCompany(ProfileRequest $request)
    {
        $tenant = $request->user()->currentTenant;

        $this->tenantRepository->update($tenant, $request->only(['name', 'email', 'subdomain', 'about', 'url']));

        if ( $request->hasFile('logo_url') ) $this->tenantRepository->updateLogo($tenant, $request->file('logo_url'));

        if ( $request->has('address') ) $this->tenantRepository->updateAddress($tenant, $request->get('address'));

        return redirect()->back()->with('success', 'Profile company updated!');
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

        return redirect()->back()->with('success', 'Password changed!');
    }
}
