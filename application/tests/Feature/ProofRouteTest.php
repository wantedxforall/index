<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProofRouteTest extends TestCase
{
    /** @test */
    public function proof_route_requires_authentication(): void
    {
        $response = $this->get('/user/proof/1');
        $response->assertStatus(302); // redirected to login
    }
}