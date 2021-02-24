<?php namespace App\Services\Providers\Spotify;

use App;
use App\Album;
use App\Services\HttpClient;

class SpotifyAlbum {

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var SpotifyArtist
     */
    private $spotifyArtist;

    /**
     * @var SpotifyNormalizer
     */
    private $normalizer;

    /**
     * @param SpotifyArtist $spotifyArtist
     * @param SpotifyNormalizer $normalizer
     */
    public function __construct(SpotifyArtist $spotifyArtist, SpotifyNormalizer $normalizer) {
        $this->httpClient = App::make('SpotifyHttpClient');
        $this->spotifyArtist = $spotifyArtist;
        $this->normalizer = $normalizer;
    }

    /**
     * @param Album $album
     * @return array
     */
    public function getAlbum(Album $album) {

        if ($album->spotify_id) {
            $spotifyAlbum = $this->httpClient->get("albums/{$album->spotify_id}");
        }

        if ( ! isset($spotifyAlbum) || ! $spotifyAlbum) {
            return null;
        }

        $normalizedAlbum = $this->normalizer->album($spotifyAlbum);

        // get full info objects for all tracks
        $normalizedAlbum = $this->getTracks($normalizedAlbum);
        $normalizedAlbum['fully_scraped'] = true;

        return $normalizedAlbum;
    }

    /**
     * @param array $normalizedAlbum
     * @return array
     */
    private function getTracks($normalizedAlbum)
    {
        $trackIds = $normalizedAlbum['tracks']->pluck('spotify_id')->slice(0, 50)->implode(',');

        $response = $this->httpClient->get("tracks?ids=$trackIds");

        $fullTracks = collect($response['tracks'])->map(function($spotifyTrack) {
            return $this->normalizer->track($spotifyTrack);
        });

        $normalizedAlbum['tracks'] = $normalizedAlbum['tracks']->map(function($track) use($fullTracks) {
            return $fullTracks->where('spotify_id', $track['spotify_id'])->first();
        });

        return $normalizedAlbum;
    }
}
