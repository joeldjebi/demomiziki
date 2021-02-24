<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendResponse(String $message='', $data = []) {
        return response()->json([
            'error'=>false,   
            'message'=>$message,
            'data'=>$data,
        ],200);
    }


    public function sendError(String $message='', $data = []) {
        return response()->json([
            'error'=>true,
            'message'=>$message,
            'data'=>$data,
        ],422);
    }
}
