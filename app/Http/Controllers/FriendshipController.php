<?php

namespace App\Http\Controllers;

use App\Http\Requests\Friendship\FriendsListRequest;
use App\Http\Resources\UsersCollection;
use App\Models\User;
use App\Services\FriendshipService;

class FriendshipController extends Controller
{
    public function __construct(
        protected FriendshipService $friendshipService
    ) {
    }

    public function list(FriendsListRequest $request)
    {
        $friends = $this->friendshipService->getUserFriendsList();
        return response()->json(UsersCollection::collection($friends));
    }

    public function request(User $user)
    {
        $this->friendshipService->createRequest($user);
        return response()->json();
    }

    public function accept(User $user)
    {
        $this->friendshipService->acceptRequest($user);
        return response()->json();
    }

    public function hide(User $user)
    {
        $this->friendshipService->hideRequest($user);
        return response()->json();
    }

    public function delete(User $user)
    {
        $this->friendshipService->deleteFriend($user);
        return response()->json();
    }

    public function block(User $user)
    {
        $this->friendshipService->blockUser($user);
        return response()->json();
    }
}
