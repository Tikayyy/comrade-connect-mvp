<?php

namespace App\Repositories;

use App\Models\Channel;

class ChannelRepository
{
    public function create(array $data): Channel
    {
        return Channel::create($data);
    }

    public function delete(int $id): void
    {
        Channel::where("id", $id)->delete();
    }
}
