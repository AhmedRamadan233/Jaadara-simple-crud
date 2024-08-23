<?php

namespace App\Http\Controllers\__Auth\Blade\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\__Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('__Auth.login.login');
    }


    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !$user->is_verified) {

            return redirect()->back()->withErrors(['login' => 'Account not verified']);
        }

        if (Auth::attempt($credentials)) {
            Auth::login($user);

            return redirect()->route('posts');
        } else {
            return redirect()->back()->withErrors(['login' => 'Invalid credentials.']);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
