<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;

class MidtransController extends Controller
{
  public function index(Request $request)
  {
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;
    
    $order = Order::findOrFail($request->order_id);
    
    $transaction_details = [
      'order_id' => $order->id,
      'gross_amount' => $order->total,
    ];
    
    $snapToken = Snap::getSnapToken($transaction_details);
    
    return response()->json(['snap_token' => $snapToken]);
  }
  
  public function handleWebhook(Request $request)
  {
      // Get the order ID from the notification
      $order_id = $request->order_id;
    
      // Get the order from your database
      $order = Order::findOrFail($order_id);
    
      // Check if the payment status is successful
      if ($request->transaction_status == 'capture') {
        // Update the order status to "success"
        $order->status = "success";
        $order->save();
      }
    
    // Return a success response to Midtrans
    return response()->json(['status' => 'OK'], 200);
  }
}
