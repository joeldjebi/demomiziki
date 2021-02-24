<?php
/*
|--------------------------------------------------------------------------
| Mobile Routes
|--------------------------------------------------------------------------
|
| Here is where you can register mobile routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "mobile" middleware group. Now create something great!
|
*/
// API MOBILE


Route::post('login', 'Mobile\AuthController@login');
Route::post('register', 'Mobile\AuthController@createAccount');
Route::post('reduce-miziki', 'Mobile\BundleController@reduceMiziki');
Route::post('increase-miziki', 'Mobile\BundleController@increaseMiziki');

Route::get('getAllalbum', 'ApiMobileAlbumController@getAllalbum');
Route::get('show/{id}', 'ApiMobileAlbumController@show');
Route::get('plays', 'ApiMobileAlbumController@plays');
Route::get('get-artist-album-track/{album_id}', 'Mobile\UserTrackController@getArtistAlbumTrack');


Route::get('get-album-track/{track_id}', 'Mobile\UserTrackController@getAlbumTrack');
Route::post('storeTrack', 'Mobile\UserTrackController@storeTrack');
Route::get('get-user-favorite-track', 'Mobile\UserTrackController@getUserFavoriteTrack');
Route::post('store-favorite-track', 'Mobile\UserTrackController@storeFavoriteTrack');
Route::delete('remove-favorite-track/{track_id}', 'Mobile\UserTrackController@removeFavoriteTrack');

/*
|--------------------------------------------------------------------------
| Mobile Routes Api
|--------------------------------------------------------------------------
|
| Here is where you can register mobile routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "mobile" middleware group. Now create something great!
|
*/

// ALBUMS
Route::get('albums', 'AlbumController@index');
Route::get('albums/{album}', 'AlbumController@show');

// ARTISTS
Route::get('artists', 'ArtistController@index');
Route::get('artists/{nameOrId}', 'ArtistController@show');
Route::post('player/tracks', 'PlayerTracksController@index');

// TRACKS
Route::get('tracks', 'TrackController@index');
Route::get('tracks/{id}', 'TrackController@show');


