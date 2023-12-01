<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentProcessApiTest extends TestCase
{
    public function testTransactionStoreApi()
    {
        $response = $this->postJson('/api/process-payment', [
            'user_id' => 1,
            'amount'  => 100,
        ]);

        $response->assertStatus(200);
    }
}
