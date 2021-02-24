<?php

namespace App\Actions\UserFavorite;

use App\UserFavorite;
use Auth;

class CrupdateUserFavorite
{
    /**
     * @var UserFavorite
     */
    private $userFavorite;

    /**
     * @param UserFavorite $userFavorite
     */
    public function __construct(UserFavorite $userFavorite)
    {
        $this->userFavorite = $userFavorite;
    }

    /**
     * @param array $data
     * @param UserFavorite $userFavorite
     * @return UserFavorite
     */
    public function execute($data, $userFavorite = null)
    {
        if ( ! $userFavorite) {
            $userFavorite = $this->userFavorite->newInstance([
                 'user_id' => Auth::id(),
            ]);
        }

        $attributes = [
            'name' => $data['name'],
        ];

        $userFavorite->fill($attributes)->save();

        return $userFavorite;
    }
}