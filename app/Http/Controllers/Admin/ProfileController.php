<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Admin\ProfileRequest;
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

    public function profile()
    {
        $user = auth()->user();
        $countries = listOfCountries();

        return view('admin.profile', compact('countries'))->with([
            'user' => $user,
            'tenant' => $user->load('currentTenant.address')->currentTenant,
        ]);
    }

    public function updatePersonal(UserRequest $request)
    {
        $this->userRepository->update($request->user(), [
            'last_name' => $request->get('last_name'),
            'first_name' => $request->get('first_name'),
            'email' => $request->get('email'),
        ]);

        if ( $request->hasFile('photo_url') ) $this->userRepository->updatePhoto($request->user(), $request->file('photo_url'));

        return redirect()->back()->with('success', 'Personal information updated!');
    }

    public function updateProfile(ProfileRequest $request)
    {
        $tenant = $request->user()->currentTenant;

        $this->tenantRepository->update($tenant, $request->except(['address', 'logo_url']));

        if ( $request->hasFile('logo_url') ) $this->tenantRepository->updateLogo($tenant, $request->file('logo_url'));

        if ( $request->has('address') ) $this->tenantRepository->updateAddress($tenant, $request->get('address'));

        return redirect()->back()->with('success', 'Profile updated!');
    }
}