<?php

namespace Vanguard\Listeners\Login;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Vanguard\Events\User\LoggedIn;
use Vanguard\Repositories\User\UserRepository;

class UpdateLastLoginTimestamp
{
    public function __construct(private UserRepository $users, private Guard $guard)
    {
    }

    /**
     * Handle the event.
     *
     * @param LoggedIn $event
     * @return void
     */
    public function handle(LoggedIn $event)
    {
        $this->users->update(
            $this->guard->id(),
            ['last_login' => Carbon::now()]
        );
    }
}
