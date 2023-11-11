<?php

namespace Vanguard\Listeners\Users;

use Illuminate\Auth\Events\Verified;
use Vanguard\Repositories\User\UserRepository;
use Vanguard\Support\Enum\UserStatus;

class ActivateUser
{
    public function __construct(private UserRepository $users)
    {
    }

    /**
     * Handle the event.
     *
     * @param Verified $event
     * @return void
     */
    public function handle(Verified $event)
    {
        $this->users->update($event->user->id, [
            'status' => UserStatus::ACTIVE
        ]);
    }
}
