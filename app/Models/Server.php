<?php

namespace App\Models;

use App\Enums\ServerVisabilityEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Server extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "title",
        "visability",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        "visability" => ServerVisabilityEnum::class,
    ];

    public function channels(): HasMany
    {
        return $this->hasMany(Channel::class, "server_id", "id");
    }
}
