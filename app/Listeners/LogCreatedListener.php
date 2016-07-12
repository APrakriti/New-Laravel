<?php

namespace App\Listeners;

use App\User;
use App\Models\Log;
use App\Events\LogCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogCreatedListener
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
     * @param  LogCreated  $event
     * @return void
     */
    public function handle(LogCreated $event)
    {
        $user = User::find($event->user->id);        
        $log = new Log;
        $log->description = $event->data;
        $user->logs()->save($log);
    }
}
