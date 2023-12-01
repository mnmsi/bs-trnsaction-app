<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CallbackController extends Controller
{
    public function callback(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required|string',
            'status'         => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()
                ->json($validator->errors()->toArray(), 422);
        }

        // Update the record based on transaction_id and status
        $isUpdate = $this->updateTransaction($request->transaction_id, $request->status);

        if ($isUpdate) {
            return response()
                ->json([
                    'message' => 'Transaction updated successfully',
                ]);
        }

        return response()->json(['error' => 'Something went wrong!'], 500);
    }

    private function updateTransaction($transactionId, $status)
    {
        return Transaction::where('transaction_id', $transactionId)
            ->update([
                'status' => $status,
            ]);
    }
}
