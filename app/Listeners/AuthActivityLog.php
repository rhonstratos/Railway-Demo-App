<?php

namespace App\Listeners;

use Illuminate\Auth\Events;

class AuthActivityLog
{
    public function attempting(Events\Attempting $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event, "User {$event->user->userId} attempting from {$ip}", $event->user->only('userId'));
    }

    public function authenticated(Events\Authenticated $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event, "User {$event->user->userId} authenticated from {$ip}", $event->user->only('userId'));
    }

    public function login(Events\Login $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event, "User {$event->user->userId} logged in from {$ip}", $event->user->only('userId'));
    }

    public function validated(Events\Validated $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event, "User {$event->user->userId} validated from {$ip}", $event->user->only('userId'));
    }

    public function verified(Events\Verified $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event, "User {$event->user->userId} verified from {$ip}", $event->user->only('userId'));
    }

    public function logout(Events\Logout $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event, "User {$event->user->userId} logged out from {$ip}", $event->user->only('userId'));
    }

    public function currentDeviceLogout(Events\CurrentDeviceLogout $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event, "User {$event->user->userId} current device logout from {$ip}", $event->user->only('userId'));
    }

    public function otherDeviceLogout(Events\OtherDeviceLogout $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event, "User {$event->user->userId} other device logout from {$ip}", $event->user->only('userId'));
    }

    public function lockout(Events\Lockout $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event, "User {$event->user->userId} lockout from {$ip}", $event->user->only('userId'));
    }

    public function registered(Events\Registered $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event, "User registered: {$event->user->userId} from {$ip}");
    }

    public function failed(Events\Failed $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event, "User {$event->credentials['email']} login failed from {$ip}", ['email' => $event->credentials['email']]);
    }

    public function passwordReset(Events\PasswordReset $event)
    {
        $ip = request()->getClientIp(true);
        $this->info($event, "User {$event->user->userId} password reset from {$ip}", $event->user->only('userId', 'email'));
    }

    protected function info(object $event, string $message, array $context = [])
    {
        //$class = class_basename($event::class);
        $class = get_class($event);

        info("[{$class}] {$message}", $context);
    }
}
