<x-app-layout>
{{-- @extends('layouts.app')

@section('content') --}}

<div class="container">

    <h2>Create Product</h2>

    <form action="{{ route('products.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Category</label>
            <input type="text" name="category" class="form-control">
        </div>

        <div class="mb-3">
            <label>Subcategory</label>
            <input type="text" name="subcategory" class="form-control">
        </div>

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="product_name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control">
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>

            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            Save Product
        </button>

    </form>

</div>

{{-- @endsection --}}

</x-app-layout>