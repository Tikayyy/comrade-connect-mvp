<?php

namespace App\Models;

use App\Enums\UserHasServerStatusEnum;
use App\Enums\UserServerRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasServer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "server_id",
        "user_id",
        "status",
        "role",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "status" => UserHasServerStatusEnum::class,
        "role" => UserServerRoleEnum::class,
    ];

    public function server()
    {
        return $this->belongsTo(Server::class, 'server_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
