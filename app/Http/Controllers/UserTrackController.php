<?php

namespace App\Http\Controllers;

use App\Actions\UserTrack\CrupdateUserTrack;
use App\Http\Requests\CrupdateUserTrackRequest;
use App\UserTrack;
use Common\Core\BaseController;
use Common\Database\Paginator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserTrackController extends BaseController
{
    /**
     * @var UserTrack
     */
    private $userTrack;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param UserTrack $userTrack
     * @param Request $request
     */
    public function __construct(UserTrack $userTrack, Request $request)
    {
        $this->userTrack = $userTrack;
        $this->request = $request;
    }

    /**
     * @return Response
     */
    public function index()
    {
        $userId = $this->request->get('userId');
        $this->authorize('index', [UserTrack::class, $userId]);

        $paginator = new Paginator($this->userTrack, $this->request->all());

        if ($userId = $paginator->param('userId')) {
            $paginator->where('user_id', $userId);
        }

        $pagination = $paginator->paginate();

        return $this->success(['pagination' => $pagination]);
    }

    /**
     * @param UserTrack $userTrack
     * @return Response
     */
    public function show(UserTrack $userTrack)
    {
        $this->authorize('show', $userTrack);

        return $this->success(['userTrack' => $userTrack]);
    }

    /**
     * @param CrupdateUserTrackRequest $request
     * @return Response
     */
    public function store(CrupdateUserTrackRequest $request)
    {
        $this->authorize('store', UserTrack::class);

        $userTrack = app(CrupdateUserTrack::class)->execute($request->all());

        return $this->success(['userTrack' => $userTrack]);
    }

    /**
     * @param UserTrack $userTrack
     * @param CrupdateUserTrackRequest $request
     * @return Response
     */
    public function update(UserTrack $userTrack, CrupdateUserTrackRequest $request)
    {
        $this->authorize('store', $userTrack);

        $userTrack = app(CrupdateUserTrack::class)->execute($request->all(), $userTrack);

        return $this->success(['userTrack' => $userTrack]);
    }

    /**
     * @param string $ids
     * @return Response
     */
    public function destroy($ids)
    {
        $userTrackIds = explode(',', $ids);
        $this->authorize('store', [UserTrack::class, $userTrackIds]);

        $this->userTrack->whereIn('id', $userTrackIds)->delete();

        return $this->success();
    }
}
