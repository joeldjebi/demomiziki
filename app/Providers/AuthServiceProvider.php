<?php

namespace App\Providers;

use App\UserLyricTrack;
use App\Policies\UserLyricTrackPolicy;
use App\UserTrack;
use App\Policies\UserTrackPolicy;
use App\UserFavorite;
use App\Policies\UserFavoritePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
