<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * Product listing
     */
    public function index()
    {
        return response()->json(

            Product::all()

        );
    }

    /**
     * Store product
     */
    public function store(Request $request)
    {
        $product = Product::create([

            'user_id' => auth()->id(),

            'category' => $request->category,

            'subcategory' => $request->subcategory,

            'product_name' => $request->product_name,

            'price' => $request->price,

            'quantity' => $request->quantity,

            'status' => $request->status,

        ]);

        return response()->json($product);
    }

    /**
     * Show single product
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Update product
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return response()->json($product);
    }

    /**
     * Delete product
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([

            'message' => 'Product deleted'

        ]);
    }
}