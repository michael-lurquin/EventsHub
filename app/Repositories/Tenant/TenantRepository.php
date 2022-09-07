<?php

namespace App\Repositories\Tenant;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\UploadedFile;
use App\Notifications\TenantInvitation;
use Illuminate\Pagination\LengthAwarePaginator;

class TenantRepository
{
    public function getAll() : LengthAwarePaginator
    {
        return Tenant::with('owner')->withCount('users')->orderByDesc('created_at')->paginate(10);
    }

    public function create(array $data, bool $notification = false) : Tenant
    {
        if ( empty($data['owner_id']) ) $data['owner_id'] = auth()->user()->id;

        $tenant = Tenant::create($data);

        if ( $notification ) $this->sendInvitation($tenant);

        return $tenant;
    }

    public function update(Tenant $tenant, array $data) : void
    {
        $tenant->updateOrFail($data);
    }

    public function updateLogo(Tenant $tenant, UploadedFile $file) : void
    {
        $path = 'cdn/tenants/logos';
        $filename = $file->hashName();

        $file->move(public_path($path), $filename);

        $tenant->updateOrFail([
            'logo_url' => "{$path}/{$filename}",
        ]);
    }

    public function delete(Tenant $tenant) : void
    {
        $tenant->deleteOrFail();
    }

    public function deleteForce(Tenant $tenant) : void
    {
        $tenant->users()->sync([]);
        $tenant->forceDelete();
    }

    public function restore(Tenant $tenant) : void
    {
        $tenant->restore();
    }

    public function addUser(Tenant $tenant, User $user)
    {
        $tenant->users()->attach($user);
    }

    public function removeUser(Tenant $tenant, User $user)
    {
        $tenant->users()->detach($user);
    }

    public function sendInvitation(Tenant $tenant)
    {
        // $url = URL::signedRoute('tenants.invitation', $tenant);

        $tenant->notify(new TenantInvitation($tenant, 'fake-url'));
    }

    public function updateAddress(Tenant $tenant, array $data)
    {
        $tenant->address()->updateOrCreate([
            'addressable_id' => $tenant->id,
            'addressable_type' => Tenant::class,
        ], $data);
    }
}