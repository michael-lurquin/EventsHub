<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function create(array $data) : User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function find(int $userId) : User
    {
        return User::findOrFail($userId);
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
}