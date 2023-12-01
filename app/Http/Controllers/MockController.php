<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MockController extends Controller
{
    public function mockResponse(Request $request)
    {
        $mockStatus = $request->header('X-Mock-Status');

        if ($mockStatus === 'accepted') {
            return response()->json(['status' => 'accepted']);
        } elseif ($mockStatus === 'failed') {
            return response()->json(['status' => 'failed']);
        } else {
            return response()->json(['error' => 'Invalid X-Mock-Status'], 400);
        }
    }
}
