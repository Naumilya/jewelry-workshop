<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $paymentStatus = 'success';
        $transactionId = 'FAKE' . rand(100000, 999999);

        return response()->json([
            'status' => $paymentStatus,
            'transactionId' => $transactionId,
        ]);
    }
}
