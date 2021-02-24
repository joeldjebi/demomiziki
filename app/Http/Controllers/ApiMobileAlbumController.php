<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Album;
use App\Artist;
use App\Track;

class ApiMobileAlbumController extends Controller
{

    /**
     * Liste des album
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAllalbum(Request $request)
    {  
        $data['albums'] = Album::get()->toJson(JSON_PRETTY_PRINT);
        return response($data['albums'], 200);
    }

    /**
     * Liste des album
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        
        $id = htmlspecialchars($request->id);
        $album = Album::where('id',$id)->first();
        
        if($album){

            $data['artist'] = $album->artist()->get()->toJson(JSON_PRETTY_PRINT);
            $data['track'] = $album->tracks()->get()->toJson(JSON_PRETTY_PRINT);
            
			return response($data['track'], 200);

		}

    }
    /**
     * Liste des album
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function plays(Request $request)
    {
        $data['artist'] = Artist::has("tracks")->get()->toJson(JSON_PRETTY_PRINT);
        
		return response($data['artist'], 200);

    }


}