<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Master;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->query('userId');
        $orders = Order::with('product')->where('user_id', $userId)->get();

        return response()->json([
            'status' => 'success',
            'orders' => $orders,
        ]);
    }



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
    public function updateStatus(Request $request)
    {
        DB::beginTransaction();

        try {
            $orderId = $request->input('orderId');
            $status = $request->input('status');

            Log::info('Updating order status', [
                'orderId' => $orderId,
                'status' => $status
            ]);

            $order = Order::find($orderId);

            if ($order) {
                $order->status = $status;
                $order->save();

                Log::info('Order status updated successfully', [
                    'orderId' => $orderId,
                    'newStatus' => $order->status
                ]);

                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Order status updated successfully',
                ]);
            } else {
                Log::error('Order not found', ['orderId' => $orderId]);
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Order not found',
                ], 404);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order status update failed', [
                'orderId' => $orderId,
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'status' => 'failed',
                'message' => 'Order status update failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



}
