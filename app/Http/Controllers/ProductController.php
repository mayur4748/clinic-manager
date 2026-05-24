<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ActivityLog;
use Yajra\DataTables\Facades\DataTables;
class ProductController extends Controller
{
    /**
     * Display products
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::query();
            // Clinician only own products
            if(auth()->user()->role != 'admin')
            {
                $products->where( 'user_id', auth()->id() );
            }
            // CATEGORY FILTER
            if($request->category) {
                $products->where( 'category', $request->category );
            }
            // STATUS FILTER
            if($request->status) {
                $products->where( 'status', $request->status );
            }
            return DataTables::of($products)
                ->addIndexColumn()
                ->editColumn('price', function ($row) {
                    return '₹'.$row->price;
                })
                ->addColumn('status_badge', function ($row) {
                    if($row->status == 'active') {
                        return '<span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs">
                                Active
                            </span> ';
                    }
                    return ' <span class="bg-red-200 text-red-800 px-2 py-1 rounded text-xs">
                            Inactive
                        </span> ';
                })
                ->addColumn('action', function ($row) {
                    $edit = route( 'products.edit', $row->id );
                    $delete = route( 'products.destroy', $row->id );
                    return '
                        <div class="flex justify-center gap-2">
                            <a href="'.$edit.'"
                            class="bg-yellow-400 hover:bg-yellow-500  text-black px-3 py-1 rounded">
                                Edit
                            </a>
                            <form action="'.$delete.'"
                                method="POST">
                                '.csrf_field().'
                                '.method_field("DELETE").'
                                <button type="submit"
                                        onclick="return confirm(`Are you sure?`)"
                                        class="bg-red-500 hover:bg-red-600  text-black px-3 py-1 rounded">
                                    Delete
                                </button>
                            </form>
                        </div>
                    ';
                })
                ->rawColumns([
                    'status_badge',
                    'action'
                ])
                ->make(true);
        }
        return view('products.index');
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store product
     */
    public function store(Request $request)
    {
        Product::create([
            'user_id' => auth()->id(),
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status,
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Create',
            'module' => 'Product',
            'description' => 'Created product: ' . $request->product_name
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');
    }

    /**
     * Show edit form
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update product
     */
    public function update(Request $request, Product $product)
    {
        $product->update([
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status,
        ]);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Update',
            'module' => 'Product',
            'description' => 'Updated product: ' . $product->product_name
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Delete product
     */
    public function destroy(Product $product)
    {
        
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Delete',
            'module' => 'Product',
            'description' => 'Deleted product: ' . $product->product_name
        ]);

        $product->delete();
        
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}