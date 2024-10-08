<?php

namespace App\Http\Controllers;

use App\Http\Requests\Server\CreateServerRequest;
use App\Http\Resources\ServerResource;
use App\Models\Server;
use App\Models\User;
use App\Services\ServerService;

class ServerController extends Controller
{
    public function __construct(
        protected ServerService $serverService
    ) {
    }

    public function create(CreateServerRequest $request)
    {
        $data = $request->validated();
        $serverService = $this->serverService->create($data);
        return response()->json(ServerResource::make($serverService));
    }

    public function delete(Server $server)
    {
        $this->serverService->delete($server->id);
        return response()->json();
    }

    public function invite(Server $server, User $user)
    {
        $this->serverService->inviteUser($server, $user);
        return response()->json();
    }

    public function join(Server $server)
    {
        $this->serverService->acceptInvite($server);
        return response()->json();
    }

    public function hide(Server $server)
    {
        $this->serverService->hideInvite($server);
        return response()->json();
    }
}
