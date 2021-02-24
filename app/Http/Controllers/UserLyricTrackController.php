<?php

namespace App\Http\Controllers;

use App\Actions\UserLyricTrack\CrupdateUserLyricTrack;
use App\Http\Requests\CrupdateUserLyricTrackRequest;
use App\UserLyricTrack;
use Common\Core\BaseController;
use Common\Database\Paginator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserLyricTrackController extends BaseController
{
    /**
     * @var UserLyricTrack
     */
    private $userLyricTrack;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param UserLyricTrack $userLyricTrack
     * @param Request $request
     */
    public function __construct(UserLyricTrack $userLyricTrack, Request $request)
    {
        $this->userLyricTrack = $userLyricTrack;
        $this->request = $request;
    }

    /**
     * @return Response
     */
    public function index()
    {
        $userId = $this->request->get('userId');
        $this->authorize('index', [UserLyricTrack::class, $userId]);

        $paginator = new Paginator($this->userLyricTrack, $this->request->all());

        if ($userId = $paginator->param('userId')) {
            $paginator->where('user_id', $userId);
        }

        $pagination = $paginator->paginate();

        return $this->success(['pagination' => $pagination]);
    }

    /**
     * @param UserLyricTrack $userLyricTrack
     * @return Response
     */
    public function show(UserLyricTrack $userLyricTrack)
    {
        $this->authorize('show', $userLyricTrack);

        return $this->success(['userLyricTrack' => $userLyricTrack]);
    }

    /**
     * @param CrupdateUserLyricTrackRequest $request
     * @return Response
     */
    public function store(CrupdateUserLyricTrackRequest $request)
    {
        $this->authorize('store', UserLyricTrack::class);

        $userLyricTrack = app(CrupdateUserLyricTrack::class)->execute($request->all());

        return $this->success(['userLyricTrack' => $userLyricTrack]);
    }

    /**
     * @param UserLyricTrack $userLyricTrack
     * @param CrupdateUserLyricTrackRequest $request
     * @return Response
     */
    public function update(UserLyricTrack $userLyricTrack, CrupdateUserLyricTrackRequest $request)
    {
        $this->authorize('store', $userLyricTrack);

        $userLyricTrack = app(CrupdateUserLyricTrack::class)->execute($request->all(), $userLyricTrack);

        return $this->success(['userLyricTrack' => $userLyricTrack]);
    }

    /**
     * @param string $ids
     * @return Response
     */
    public function destroy($ids)
    {
        $userLyricTrackIds = explode(',', $ids);
        $this->authorize('store', [UserLyricTrack::class, $userLyricTrackIds]);

        $this->userLyricTrack->whereIn('id', $userLyricTrackIds)->delete();

        return $this->success();
    }
}
