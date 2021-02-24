<?php namespace App\Http\Controllers;

use App;
use App\Actions\Track\DeleteTracks;
use App\Http\Requests\ModifyTracks;
use App\Services\Tracks\CrupdateTrack;
use App\Services\Tracks\PaginateTrackComments;
use App\Track;
use Common\Core\BaseController;
use Common\Database\Paginator;
use Common\Settings\Settings;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrackController extends BaseController {

	/**
	 * @var Track
	 */
	private $track;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param Track $track
     * @param Request $request
     */
    public function __construct(Track $track, Request $request)
	{
		$this->track = $track;
        $this->request = $request;
    }

	/**
	 * @return JsonResponse
	 */
	public function index()
	{
        $this->authorize('index', Track::class);

	    $paginator = (new Paginator($this->track, $this->request->all(), 'pagination.track_count'));
	    $paginator->with('album');
	    $paginator->withCount('plays');
	    $paginator->setDefaultOrderColumns('created_at', 'desc'); 

	    return $this->success(['pagination' => $paginator->paginate()]);
	}

	/**
	 * @param  int  $id
	 * @return JsonResponse
	 */
	public function show($id)
	{
	    $track = $this->track
            ->with('album.artist', 'album.tracks.artists', 'tags', 'genres')
            ->withCount('comments', 'plays', 'reposts', 'likes')
            ->findOrFail($id);

	    $this->authorize('show', $track);

        if (app(Settings::class)->get('player.track_comments')) {
            $comments = app(PaginateTrackComments::class)->execute($track);
        }

        if ($track->album) {
            $track->album->tracks->loadCount('plays');
            $track->album->addPopularityToTracks();
        }

	    return $this->success([
	        'track' => $track,
            'comments' => isset($comments) ? $comments : []
        ]);
	}

    /**
     * @param ModifyTracks $validate
     * @return JsonResponse
     */
    public function store(ModifyTracks $validate)
    {
        $this->authorize('store', Track::class);

        $track = app(CrupdateTrack::class)
            ->execute($this->request->all(), null, $this->request->get('album'));

        return $this->success(['track' => $track]);
    }

    /**
     * @param int $id
     * @param ModifyTracks $validate
     * @return JsonResponse
     */
    public function update($id, ModifyTracks $validate)
    {
        $track = $this->track->findOrFail($id);

        $this->authorize('update', $track);

        $track = app(CrupdateTrack::class)
            ->execute($this->request->all(), $track, $this->request->get('album'));

        return $this->success(['track' => $track]);
    }

	/**
	 * @return mixed
	 */
	public function destroy()
	{
		$trackIds = $this->request->get('ids');
	    $this->authorize('destroy', [Track::class, $trackIds]);

        $this->validate($this->request, [
            'ids'   => 'required|array',
            'ids.*' => 'required|integer'
        ]);

        app(DeleteTracks::class)->execute($trackIds);

	    return $this->success();
	}
}
