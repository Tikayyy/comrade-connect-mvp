<?php

namespace App\Enums;

enum UserServerRoleEnum: string
{
    case Admin = "admin";
    case Moderator = "moderator";
    case Normal = "normal";
}
