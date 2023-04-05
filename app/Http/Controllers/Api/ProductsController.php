<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
  public function index()
  {
    $products = Product::all();
    
    return ProductResource::collection($products);
  }
  
  public function store(Request $request)
  {
    $product = Product::create($request->all());
    $data = new ProductResource($product);
    
    return response()->json(['status' => true, 'message' => 'New Product Succesfully Added !', 'data' => $data], 200);
  }
  
  public function show(Product $product)
  {
    $data = new ProductResource($product);
  
    return response()->json(['status' => true, 'message' => 'Success !', 'data' => $data], 200);
  
  }
  
  public function update(Request $request, Product $product)
  {
    $product->update($request->all());
    $data = new ProductResource($product);
    
    return response()->json(['status' => true, 'message' => 'Product has been changed !', 'data' => $data], 200);
  
  }
  
  public function destroy(Product $product)
  {
    $product->delete();
    
    return response()->json(null, 204);
  }
}
