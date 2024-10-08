<?php

namespace App\Traits\User;

use App\Enums\FriendshipStatus;
use App\Models\User;

trait HasBlockedUsers
{
    protected function friendsOfThisUserBlocked()
    {
        return $this->belongsToMany(User::class, "friendships", "initiator_user_id", "requested_user_id")
            ->withPivot("status")
            ->wherePivot("status", FriendshipStatus::Blocked);
    }

    protected function thisUserFriendOfBlocked()
    {
        return $this->belongsToMany( User::class, "friendships", "requested_user_id", "initiator_user_id")
            ->withPivot("status")
            ->wherePivot("status", FriendshipStatus::Blocked);
    }

    protected function loadBlockedFriends()
    {
        if (!array_key_exists("blocked_friends", $this->relations)) {
            $friends = $this->mergeBlockedFriends();
            $this->setRelation("blocked_friends", $friends);
        }
    }

    protected function mergeBlockedFriends()
    {
        if ($temp = $this->friendsOfThisUserBlocked) {
            return $temp->merge($this->thisUserFriendOfBlocked);
        } else {
            return $this->thisUserFriendOfBlocked;
        }
    }

    public function getBlockedFriendsAttribute()
    {
        if (!array_key_exists("blocked_friends", $this->relations)) {
            $this->loadBlockedFriends();
        }
        return $this->getRelation("blocked_friends");
    }
}
