<?php

namespace Tests\Feature;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CallbackApiTest extends TestCase
{
    public function testCallbackApi()
    {
        $transaction = Transaction::first();

        if ($transaction) {
            $response = $this->postJson('/api/callback', [
                'transaction_id' => '6569c26606d6d',
                'status'         => 'failed',
            ]);
            $response->assertStatus(200);
        }
        else {
            $this->assertTrue(true);
        }
    }
}
