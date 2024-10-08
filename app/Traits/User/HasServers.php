<?php

namespace App\Traits\User;

use App\Enums\UserHasServerStatusEnum;
use App\Models\Server;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasServers
{
    public function servers(): BelongsToMany
    {
        return $this->belongsToMany(Server::class, "user_has_servers", "user_id", "server_id")
            ->withPivot("status")
            ->wherePivot("status", UserHasServerStatusEnum::Joined);
    }
}
