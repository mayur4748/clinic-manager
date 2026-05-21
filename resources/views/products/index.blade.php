<x-app-layout>
<div class="p-6">
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-2xl font-bold"> Product List </h2>
        <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"> Add Product </a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Category</th>
                    <th class="px-4 py-2 border">Subcategory</th>
                    <th class="px-4 py-2 border">Product Name</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border">Quantity</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="text-center">
                        <td class="px-4 py-2 border"> {{ $product->id }} </td>
                        <td class="px-4 py-2 border"> {{ $product->category }} </td>
                        <td class="px-4 py-2 border"> {{ $product->subcategory }} </td>
                        <td class="px-4 py-2 border"> {{ $product->product_name }} </td>
                        <td class="px-4 py-2 border"> ₹{{ $product->price }} </td>
                        <td class="px-4 py-2 border"> {{ $product->quantity }} </td>
                        <td class="px-4 py-2 border">
                            @if($product->status == 'active')
                                <span class="bg-green-200 text-green-800 px-2 py-1 rounded text-sm"> Active </span>
                            @else
                                <span class="bg-red-200 text-red-800 px-2 py-1 rounded text-sm"> Inactive </span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded"> Edit </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center px-4 py-4">
                            No Products Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>