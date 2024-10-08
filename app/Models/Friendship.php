<?php

namespace App\Models;

use App\Enums\FriendshipStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "initiator_user_id",
        "requested_user_id",
        "status",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "status" => FriendshipStatus::class,
    ];

    public function initiator()
    {
        return $this->belongsTo(User::class, "initiator_user_id", "id");
    }

    public function requested()
    {
        return $this->hasOne(User::class, "requested_user_id", "id");
    }
}
