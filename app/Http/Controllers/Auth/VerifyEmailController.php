<?php

namespace App\Http\Controllers\Auth;
use App\Jobs\WelcomeEmailJob;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {

            return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            WelcomeEmailJob::dispatch($request->user());

        }

        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
    }

    // public function verify(EmailVerificationRequest $request)
    // {
    //     $request->fulfill();
    //     event(new Verified($request->user()));


    //     return redirect('/home');
    // }
}
