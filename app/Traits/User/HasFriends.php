<?php

namespace App\Traits\User;

use App\Enums\FriendshipStatus;
use App\Models\Friendship;
use App\Models\User;

trait HasFriends
{
    protected function friendsOfThisUser()
    {
        return $this->belongsToMany(User::class, "friendships", "initiator_user_id", "requested_user_id")
            ->withPivot("status")
            ->wherePivot("status", FriendshipStatus::Confirmed);
    }

    protected function thisUserFriendOf()
    {
        return $this->belongsToMany( User::class, "friendships", "requested_user_id", "initiator_user_id")
            ->withPivot("status")
            ->wherePivot("status", FriendshipStatus::Confirmed);
    }

    protected function loadFriends()
    {
        if (!array_key_exists("friends", $this->relations)) {
            $friends = $this->mergeFriends();
            $this->setRelation("friends", $friends);
        }
    }

    protected function mergeFriends()
    {
        if ($temp = $this->friendsOfThisUser) {
            return $temp->merge($this->thisUserFriendOf);
        } else {
            return $this->thisUserFriendOf;
        }
    }

    public function getFriendsAttribute()
    {
        if (!array_key_exists("friends", $this->relations)) {
            $this->loadFriends();
        }
        return $this->getRelation("friends");
    }
}
