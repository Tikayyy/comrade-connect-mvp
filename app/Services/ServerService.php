<?php

namespace App\Services;

use App\Enums\UserHasServerStatusEnum;
use App\Enums\UserServerRoleEnum;
use App\Models\Server;
use App\Models\User;
use App\Repositories\ServerRepository;
use Illuminate\Support\Facades\Auth;

class ServerService
{
    public function __construct(
        protected ServerRepository $serverRepository
    ) {
    }

    public function create(array $data): Server
    {
        $server = $this->serverRepository->create($data);

        /** @var User **/
        $user = Auth::user();
        $user->servers()
            ->attach($server->id, [
                "status" => UserHasServerStatusEnum::Joined,
                "role" => UserServerRoleEnum::Admin,
            ]);

        return $server;
    }

    public function delete(int $id): void
    {
        $this->serverRepository->delete($id);

    }

    public function inviteUser(Server $server, User $user): bool
    {
        $isUserJoined = $user->servers()
            ->where("id", $server->id)
            ->exists();

        if (!$isUserJoined) {
            return false;
        }

        $user->servers()->attach($server->id, [
            "status" => UserHasServerStatusEnum::Pending,
            "role" => UserServerRoleEnum::Normal,
        ]);

        return true;
    }

    public function acceptInvite(Server $server)
    {
        /** @var User **/
        $user = Auth::user();
        $user->servers()->updateExistingPivot($server->id, [
            "status" => UserHasServerStatusEnum::Joined,
        ]);
    }

    public function hideInvite(Server $server)
    {
        /** @var User **/
        $user = Auth::user();
        $user->servers()->updateExistingPivot($server->id, [
            "status" => UserHasServerStatusEnum::Hidden,
        ]);
    }
}
