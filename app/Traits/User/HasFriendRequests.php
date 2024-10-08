<?php

namespace App\Traits\User;

use App\Enums\FriendshipStatus;
use App\Models\Friendship;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasFriendRequests
{
    public function friendRequests(): HasMany
    {
        return $this->hasMany(Friendship::class, "requested_user_id")
            ->where("status", FriendshipStatus::Pending)
			->with('initiator');
    }

    public function hiddenFriendRequests(): HasMany
    {
        return $this->hasMany(Friendship::class, "requested_user_id")
            ->where("status", FriendshipStatus::Hidden)
            ->with('requested');
    }
}
