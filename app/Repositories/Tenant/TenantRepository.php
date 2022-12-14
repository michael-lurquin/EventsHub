<?php

namespace App\Repositories\Tenant;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Notifications\TenantInvitation;
use Illuminate\Pagination\LengthAwarePaginator;

class TenantRepository
{
    public function getAll(int $perPage = 10) : LengthAwarePaginator
    {
        return Tenant::with('owner')->withCount('users')->where('ends_at', '>=', now())->orWhere('ends_at', null)->orderByDesc('created_at')->paginate($perPage, ['*'], 'all');
    }

    public function getAllExpired(int $perPage = 10) : LengthAwarePaginator
    {
        return Tenant::with('owner')->withCount('users')->where('ends_at', '<=', now())->orderByDesc('created_at')->paginate($perPage, ['*'], 'expired');
    }

    public function getAllTrashed(int $perPage = 10) : LengthAwarePaginator
    {
        return Tenant::onlyTrashed()->with('owner')->withCount('users')->orderByDesc('created_at')->paginate($perPage, ['*'], 'trash');
    }

    public function create(array $data, bool $notification = false) : Tenant
    {
        if ( empty($data['owner_id']) ) $data['owner_id'] = auth()->user()->id;
        // if ( empty($data['subdomain']) ) $data['subdomain'] = Str::slug($data['name']);

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

    public function forceDelete(Tenant $tenant) : void
    {
        $tenant->users()->sync([]);
        $tenant->forceDelete();
    }

    public function restore(Tenant $tenant) : void
    {
        $tenant->restore();
    }

    public function addUser(Tenant $tenant, User $user) : void
    {
        $tenant->users()->attach($user);
    }

    public function removeUser(Tenant $tenant, User $user) : void
    {
        $tenant->users()->detach($user);
    }

    public function sendInvitation(Tenant $tenant) : void
    {
        // $url = URL::signedRoute('tenants.invitation', $tenant);

        $tenant->notify(new TenantInvitation($tenant, 'fake-url'));
    }

    public function updateAddress(Tenant $tenant, array $data) : void
    {
        $tenant->address()->updateOrCreate([
            'addressable_id' => $tenant->id,
            'addressable_type' => Tenant::class,
        ], $data);
    }

    public function updateOwner(Tenant $tenant, int $ownerId) : void
    {
        $tenant->update(['owner_id' => $ownerId]);
    }
}