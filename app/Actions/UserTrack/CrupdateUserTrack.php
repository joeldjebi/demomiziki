<?php

namespace App\Actions\UserTrack;

use App\UserTrack;
use Auth;

class CrupdateUserTrack
{
    /**
     * @var UserTrack
     */
    private $userTrack;

    /**
     * @param UserTrack $userTrack
     */
    public function __construct(UserTrack $userTrack)
    {
        $this->userTrack = $userTrack;
    }

    /**
     * @param array $data
     * @param UserTrack $userTrack
     * @return UserTrack
     */
    public function execute($data, $userTrack = null)
    {
        if ( ! $userTrack) {
            $userTrack = $this->userTrack->newInstance([
                 'user_id' => Auth::id(),
            ]);
        }

        $attributes = [
            'name' => $data['name'],
        ];

        $userTrack->fill($attributes)->save();

        return $userTrack;
    }
}