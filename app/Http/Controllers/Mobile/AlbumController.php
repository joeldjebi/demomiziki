<?php

namespace App\Http\Controllers\Mobile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Album;

class AlbumController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllalbum()
    {   
        // dd('ok');
        $data['albums'] = Album::All()->where('created_at', 'desc')->get()->toJson(JSON_PRETTY_PRINT);
        return response($data['albums'], 200);
    } 


}