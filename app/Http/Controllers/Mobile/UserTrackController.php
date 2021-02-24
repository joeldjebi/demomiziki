<?php

namespace App\Http\Controllers\Mobile;

use Auth;
use App\User;
use App\UserTrack;
use App\UserFavorite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserTrackController extends Controller
{

    /**
     * @var Request
     */
    private $request;

    /**
     * @param Request $request
     * @param ArtistsRepository $repository
     */
	public function __construct(Request $request)
	{
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAlbumTrack(Request $request, $track_id)
    {  
        $user = Auth::user()->id();
        //$user = User::first();
 
        $user_track = DB::table('user_tracks')
        ->join('tracks', 'user_tracks.track_id', '=', 'tracks.id')
        ->orderBy('user_tracks.track','DESC')
        ->get();

        return $this->sendResponse('success',  $user_track->toArray());
    }

    public function storeTrack(Request $request)
    {  
        $user = Auth::user()->id();
        //$user = User::first();
        $user_track = UserTrack::where('user_id',$user->id)
        ->where('track_id',$this->request->get('track_id'))->first();
        if (empty($user_track)) {
            // dd($user->id, $this->request->get('track_id'));
            UserTrack::create([ 
                'user_id'=>$user->id,
                'track_id'=>$this->request->get('track_id'),
                'track'=>1
            ]);
        } else {
            $user_track->update([
                'track'=>$user_track->track+1
            ]);
        }

        return $this->sendResponse('success',  []);
    }

    public function getUserFavoriteTrack(Request $request)
    {  
        $user = Auth::user()->id();
        //$user = User::first();
 
        $user_track = DB::table('user_favorites')
        ->join('tracks', 'user_favorites.track_id', '=', 'tracks.id')
        ->select('tracks.*')
        ->get();

        return $this->sendResponse('success',  $user_track->toArray());
    }

    public function storeFavoriteTrack(Request $request)
    {  

        $user = Auth::user()->id();
        //$user = User::first();

        if (
            empty(
                UserFavorite::
                where('user_id',$user->id)
                ->where('track_id',$this->request->get('track_id'))
                ->first()
            )
        ) {
            UserFavorite::create(['user_id'=>$user->id,'track_id'=>$this->request->get('track_id')]);
        }

        return $this->sendResponse('success',  []);
    }

    public function removeFavoriteTrack(Request $request, $track_id)
    {  

        $user = Auth::user()->id();
        //$user = User::first();

        $user_favorite_track = UserFavorite::
        where('user_id',$user->id)
        ->where('track_id',$track_id)
        ->first();

        if (!empty($user_favorite_track)) {
            $user_favorite_track->delete();
        }

        return $this->sendResponse('success',  []);
    }

    public function getArtistAlbumTrack(Request $request, $album_id)
    {  
        $user = Auth::user()->id();
        //$user = User::first();
 
        $album = DB::table('albums')
        ->join('tracks', 'albums.id', '=', 'tracks.album_id')
        ->orderBy('tracks.name','DESC')
        ->where('albums.id',$album_id)
        ->select(
            'tracks.*',
            // 'albums.name as album_name',
            // 'albums.image as album_image',
            // 'albums.spotify_id as album_spotify_id',
            // 'albums.artist_id as album_artist_id'
        )
        ->get();

        return $this->sendResponse('success',  $album->toArray());
    }
}
