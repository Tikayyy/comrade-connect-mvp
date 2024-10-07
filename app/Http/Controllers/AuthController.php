<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthorizationRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;
use App\Services\UserService;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected AuthService $authService
    ) {
    }

    public function registration(RegistrationRequest $request)
    {
        $data = $request->validated();
        try {
            $user = $this->userService->create($data);
            $token = $this->authService->createTokenByUser($user);
            return response()->json([
                "user" => UserResource::make($user),
                "token" => $token,
            ]);
        } catch (Exception $exception) {
            Log::error($exception);
            return response()->json(
                [
                    "message" => "Ошибка сервера",
                ],
                500
            );
        }
    }

    public function authorization(AuthorizationRequest $request)
    {
        $data = $request->validated();
        try {
            $user = $this->userService->getByEmailAndPassword(
                $data["email"],
                $data["password"]
            );
            $token = $this->authService->createTokenByUser($user);
            return response()->json([
                "user" => UserResource::make($user),
                "token" => $token,
            ]);
        } catch (AuthorizationException $authorizationException) {
            return response()->json($authorizationException->getMessage(), 401);
        } catch (Exception $exception) {
            Log::error($exception);
            return response()->json(
                [
                    "message" => "Ошибка сервера",
                ],
                500
            );
        }
    }
}
