<?php namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Common\Settings\Settings;

trait OrdersByPopularity {

    /**
     * @param Builder $query
     * @param string $direction
     * @return Builder
     */
    public function scopeOrderByPopularity(Builder $query, $direction = 'desc')
    {
        $method = \App::make(Settings::class)->get('player.sort_method', 'external');

        $column = $method === 'external' ? 'spotify_popularity' : $this->getLocalField();

        if ($this->getTable() === 'tracks') {
            $query->withCount('plays');
        }

        return $query->orderBy($column, $direction)
            ->orderBy('id', 'desc');
    }

    private function getLocalField()
    {
        if ($this->getTable() === 'tracks') {
            return 'plays_count';
        } else {
            return 'views';
        }
    }
}
