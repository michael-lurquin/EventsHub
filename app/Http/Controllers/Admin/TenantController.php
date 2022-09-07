<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tenant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TenantRequest;
use App\Repositories\Tenant\TenantRepository;
use App\Repositories\User\UserRepository;

class TenantController extends Controller
{
    private TenantRepository $tenantRepository;
    private UserRepository $userRepository;

    public function __construct(TenantRepository $tenantRepository, UserRepository $userRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->userRepository = $userRepository;
    }

    private function getTabs() : array
    {
        return [
            'main',
            'address',
            'owner'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(string $currentTab = 'all')
    {
        $tenants = [
            'all' => $this->tenantRepository->getAll(),
            'expired' => $this->tenantRepository->getAllExpired(),
            'trash' => $this->tenantRepository->getAllTrashed(),
        ];

        return view('admin.tenants.index', compact('tenants', 'tenants', 'currentTab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TenantRequest $request)
    {
        $tenant = $this->tenantRepository->create($request->validated(), false);

        return redirect()->route('admin.tenants.edit', ['tenant' => $tenant, 'currentTab' => 'address'])->with('success', "Tenant \"{$tenant->name}\" created!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant, string $currentTab = 'main')
    {
        return view('admin.tenants.edit', compact('tenant', 'currentTab'))->with([
            'tabs' => $this->getTabs(),
            'owners' => $this->userRepository->getOwners(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(TenantRequest $request, Tenant $tenant, string $currentTab = 'main')
    {
        if ( $currentTab === 'main' ) $this->tenantRepository->update($tenant, $request->validated());
        else if ( $currentTab === 'address' ) $this->tenantRepository->updateAddress($tenant, $request->validated());
        else if ( $currentTab === 'owner' ) $this->tenantRepository->updateOwner($tenant, (int) $request->get('owner_id'));

        $nextTab = array_search($currentTab, $this->getTabs());

        if ( $nextTab < count($this->getTabs()) - 1 )
        {
            return redirect()->route('admin.tenants.edit', ['tenant' => $tenant, 'currentTab' => $this->getTabs()[$nextTab + 1]]);
        }
        else
        {
            return redirect()->route('admin.tenants.index', ['currentTab' => 'all'])->with('success', "Tenant \"{$tenant->name}\" updated!");
        }
    }

    /**
     * Confirm remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function confirmDestroy(Tenant $tenant)
    {
        return view('admin.tenants.confirm', compact('tenant'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        $this->tenantRepository->delete($tenant);

        return redirect()->route('admin.tenants.index', ['currentTab' => 'all'])->with('success', "Tenant \"{$tenant->name}\" deleted!");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function restore(Tenant $tenant)
    {
        $this->tenantRepository->restore($tenant);

        return redirect()->route('admin.tenants.index', ['currentTab' => 'all'])->with('success', "Tenant \"{$tenant->name}\" restored!");
    }

    /**
     * Remove "force" the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function forceDestroy(Tenant $tenant)
    {
        $this->tenantRepository->forceDelete($tenant);

        return redirect()->route('admin.tenants.index', ['currentTab' => 'all'])->with('success', "Tenant \"{$tenant->name}\" deleted definitly!");
    }
}
