<?php

namespace App\Repositories;

use App\Models\Friendship;
use App\Models\User;

class FriendshipRepository
{
    public function create(array $data): Friendship
    {
        return Friendship::create($data);
    }

    public function update(int $id, array $data): void
    {
        Friendship::where("id", $id)->update($data);
    }

    public function delete(int $id): void
    {
        Friendship::where("id", $id)->delete();
    }

    public function getByUsers(User $initiatedUser, User $requestedUser): Friendship
    {
        return Friendship::query()
            ->where(function ($sq) use ($initiatedUser, $requestedUser) {
                $sq->where("initiator_user_id", $initiatedUser->id)
                    ->where("requested_user_id", $requestedUser->id);
            })
            ->where(function ($sq) use ($initiatedUser, $requestedUser) {
                $sq->where("requested_user_id", $requestedUser->id)
                    ->where("initiator_user_id", $initiatedUser->id);
            })
            ->first();
    }
}
