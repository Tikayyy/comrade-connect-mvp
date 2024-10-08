<?php

namespace App\Traits\Server;

use App\Enums\UserHasServerStatusEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasUsers
{
    public function servers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "user_has_servers", "server_id", "user_id")
            ->withPivot("status")
            ->wherePivot("status", UserHasServerStatusEnum::Joined);
    }
}
