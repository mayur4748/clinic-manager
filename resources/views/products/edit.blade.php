<x-app-layout>
{{-- @extends('layouts.app')

@section('content') --}}

<div class="container">

    <h2>Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Category</label>

            <input type="text"
                   name="category"
                   class="form-control"
                   value="{{ $product->category }}">
        </div>

        <div class="mb-3">
            <label>Subcategory</label>

            <input type="text"
                   name="subcategory"
                   class="form-control"
                   value="{{ $product->subcategory }}">
        </div>

        <div class="mb-3">
            <label>Product Name</label>

            <input type="text"
                   name="product_name"
                   class="form-control"
                   value="{{ $product->product_name }}">
        </div>

        <div class="mb-3">
            <label>Price</label>

            <input type="number"
                   step="0.01"
                   name="price"
                   class="form-control"
                   value="{{ $product->price }}">
        </div>

        <div class="mb-3">
            <label>Quantity</label>

            <input type="number"
                   name="quantity"
                   class="form-control"
                   value="{{ $product->quantity }}">
        </div>

        <div class="mb-3">
            <label>Status</label>

            <select name="status" class="form-control">

                <option value="active"
                    {{ $product->status == 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="inactive"
                    {{ $product->status == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>

            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Update Product
        </button>

    </form>

</div>

{{-- @endsection --}}

</x-app-layout>