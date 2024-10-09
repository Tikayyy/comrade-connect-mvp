<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function getByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function search(string $text): Collection
    {
        return User::where(function ($where) use ($text) {
            $where->where("login", "like", "%$text%")
                ->orWhere("email", "like", "%$text%");
        })->get();
    }
}
