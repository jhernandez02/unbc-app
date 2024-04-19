<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllUsers()
    {
        return $this->user->all();
    }

    public function getUserById($id)
    {
        return $this->user->findOrFail($id);
    }

    public function createUser(array $data)
    {
        return $this->user->create($data);
    }

    public function updateUser($id, array $data)
    {
        $user = $this->getUserById($id);
        $user->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = $this->getUserById($id);
        $user->delete();
    }
}
