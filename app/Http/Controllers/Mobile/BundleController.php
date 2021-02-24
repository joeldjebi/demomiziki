<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BundleController extends Controller
{     
    /**
    * @var Request
    */
   protected $request;

   /**
    * @param Request $request
    * @param ArtistsRepository $repository
    */
   public function __construct(Request $request)
   {
       $this->request = $request;
   }

    //
    public function reduceMiziki (Request $request) {
        $user = auth()->user();
        $miziki_restant = $user->miziki - 1;
        $user->update([
            'miziki' => ($miziki_restant)<0 ? 0 : $miziki_restant
        ]);
        return $this->sendResponse('success', []);
    }
    //
    public function increaseMiziki (Request $request) {
        $user = auth()->user();
        $miziki_restant = $user->miziki + abs($this->request->get('miziki'));
        $user->update([
            'miziki' => ($miziki_restant)<0 ? 0 : $miziki_restant
        ]);
        return $this->sendResponse('success', []);
    }
}
