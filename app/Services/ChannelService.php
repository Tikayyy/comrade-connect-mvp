<?php

namespace App\Services;

use App\Models\Channel;
use App\Repositories\ChannelRepository;

class ChannelService
{
    public function __construct(
        protected ChannelRepository $channelRepository
    ) {
    }

    public function create(array $data): Channel
    {
        return $this->channelRepository->create($data);
    }

    public function delete(int $id): void
    {
        $this->channelRepository->delete($id);

    }
}
