<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserInvitation;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository
{
    public function getAll(int $perPage = 10) : LengthAwarePaginator
    {
        return User::withCount('tenants')->orderByDesc('created_at')->paginate($perPage, ['*'], 'all');
    }

    public function getAllTrashed(int $perPage = 10) : LengthAwarePaginator
    {
        return User::withCount('tenants')->onlyTrashed()->orderByDesc('created_at')->paginate($perPage, ['*'], 'trash');
    }

    public function create(array $data, bool $notification = false) : User
    {
        $data['password'] = Hash::make(!empty($data['password']) ? $data['password'] : 'password');

        $user = User::create($data);

        if ( $notification ) $this->sendInvitation($user);

        return $user;
    }

    public function update(User $user, array $data) : void
    {
        $user->updateOrFail($data);
    }

    public function delete(User $user) : void
    {
        $user->deleteOrFail();
    }

    public function forceDelete(User $user) : void
    {
        $user->forceDelete();
    }

    public function restore(User $user) : void
    {
        $user->restore();
    }

    public function changeTenant(User $user, Tenant $tenant)
    {
        $user->updateOrFail(['current_tenant_id' => $tenant->id]);
    }

    public function sendInvitation(User $user)
    {
        // $url = URL::signedRoute('users.invitation', $user);

        $user->notify(new UserInvitation($user, 'fake-url'));
    }

    public function updatePhoto(User $user, UploadedFile $file) : void
    {
        $path = 'cdn/tenants/avatars';
        $filename = $file->hashName();

        $file->move(public_path($path), $filename);

        $user->updateOrFail([
            'photo_url' => "{$path}/{$filename}",
        ]);
    }

    public function changePassword(User $user, string $password) : void
    {
        $user->update([
            'password' => Hash::make($password),
        ]);
    }

    public function getOwners() : array
    {
        return User::orderBy('first_name')->orderBy('last_name')->get()->pluck('fullname', 'id')->toArray();
    }
}