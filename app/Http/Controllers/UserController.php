<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserListRequest;
use App\Http\Resources\PublicUserResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    public function getMe(Request $request)
    {
        return response()->json([
            "user" => UserResource::make(Auth::user()),
        ]);
    }

    public function list(UserListRequest $request)
    {
        [$search] = $request->validated();
        $users = $this->userService->search($search);
        return response()->json(PublicUserResource::collection($users));
    }

    public function get(User $user)
    {
        return response()->json(PublicUserResource::make($user));
    }
}
