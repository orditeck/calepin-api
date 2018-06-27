<?php

namespace App\Observers;

use App\User;

class UserObserver
{
    /**
     * Listen to the User creating event.
     *
     * @param  User $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->api_token = $this->generateApiToken();
    }

    /**
     * Return a unique personal access token.
     *
     * @return String
     */
    private function generateApiToken(): string
    {
        do {
            $api_token = str_random(60);
        } while (User::where('api_token', $api_token)->exists());

        return $api_token;
    }
}