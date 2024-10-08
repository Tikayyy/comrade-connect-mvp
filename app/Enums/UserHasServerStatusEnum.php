<?php

namespace App\Enums;

enum UserHasServerStatusEnum: string
{
    case Pending = "pending";
    case Hidden = "hidden";
    case Joined = "joined";
}
