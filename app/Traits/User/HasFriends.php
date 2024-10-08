<?php

namespace App\Traits\User;

use App\Enums\FriendshipStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

trait HasFriends
{
    protected function friendsOfThisUser(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "friendships", "initiator_user_id", "requested_user_id")
            ->withPivot("status")
            ->wherePivot("status", FriendshipStatusEnum::Confirmed);
    }

    protected function thisUserFriendOf(): BelongsToMany
    {
        return $this->belongsToMany( User::class, "friendships", "requested_user_id", "initiator_user_id")
            ->withPivot("status")
            ->wherePivot("status", FriendshipStatusEnum::Confirmed);
    }

    protected function loadFriends(): void
    {
        if (!array_key_exists("friends", $this->relations)) {
            $friends = $this->mergeFriends();
            $this->setRelation("friends", $friends);
        }
    }

    protected function mergeFriends(): Collection
    {
        if ($temp = $this->friendsOfThisUser) {
            return $temp->merge($this->thisUserFriendOf);
        } else {
            return $this->thisUserFriendOf;
        }
    }

    public function getFriendsAttribute(): Collection
    {
        if (!array_key_exists("friends", $this->relations)) {
            $this->loadFriends();
        }
        return $this->getRelation("friends");
    }
}
