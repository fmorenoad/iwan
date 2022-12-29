<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {       
        
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials))
        {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60*24);

            return response([
                "token" => $token
            ], Response::HTTP_OK)->withoutCookie($cookie);
        } else {
            return response([
                "message" => "Credenciales no son válidas"
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout()
    {
        $cookie = Cookie::forget('cookie_token');
        return response([
            "message" => "Cierre de sesión OK"
        ], Response::HTTP_OK)->withoutCookie($cookie);
    }

    public function allUsers(Request $request)
    {

    }
}
