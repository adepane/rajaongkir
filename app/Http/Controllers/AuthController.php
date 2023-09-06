<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => request('email'),
            'password' => request('password'),
        ];
        if (! Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'status' => [
                    'code' => 200,
                    'message' => 'Your email or password is incorrect',
                ],
                'data' => (object) [],
            ]);
        }

        $user = $request->user();
        $tokenResult = $user->createToken($user->name.' Access Token');
        $token = $tokenResult->plainTextToken;

        return response()->json([
            'success' => true,
            'status' => [
                'code' => 200,
                'message' => 'Successfully logged in',
            ],
            'data' => [
                'accessToken' => $token,
                'tokenType' => 'Bearer',
                'user' => $user,
            ],
        ]);
    }
}
