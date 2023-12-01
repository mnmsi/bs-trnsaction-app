<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MockResponseApiTest extends TestCase
{
    public function testMockResponseApi()
    {
        $response = $this->withHeader('X-Mock-Status', 'accepted')
            ->getJson('/api/mock-response');

        $response->assertStatus(200);
    }
}
