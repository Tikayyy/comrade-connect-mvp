<?php

namespace App\Enums;

enum FriendshipStatusEnum: string
{
    case Pending = "pending";
    case Confirmed = "confirmed";
    case Hidden = "hidden";
    case Blocked = "blocked";
}
