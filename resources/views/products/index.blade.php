<x-app-layout>
<div class="p-6">
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-2xl font-bold">
            Product List
        </h2>
        <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Add Product
        </a>
    </div>
    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <!-- FILTERS -->
    <div class="grid grid-cols-2 gap-4 mb-5">
        <!-- CATEGORY FILTER -->
        <div>
            <select id="category" class="w-full border rounded p-2">
                <option value=""> All Categories </option>
                <option value="Medicine"> Medicine </option>
                <option value="Equipment"> Equipment </option>
            </select>
        </div>
        <!-- STATUS FILTER -->
        <div>
            <select id="status" class="w-full border rounded p-2">
                <option value=""> All Status </option>
                <option value="active"> Active </option>
                <option value="inactive"> Inactive </option>
            </select>
        </div>
    </div>
    <!-- TABLE -->
    <div class="overflow-x-auto bg-white  rounded-lg">
        <table id="products-table" class="min-w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border"> ID </th>
                    <th class="px-4 py-2 border"> Category </th>
                    <th class="px-4 py-2 border"> Subcategory </th>
                    <th class="px-4 py-2 border"> Product Name </th>
                    <th class="px-4 py-2 border"> Price </th>
                    <th class="px-4 py-2 border"> Quantity </th>
                    <th class="px-4 py-2 border"> Status </th>
                    <th class="px-4 py-2 border"> Action </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
</x-app-layout>

<script>
$(document).ready(function () {
    let table = $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('products.index') }}",
            data: function (d) {
                d.category = $('#category').val();
                d.status = $('#status').val();
            }
        },
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'subcategory',
                name: 'subcategory'
            },
            {
                data: 'product_name',
                name: 'product_name'
            },
            {
                data: 'price',
                name: 'price'
            },
            {
                data: 'quantity',
                name: 'quantity'
            },
            {
                data: 'status_badge',
                name: 'status',
                orderable: false,
                searchable: false
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]

    });
    // FILTER EVENT
    $('#category, #status').change(function () {
        table.draw();
    });
});
</script>