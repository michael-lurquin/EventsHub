<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserInvitation;

class UserRepository
{
    public function create(array $data, bool $notification = false) : User
    {
        if ( !empty($data['password']) ) $data['password'] = Hash::make($data['password']);

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

    public function deleteForce(User $user) : void
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
}