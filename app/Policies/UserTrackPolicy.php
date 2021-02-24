<?php

namespace App\Policies;

use App\UserTrack;
use Common\Auth\BaseUser;
use Common\Core\Policies\BasePolicy;

class UserTrackPolicy extends BasePolicy
{
    public function index(BaseUser $user, $userId = null)
    {
        return $user->hasPermission('userTrack.view') || $user->id === (int) $userId;
    }

    public function show(BaseUser $user, UserTrack $userTrack)
    {
        return $user->hasPermission('userTrack.view') || $userTrack->user_id === $user->id;
    }

    public function store(BaseUser $user)
    {
        return $user->hasPermission('userTrack.create');
    }

    public function update(BaseUser $user, UserTrack $userTrack)
    {
        return $user->hasPermission('userTrack.update') || $userTrack->user_id === $user->id;
    }

    public function destroy(BaseUser $user, $userTrackIds)
    {
        if ($user->hasPermission('userTrack.delete')) {
            return true;
        } else {
            $dbCount = app(UserTrack::class)
                ->whereIn('id', $userTrackIds)
                ->where('user_id', $user->id)
                ->count();
            return $dbCount === count($userTrackIds);
        }
    }
}
