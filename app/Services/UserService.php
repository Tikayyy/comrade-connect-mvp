<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository,
    ) {
    }

    public function create(array $data = []): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    public function getByEmailAndPassword(string $email, string $password): ?User
    {
        $user = $this->userRepository->getByEmail($email);

        if (!Hash::check($password, data_get($user, 'password'))) {
            throw new AuthorizationException(__('auth.failed'));
        }

        return $user;
    }
}
