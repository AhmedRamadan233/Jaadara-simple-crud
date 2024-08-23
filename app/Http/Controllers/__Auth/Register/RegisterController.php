<?php

namespace App\Http\Controllers\__Auth\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\__Auth\RegisterRequest;
use App\Models\User;
use App\Notifications\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
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

        // $user->notify(new UserVerification($verificationCode));

        $token = $user->createToken('user', ['app:all']);

        return response()->json([
            'token' => $token->plainTextToken,
            'success' => 'New account successfully created',
        ], 200);
    }
}
