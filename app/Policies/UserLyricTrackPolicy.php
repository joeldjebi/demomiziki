<?php

namespace App\Policies;

use App\UserLyricTrack;
use Common\Auth\BaseUser;
use Common\Core\Policies\BasePolicy;

class UserLyricTrackPolicy extends BasePolicy
{
    public function index(BaseUser $user, $userId = null)
    {
        return $user->hasPermission('userLyricTrack.view') || $user->id === (int) $userId;
    }

    public function show(BaseUser $user, UserLyricTrack $userLyricTrack)
    {
        return $user->hasPermission('userLyricTrack.view') || $userLyricTrack->user_id === $user->id;
    }

    public function store(BaseUser $user)
    {
        return $user->hasPermission('userLyricTrack.create');
    }

    public function update(BaseUser $user, UserLyricTrack $userLyricTrack)
    {
        return $user->hasPermission('userLyricTrack.update') || $userLyricTrack->user_id === $user->id;
    }

    public function destroy(BaseUser $user, $userLyricTrackIds)
    {
        if ($user->hasPermission('userLyricTrack.delete')) {
            return true;
        } else {
            $dbCount = app(UserLyricTrack::class)
                ->whereIn('id', $userLyricTrackIds)
                ->where('user_id', $user->id)
                ->count();
            return $dbCount === count($userLyricTrackIds);
        }
    }
}
