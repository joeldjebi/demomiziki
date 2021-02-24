<?php

namespace App\Policies;

use App\UserFavorite;
use Common\Auth\BaseUser;
use Common\Core\Policies\BasePolicy;

class UserFavoritePolicy extends BasePolicy
{
    public function index(BaseUser $user, $userId = null)
    {
        return $user->hasPermission('userFavorite.view') || $user->id === (int) $userId;
    }

    public function show(BaseUser $user, UserFavorite $userFavorite)
    {
        return $user->hasPermission('userFavorite.view') || $userFavorite->user_id === $user->id;
    }

    public function store(BaseUser $user)
    {
        return $user->hasPermission('userFavorite.create');
    }

    public function update(BaseUser $user, UserFavorite $userFavorite)
    {
        return $user->hasPermission('userFavorite.update') || $userFavorite->user_id === $user->id;
    }

    public function destroy(BaseUser $user, $userFavoriteIds)
    {
        if ($user->hasPermission('userFavorite.delete')) {
            return true;
        } else {
            $dbCount = app(UserFavorite::class)
                ->whereIn('id', $userFavoriteIds)
                ->where('user_id', $user->id)
                ->count();
            return $dbCount === count($userFavoriteIds);
        }
    }
}
