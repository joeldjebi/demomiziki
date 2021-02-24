<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     /**
     * @var Request
     */
    private $request;

    /**
     * @param Request $request
     * @param ArtistsRepository $repository
     */
	public function __construct(Request $request)
	{
        $this->request = $request;
        $this->middleware('auth:api', ['except' => ['login', 'createAccount']]);
    }

    public function login(Request $request)
    { 
        //dd($this->request->get('email'));
        $request = $this->request->request->all();
        Validator($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ])->validate();
        
        $credentials = [
            'email' => $this->request->get('email'),
            'password' => $this->request->get('password'),
        ];

        //dd($credentials);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'email ou mot de passe incorrect.'], 401);
        }
        return $this->respondWithToken($token);
    }

    /**
     * creation de compte
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function  createAccount(Request $request){
        $request = $this->request->request->all();
        Validator($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact' => 'required|numeric|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ])->validate();

        $user = new User;
        $user->first_name = htmlspecialchars($this->request->get('first_name'));
        $user->last_name = htmlspecialchars($this->request->get('last_name'));
        $user->contact = htmlspecialchars($request->contact);
        $user->email = htmlspecialchars($this->request->get('email'));
        $user->password = Hash::make($this->request->get('password'));

        if($user->save())
        {
            return $this->sendResponse('success',  $user->toArray());
        }

        return response()->json(['error' => 'Une erreur est survenu lors de la création de votre compte merci de reésseyer'], 401);
    }


     /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */

    protected function respondWithToken($token)
    {
        $user = auth()->user();
        $user['access_token'] = $token;
        $user['token_type'] = 'bearer';
        $user['expires_in'] = auth('api')->factory()->getTTL() * 60;
        return $user;
    }
}
