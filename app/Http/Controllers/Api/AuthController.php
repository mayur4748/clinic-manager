<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Login API
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {

            return response()->json([

                'message' => 'Invalid credentials'

            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([

            'token' => $token,

            'user' => $user

        ]);
    }

    /**
     * Logout API
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([

            'message' => 'Logged out successfully'

        ]);
    }
}