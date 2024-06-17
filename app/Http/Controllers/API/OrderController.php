<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
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
