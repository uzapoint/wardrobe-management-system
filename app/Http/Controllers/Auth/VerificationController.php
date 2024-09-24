<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function sendNotification(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(status: 400, data: 'Already verified');
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['status' => 'verification link sent']);
    }

    public function verify(EmailVerificationRequest $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['status' => 'Already verified'], status: 400);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json(['status' => 'Successfully verified']);
    }
}
