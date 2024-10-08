<?php

namespace App\Services;

use App\Enums\FriendshipStatusEnum;
use App\Models\User;
use App\Repositories\FriendshipRepository;
use Illuminate\Support\Facades\Auth;

class FriendshipService
{
    protected User $authedUser;

    public function __construct(
        protected FriendshipRepository $friendshipRepository
    ) {
        $this->authedUser = Auth::user();
    }

    public function getUserFriendsList()
    {
        return $this->authedUser->friends ?? collect();
    }

    public function createRequest(User $friend)
    {
        return $this->friendshipRepository->create([
            "initiator_user_id" => $this->authedUser->id,
            "requested_user_id" => $friend->id,
            "status" => FriendshipStatusEnum::Pending,
        ]);
    }

    public function acceptRequest(User $friend)
    {
        $friendship = $this->friendshipRepository->getByUsers($friend, $this->authedUser);
        $data = $friendship->toArray();
        $data['status'] = FriendshipStatusEnum::Confirmed;
        $this->friendshipRepository->update($data['id'], $data);
    }

    public function hideRequest(User $friend)
    {
        $friendship = $this->friendshipRepository->getByUsers($friend, $this->authedUser);
        $data = $friendship->toArray();
        $data['status'] = FriendshipStatusEnum::Pending;
        $this->friendshipRepository->update($data['id'], $data);
    }

    public function deleteFriend(User $friend)
    {
        $friendship = $this->friendshipRepository->getByUsers($friend, $this->authedUser);
        $this->friendshipRepository->delete($friendship->id);
    }

    public function blockUser(User $friend)
    {
        $friendship = $this->friendshipRepository->getByUsers($friend, $this->authedUser);
        $data = $friendship->toArray();
        $data['status'] = FriendshipStatusEnum::Pending;
        $this->friendshipRepository->update($data['id'], $data);
    }
}
