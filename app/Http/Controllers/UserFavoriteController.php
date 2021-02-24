<?php

namespace App\Http\Controllers;

use App\Actions\UserFavorite\CrupdateUserFavorite;
use App\Http\Requests\CrupdateUserFavoriteRequest;
use App\UserFavorite;
use Common\Core\BaseController;
use Common\Database\Paginator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserFavoriteController extends BaseController
{
    /**
     * @var UserFavorite
     */
    private $userFavorite;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param UserFavorite $userFavorite
     * @param Request $request
     */
    public function __construct(UserFavorite $userFavorite, Request $request)
    {
        $this->userFavorite = $userFavorite;
        $this->request = $request;
    }

    /**
     * @return Response
     */
    public function index()
    {
        $userId = $this->request->get('userId');
        $this->authorize('index', [UserFavorite::class, $userId]);

        $paginator = new Paginator($this->userFavorite, $this->request->all());

        if ($userId = $paginator->param('userId')) {
            $paginator->where('user_id', $userId);
        }

        $pagination = $paginator->paginate();

        return $this->success(['pagination' => $pagination]);
    }

    /**
     * @param UserFavorite $userFavorite
     * @return Response
     */
    public function show(UserFavorite $userFavorite)
    {
        $this->authorize('show', $userFavorite);

        return $this->success(['userFavorite' => $userFavorite]);
    }

    /**
     * @param CrupdateUserFavoriteRequest $request
     * @return Response
     */
    public function store(CrupdateUserFavoriteRequest $request)
    {
        $this->authorize('store', UserFavorite::class);

        $userFavorite = app(CrupdateUserFavorite::class)->execute($request->all());

        return $this->success(['userFavorite' => $userFavorite]);
    }

    /**
     * @param UserFavorite $userFavorite
     * @param CrupdateUserFavoriteRequest $request
     * @return Response
     */
    public function update(UserFavorite $userFavorite, CrupdateUserFavoriteRequest $request)
    {
        $this->authorize('store', $userFavorite);

        $userFavorite = app(CrupdateUserFavorite::class)->execute($request->all(), $userFavorite);

        return $this->success(['userFavorite' => $userFavorite]);
    }

    /**
     * @param string $ids
     * @return Response
     */
    public function destroy($ids)
    {
        $userFavoriteIds = explode(',', $ids);
        $this->authorize('store', [UserFavorite::class, $userFavoriteIds]);

        $this->userFavorite->whereIn('id', $userFavoriteIds)->delete();

        return $this->success();
    }
}
