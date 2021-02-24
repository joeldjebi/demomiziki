<?php namespace App;

use App\Traits\DeterminesArtistType;
use Common\Auth\BaseUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\User
 *
 * @property-read Collection|Playlist[] $playlists
 * @property-read Collection|Track[] $uploadedTracks
 * @property-read UserProfile $profile
 */
// class User extends BaseUser implements JWTSubject
class User extends BaseUser 
{
    use Notifiable;
    // DeterminesArtistType;

    protected $appends = [
        'display_name',
        'has_password',
        'model_type',
    ];

    public function followedUsers()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id')
            ->select(['users.id', 'first_name', 'last_name', 'avatar', 'email']);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id')
            ->select(['users.id', 'first_name', 'last_name', 'avatar', 'email']);
    }

    /**
     * @return BelongsToMany
     */
    public function likedTracks()
    {
        return $this->morphedByMany(Track::class, 'likeable', 'likes')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function likedAlbums()
    {
        return $this->morphedByMany(Album::class, 'likeable', 'likes')
            ->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function likedArtists()
    {
        return $this->morphedByMany($this->determineArtistType(), 'likeable', 'likes')
            ->withTimestamps();
    }

    /**
     * @return MorphToMany
     */
    public function uploadedTracks()
    {
        return $this->morphToMany(Track::class, 'artist', 'artist_track')
            ->whereNull('album_id')
            ->withCount('likes')
            ->withCount('reposts')
            ->orderBy('created_at', 'desc');
    }

    /**
     * @return MorphMany
     */
    public function albums()
    {
        return $this->morphMany(Album::class, 'artist')
            ->withCount('reposts')
            ->orderBy('created_at', 'desc');
    }

    /**
     * @return BelongsToMany
     */
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class)->withPivot('owner');
    }

    /**
     * @return HasMany
     */
    public function reposts()
    {
        return $this->hasMany(Repost::class);
    }

    /**
     * @return HasOne
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * @return HasMany
     */
    public function links()
    {
        return $this->hasMany(UserLink::class);
    }

    /**
     * @return string
     */
    public function getModelTypeAttribute()
    {
        return User::class;
    }

        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    
}
