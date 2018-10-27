<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * it tests that a user is authenticated. The password comes from database/factories/UserFactory
     *
     * @see database/factories/UserFactory
     */
    public function testUserAuthentication()
    {
        $user = factory(User::class)->create();

        $body = [
            'email' => $user->email,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'
        ];

        $response = $this->json('POST', 'api/v1/auth/login', $body, ['Accept' => 'application/json']);

        self::assertTrue($response->getStatusCode() === 200);
    }
}