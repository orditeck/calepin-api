<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    /**
     * Listen to the creating event.
     *
     * @param  User $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->api_token = $user->generateApiToken();
    }
}