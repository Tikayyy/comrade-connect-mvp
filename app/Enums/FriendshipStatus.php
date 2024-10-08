<?php

namespace App\Enums;

enum FriendshipStatus: string
{
    case Pending = "pending";
    case Confirmed = "confirmed";
    case Hidden = "hidden";
    case Blocked = "blocked";
}
