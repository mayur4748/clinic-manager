<x-app-layout>

{{-- @section('content') --}}

<div class="container">

    <h2>Product List</h2>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
        Add Product
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Status</th>
                <th width="200">Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach($products as $product)

            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->category }}</td>
                <td>{{ $product->subcategory }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->status }}</td>

                <td>

                    <a href="{{ route('products.edit', $product->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('products.destroy', $product->id) }}"
                          method="POST"
                          style="display:inline-block;">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger btn-sm">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

{{-- @endsection --}}

</x-app-layout>