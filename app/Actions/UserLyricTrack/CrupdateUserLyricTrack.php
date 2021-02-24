<?php

namespace App\Actions\UserLyricTrack;

use App\UserLyricTrack;
use Auth;

class CrupdateUserLyricTrack
{
    /**
     * @var UserLyricTrack
     */
    private $userLyricTrack;

    /**
     * @param UserLyricTrack $userLyricTrack
     */
    public function __construct(UserLyricTrack $userLyricTrack)
    {
        $this->userLyricTrack = $userLyricTrack;
    }

    /**
     * @param array $data
     * @param UserLyricTrack $userLyricTrack
     * @return UserLyricTrack
     */
    public function execute($data, $userLyricTrack = null)
    {
        if ( ! $userLyricTrack) {
            $userLyricTrack = $this->userLyricTrack->newInstance([
                 'user_id' => Auth::id(),
            ]);
        }

        $attributes = [
            'name' => $data['name'],
        ];

        $userLyricTrack->fill($attributes)->save();

        return $userLyricTrack;
    }
}