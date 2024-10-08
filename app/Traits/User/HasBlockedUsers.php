<?php

namespace App\Traits\User;

use App\Enums\FriendshipStatus;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasBlockedUsers
{
    protected function friendsOfThisUserBlocked(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "friendships", "initiator_user_id", "requested_user_id")
            ->withPivot("status")
            ->wherePivot("status", FriendshipStatus::Blocked);
    }

    protected function thisUserFriendOfBlocked(): BelongsToMany
    {
        return $this->belongsToMany( User::class, "friendships", "requested_user_id", "initiator_user_id")
            ->withPivot("status")
            ->wherePivot("status", FriendshipStatus::Blocked);
    }

    protected function loadBlockedFriends(): void
    {
        if (!array_key_exists("blocked_friends", $this->relations)) {
            $friends = $this->mergeBlockedFriends();
            $this->setRelation("blocked_friends", $friends);
        }
    }

    protected function mergeBlockedFriends(): Collection
    {
        if ($temp = $this->friendsOfThisUserBlocked) {
            return $temp->merge($this->thisUserFriendOfBlocked);
        } else {
            return $this->thisUserFriendOfBlocked;
        }
    }

    public function getBlockedFriendsAttribute(): Collection
    {
        if (!array_key_exists("blocked_friends", $this->relations)) {
            $this->loadBlockedFriends();
        }
        return $this->getRelation("blocked_friends");
    }
}
