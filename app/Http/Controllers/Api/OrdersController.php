<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
  public function index()
  {
    $products = Order::all();
    
    return OrderResource::collection($products);
  }
  
  public function store(Request $request)
  {
    $product = Order::create($request->all());
    $data = new OrderResource($product);
    
    return response()->json(['status' => true, 'message' => 'New Order Succesfully Added !', 'data' => $data], 200);
  }
  
  public function show(Order $product)
  {
    $data = new OrderResource($product);
    
    return response()->json(['status' => true, 'message' => 'Success !', 'data' => $data], 200);
    
  }
  
  public function update(Request $request, Order $product)
  {
    $product->update($request->all());
    $data = new OrderResource($product);
    
    return response()->json(['status' => true, 'message' => 'Order has been changed !', 'data' => $data], 200);
    
  }
  
  public function destroy(Order $product)
  {
    $product->delete();
    
    return response()->json(null, 204);
  }
}
