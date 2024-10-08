<?php

namespace App\Repositories;

use App\Models\Server;
use App\Models\UserHasServer;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServerRepository
{
    public function create(array $data): Server
    {
        return Server::create($data);
    }

    public function delete(int $id): void
    {
        try {
            DB::beginTransaction();
            UserHasServer::where("server_id", $id)->delete();
            Server::where("id", $id)->delete();
            DB::commit();
        } catch (Exception $exception) {
            Log::error($exception);
            DB::rollBack();
        }
    }
}
