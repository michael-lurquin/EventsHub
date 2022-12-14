<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Repositories\User\UserRepository;
use App\Repositories\Tenant\TenantRepository;

class UserController extends Controller
{
    private UserRepository $repository;
    private TenantRepository $tenantRepository;

    public function __construct(UserRepository $userRepository, TenantRepository $tenantRepository)
    {
        $this->userRepository = $userRepository;
        $this->tenantRepository = $tenantRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $currentTab = 'all')
    {
        $users = [
            'all' => $this->userRepository->getAll(),
            'trash' => $this->userRepository->getAllTrashed(),
        ];

        return view('admin.users.index', compact('users', 'currentTab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $hasTenant = $request->get('tenant_id');

        return view('admin.users.create', compact('hasTenant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->userRepository->create($request->validated());

        if ( $request->hasFile('photo_url') ) $this->userRepository->updatePhoto($user, $request->file('photo_url'));

        if ( $request->has('tenant_id') && !empty($request->get('tenant_id')) )
        {
            $tenant = Tenant::findOrFail($request->get('tenant_id'));

            $this->userRepository->changeTenant($user, $tenant);
            $this->tenantRepository->updateOwner($tenant, $user->id);
            $this->tenantRepository->addUser($tenant, $user);

            return redirect()->route('admin.tenants.index', ['currentTab' => 'all'])->with('success', "Tenant \"{$tenant->name}\" created!");
        }

        return redirect()->route('admin.users.index', ['currentTab' => 'all'])->with('success', "User \"{$user->fullname}\" created!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->userRepository->update($user, $request->validated());

        if ( $request->hasFile('photo_url') ) $this->userRepository->updatePhoto($user, $request->file('photo_url'));

        return redirect()->route('admin.users.index', ['currentTab' => 'all'])->with('success', "User \"{$user->fullname}\" updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function confirmDestroy(User $user)
    {
        return view('admin.users.confirm', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userRepository->delete($user);

        return redirect()->route('admin.users.index', ['currentTab' => 'all'])->with('success', "User \"{$user->fullname}\" deleted!");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function restore(User $user)
    {
        $this->userRepository->restore($user);

        return redirect()->route('admin.users.index', ['currentTab' => 'all'])->with('success', "User \"{$user->fullname}\" restored!");
    }

    /**
     * Remove "force" the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy(User $user)
    {
        $this->userRepository->forceDelete($user);

        return redirect()->route('admin.users.index', ['currentTab' => 'all'])->with('success', "User \"{$user->fullname}\" deleted definitly!");
    }
}
