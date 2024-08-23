<?php

namespace App\Http\Controllers\__Auth\Blade\Verification;

use App\Http\Controllers\Controller;
use App\Http\Requests\__Auth\VerificationRequest;
use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function index()
    {
        return view('__Auth.verify.verify');
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

        return redirect()->route('login.index');

    }
}
