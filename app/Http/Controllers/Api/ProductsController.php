<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    try {
      $product = Product::create($request->all());
      $data = new ProductResource($product);
      return response()->json(['status' => true, 'message' => 'New Product Succesfully Added!', 'data' => $data], 200);
    } catch (\Exception $e) {
      return response()->json(['status' => false, 'message' => 'Failed to add new product.'], 500);
    }
  }
  
  public function show($id = null)
  {
    try {
      $product = Product::findOrFail($id);
      $data = new ProductResource($product);
      return response()->json(['status' => true, 'message' => 'Success!', 'data' => $data], 200);
    } catch (ModelNotFoundException $ex) {
      return response()->json(['status' => false, 'message' => 'Product not found.'], 404);
    } catch (\Exception $ex) {
      return response()->json(['status' => false, 'message' => 'An error occurred.'], 500);
    }
  }
  
  
  public function update(Request $request, Product $product)
  {
    try {
      $product->update($request->all());
      $data = new ProductResource($product);
      return response()->json(['status' => true, 'message' => 'Product has been changed!', 'data' => $data], 200);
    } catch (ModelNotFoundException $ex) {
      return response()->json(['status' => false, 'message' => 'Product not found.'], 404);
    } catch (\Exception $ex) {
      return response()->json(['status' => false, 'message' => 'An error occurred.'], 500);
    }
  }
  
  public function destroy(Product $product)
  {
    try {
      $product->delete();
      return response()->json(null, 204);
    } catch (ModelNotFoundException $ex) {
      return response()->json(['status' => false, 'message' => 'Product not found.'], 404);
    } catch (\Exception $ex) {
      return response()->json(['status' => false, 'message' => 'An error occurred.'], 500);
    }
  }
}
