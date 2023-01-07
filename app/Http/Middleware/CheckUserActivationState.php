<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserActivationState
{
    public function handle(Request $request, Closure $next, $requiredActivationState)
    {
        if ($requiredActivationState != User::ACTIVATION_STATE_AWAITING_ACTIVATION && Auth::user()->activation_state == User::ACTIVATION_STATE_AWAITING_ACTIVATION) {
            // Required : Account activated/disabled
            // Account awaiting activation => route:users.account_activation
            return redirect()->route('users.account_activation');
        }

        if ($requiredActivationState == User::ACTIVATION_STATE_AWAITING_ACTIVATION && Auth::user()->activation_state != User::ACTIVATION_STATE_AWAITING_ACTIVATION) {
            // Required : Account awaiting activation
            // Account activated/disabled => route:applications
            return redirect()->route('dashboard');
        }


        return $next($request);
    }
}
