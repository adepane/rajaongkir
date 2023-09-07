<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validators = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validators->fails()) {
            return response()->json([
                'success' => false,
                'status' => [
                    'code' => 200,
                    'message' => 'Your email or password is empty',
                ],
                'data' => (object) [],
            ]);
        }

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
