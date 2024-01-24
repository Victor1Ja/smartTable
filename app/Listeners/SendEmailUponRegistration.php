<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\InformAdminOfNewUser;
use App\Notifications\WelcomeNewUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailUponRegistration
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
    public function handle(object $event): void
    {

        return;

        $event->user->notify(new WelcomeNewUser());

        $admin = User::where('is_admin', true)->first();
        if ($admin) {
            $admin->notify(new InformAdminOfNewUser($event->user));
        }
    }
}
