<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function create(array $data) : User
    {
        return $this->user->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function find(int $userId) : User
    {
        return $this->user->findOrFail($userId);
    }

    public function update(array $data) : void
    {
        $this->user->updateOrFail($data);
    }

    public function delete() : void
    {
        $this->user->deleteOrFail();
    }

    public function deleteForce() : void
    {
        $this->user->forceDelete();
    }

    public function restore() : void
    {
        $this->user->restore();
    }
}