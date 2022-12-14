<?php

namespace App\Listeners\Product;

use App\Events\Product\StoredSuccessful;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendStoredSuccessfulNotification implements ShouldQueue
{
    use InteractsWithQueue;

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
     * @param  \App\Events\Product\StoredSuccessful  $event
     * @return void
     */
    public function handle(StoredSuccessful $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event->class, "User:[{$event->user}] has successfully added a product. event occured from this client:[{$ip}]");
    }

    protected function info($class, $message)
    {
        //$class = class_basename($event::class);
        info("[{$class}] {$message}");
    }
}
