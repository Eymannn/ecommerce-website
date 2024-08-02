<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    
    public function handle(Authenticated $event)
    {
        $user = $event->user;

        if ($user->status === 'banned') {
            Auth::logout();
            abort(403, 'Your account has been banned.');
        }
    }
}
