<?php

namespace App\Policies;

use App\User;
use Common\Core\Policies\BasePolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtistPolicy extends BasePolicy
{
    use HandlesAuthorization;

    public function index(?User $user)
    {
        return $this->userOrGuestHasPermission($user, 'artists.view');
    }

    public function show(?User $user)
    {
        return $this->userOrGuestHasPermission($user, 'artists.view');
    }

    public function store(User $user)
    {
        return $user->hasPermission('artists.create');
    }

    public function update(User $user)
    {
        return $user->hasPermission('artists.update');
    }

    public function destroy(User $user)
    {
        return $user->hasPermission('artists.delete');
    }
}
