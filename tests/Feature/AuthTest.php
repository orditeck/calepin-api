<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class NotesTest extends TestCase
{
    public function testNotesGet()
    {
        $user = factory(User::class)->create();

        $body = [
            'email' => $user->email,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'
        ];

        $response = $this->json('POST', 'api/v1/auth/login', $body, ['Accept' => 'application/json']);

        $authenticated = json_decode($response->getContent(), true);
        $token = $authenticated['meta']['access_token'];

        $response = $this->get('api/v1/notes', [
            'authorization' => "Bearer $token"
        ]);

        var_dump($response->getContent());
    }
}