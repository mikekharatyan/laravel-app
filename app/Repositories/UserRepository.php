<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function findByName(string $name): ?User
    {
        return User::query()->where("name", $name)->first();
    }

    public function createUser(string $name, string $password): User
    {
        return User::query()->create([
            "name"     => $name,
            "password" => Hash::make($password),
        ]);
    }
}