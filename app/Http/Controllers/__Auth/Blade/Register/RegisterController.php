<?php

namespace App\Http\Controllers\__Auth\Blade\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\__Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('__Auth.register.register');
    }
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();
        $verificationCode = rand(100000, 999999);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'verification_code' =>  $verificationCode,
        ]);

        session(['email' => $validatedData['email']]);

        // $user->notify(new UserVerification($verificationCode));

        return redirect()->route('verify.index');
    }
}
