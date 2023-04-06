<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
  public function index()
  {
    $orders = Order::all();
    
    return OrderResource::collection($orders);
  }
  
  public function store(Request $request)
  {
    try {
      $order = Order::create($request->all());
      $data = new OrderResource($order);
      
      return response()->json(['status' => true, 'message' => 'New Order Succesfully Added !', 'data' => $data], 200);
    } catch (\Exception $e) {
      return response()->json(['status' => false, 'message' => 'Failed to add new order.'], 500);
    }
  }
  
  public function show($id = null)
  {
    try {
      if ($id) {
        $order = Order::findOrFail($id);
        $data = new OrderResource($order);
      } else {
        $orders = Order::all();
        $data = OrderResource::collection($orders);
      }
      
      return response()->json(['status' => true, 'message' => 'Success !', 'data' => $data], 200);
    } catch (ModelNotFoundException $ex) {
      return response()->json(['status' => false, 'message' => 'Order not found.'], 404);
    } catch (\Exception $ex) {
      return response()->json(['status' => false, 'message' => 'An error occurred.'], 500);
    }
  }
  
  public function update(Request $request, Order $order)
  {
    try {
      $order->update($request->all());
      $data = new OrderResource($order);
      
      return response()->json(['status' => true, 'message' => 'Order has been changed !', 'data' => $data], 200);
    } catch (ModelNotFoundException $ex) {
      return response()->json(['status' => false, 'message' => 'Order not found.'], 404);
    } catch (\Exception $ex) {
      return response()->json(['status' => false, 'message' => 'An error occurred.'], 500);
    }
  }
  
  public function destroy(Order $order)
  {
    try {
      $order->delete();
      
      return response()->json(null, 204);
    } catch (ModelNotFoundException $ex) {
      return response()->json(['status' => false, 'message' => 'Order not found.'], 404);
    } catch (\Exception $ex) {
      return response()->json(['status' => false, 'message' => 'An error occurred.'], 500);
    }
  }
}
