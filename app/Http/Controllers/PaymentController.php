<?php
// PaymentController.php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'amount'  => 'required|numeric',
            'user_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()
                ->json($validator->errors()->toArray(), 422);
        }

        $data = $request->all();

        $mockStatus = $this->getMockStatus();
        if ($mockStatus === 0) {
            return response()
                ->json(['error' => 'Invalid Mock Status'], 403);
        }

        $data['status']         = $mockStatus;
        $data['transaction_id'] = $this->generateTransactionId();
        $isStore                = $this->storeTransaction($data);

        if ($isStore) {
            return response()
                ->json([
                    'transaction_id' => $data['transaction_id'],
                ])
                ->header('Cache-Control', 'no-store');
        }

        return response()
            ->json(['error' => 'Something went wrong!'], 500);

    }

    private function generateTransactionId()
    {
        return uniqid();
    }

    private function storeTransaction($data)
    {
        $data['created_at'] = now();

        return Transaction::create($data);
    }

    private function getMockStatus()
    {
        $mockResponse = Http::withHeader('X-Mock-Status', 'accepted')
            ->get('http://localhost:8000/api/mock-response');

        if ($mockResponse->successful()) {
            return $mockResponse->json('status');
        }

        return 0;
    }
}
