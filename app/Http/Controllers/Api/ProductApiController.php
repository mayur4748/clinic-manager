<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * GET /api/products
     * List logged-in user's products
     */
    public function index()
    {
        $products = Product::where(
            'user_id',
            auth()->id()
        )->get();

        return response()->json([
            'status' => true,
            'message' => 'Product list fetched successfully',
            'data' => $products
        ], 200);
    }

    /**
     * POST /api/products
     * Create product
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'product_name' => 'required|min:3',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'status' => 'required'
        ]);

        $product = Product::create([
            'user_id' => auth()->id(),
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    /**
     * GET /api/products/{id}
     * View single product
     */
    public function show($id)
    {
        $product = Product::where('user_id', auth()->id())
                    ->find($id);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $product
        ], 200);
    }

    /**
     * PUT /api/products/{id}
     * Update product
     */
    public function update(Request $request, $id)
    {
        $product = Product::where('user_id', auth()->id())
                    ->find($id);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }
        $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'product_name' => 'required|min:3',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'status' => 'required'
        ]);
        $product->update([
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ], 200);
    }

    /**
     * DELETE /api/products/{id}
     * Delete product
     */
    public function destroy($id)
    {
        $product = Product::where('user_id', auth()->id())
                    ->find($id);
        if (!$product) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }
        $product->delete();
        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ], 200);
    }
}