<?php

namespace App\Listeners;

use App\Events\FailedAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendFailedActionNotification implements ShouldQueue
{
    use InteractsWithQueue;

    // public $connection = 'database';
    // public $queue = 'listeners';
    // public $delay = 60;
    /**
     * Handle the event.
     *
     * @param  \App\Events\FailedAction  $event
     * @return void
     */
    public function handle(FailedAction $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event->class, "An error has occured in the backend, occured from this client:[{$ip}]", ['errors' => $event->errors]);
    }

    protected function info($class, $message, array $context = [])
    {
        //$class = class_basename($event::class);
        info("[{$class}] {$message}", $context);
    }
}
