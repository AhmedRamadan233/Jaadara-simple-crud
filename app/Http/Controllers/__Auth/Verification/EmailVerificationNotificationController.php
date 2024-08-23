<?php

namespace App\Http\Controllers\__Auth\Verification;

use App\Http\Controllers\Controller;
use App\Http\Requests\__Auth\EmailVerificationNotification;
use App\Http\Requests\__Auth\SendVerificationRequest;
use App\Http\Requests\__Auth\VerificationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\UserVerification;
use Illuminate\Support\Facades\Notification;

class EmailVerificationNotificationController extends Controller
{
    public function sendEmailVerification(SendVerificationRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $verificationCode = rand(100000, 999999);
        $user->verification_code = $verificationCode;
        $user->save();

        // Notification::send($user, new UserVerification($verificationCode));

        return response()->json(['success' => 'Verification code sent successfully'], 200);
    }


    public function verify(VerificationRequest $request)
    {
        $validatedData = $request->validated();
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || $user->verification_code !== $validatedData['verification_code']) {
            return response()->json(['error' => 'Invalid verification code'], 400);
        }

        $user->is_verified = true;
        $user->verification_code = null; 
        $user->save();

        return response()->json(['message' => 'Account verified successfully'], 200);
    }
}
