<?php

namespace App\Listeners;

use App\Events\Lemon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPodcastNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Lemon  $event
     * @return void
     */
    public function handle(Lemon $event)
    {
        //
    }
}
