<?php

namespace App\Http\Controllers;

use App\Http\Requests\Server\Channel\CreateChannelRequest;
use App\Http\Resources\ChannelResource;
use App\Models\Channel;
use App\Models\Server;
use App\Services\ChannelService;

class ChannelController extends Controller
{
    public function __construct(
        protected ChannelService $channelService
    ) {
    }

    public function create(CreateChannelRequest $request, Server $server)
    {
        $data = $request->validated();
        $channel = $this->channelService->create($data);
        return response()->json(ChannelResource::make($channel));
    }

    public function delete(Server $server, Channel $channel)
    {
        $this->channelService->delete($channel->id);
        return response()->json();
    }
}
