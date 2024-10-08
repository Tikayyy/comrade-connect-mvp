<?php

namespace App\Traits\User;

use App\Enums\FriendshipStatus;
use App\Models\Friendship;

trait HasFriendRequests
{
    public function friendRequests()
    {
        return $this->hasMany(Friendship::class, "requested_user_id")
            ->where("status", FriendshipStatus::Pending)
			->with('initiator');
    }

    public function hiddenFriendRequests()
    {
        return $this->hasMany(Friendship::class, "requested_user_id")
            ->where("status", FriendshipStatus::Hidden)
            ->with('requested');
    }
}
