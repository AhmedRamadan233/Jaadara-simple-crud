<?php

namespace App\Http\Controllers\__Auth\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\__Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !$user->is_verified) {
            return response()->json(['error' => 'Account not verified'], 403);
        }

        if (Auth::attempt($credentials)) {
            $user = User::find(auth()->id());
            $user->tokens()->delete();
            $token = $user->createToken(request()->userAgent());

            return response()->json([
                'token' => $token->plainTextToken,
                'success' => 'Login successful',
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout successful'
        ], 200);
    }
}
