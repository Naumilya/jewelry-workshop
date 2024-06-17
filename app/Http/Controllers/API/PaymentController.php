<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Master;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        DB::beginTransaction();

        try {
            $paymentStatus = 'success';
            $transactionId = 'FAKE' . rand(100000, 999999);

            $userId = $request->input('user_id');
            $products = $request->input('products');
            $orderDate = now()->toDateString();
            $deliveryDate = now()->addWeek()->toDateString();

            $orderIds = [];

            foreach ($products as $product) {
                $productId = $product['id'];
                $totalCost = $product['cost'];

                $master = Master::withCount('orders')
                    ->orderBy('orders_count', 'asc')
                    ->first();
                $masterId = $master->id;

                $order = new Order();
                $order->user_id = $userId;
                $order->product_id = $productId;
                $order->master_id = $masterId;
                $order->order_date = $orderDate;
                $order->delivery_date = $deliveryDate;
                $order->total_cost = $totalCost;
                $order->status = 'new';
                $order->save();

                $orderIds[] = $order->id;
            }

            DB::commit();

            return response()->json([
                'status' => $paymentStatus,
                'transactionId' => $transactionId,
                'orderIds' => $orderIds,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'status' => 'failed',
                'message' => 'Payment processing failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
