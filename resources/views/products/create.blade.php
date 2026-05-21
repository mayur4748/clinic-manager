<x-app-layout>
<div class="container p-5">
    <h2 class="text-2xl font-bold mb-5"> Create Product </h2>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        {{-- Category --}}
        <div class="mb-3">
            <label>Category</label>
            <select name="category" id="category" class="form-control">
                <option value="">Select Category</option>
                <option value="Medicine">Medicine</option>
                <option value="Equipment">Equipment</option>
            </select>
        </div>
        {{-- Subcategory --}}
        <div class="mb-3">
            <label>Subcategory</label>
            <select name="subcategory" id="subcategory" class="form-control">
                <option value="">Select Subcategory</option>
            </select>
        </div>
        {{-- Product Name --}}
        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="product_name" class="form-control">
        </div>
        {{-- Price --}}
        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control">
        </div>
        {{-- Quantity --}}
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control">
        </div>
        {{-- Status --}}
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
            Save Product
        </button>
    </form>
</div>

<script>
    const subcategories = {
        Medicine: ['Tablet', 'Syrup'],
        Equipment: ['Machine', 'Tool']
    };

    document.getElementById('category')
        .addEventListener('change', function () {
        let category = this.value;
        let subcategoryDropdown = document.getElementById('subcategory');
        subcategoryDropdown.innerHTML = '<option value="">Select Subcategory</option>';
        if (subcategories[category]) {
            subcategories[category].forEach(function(item) {
                let option = document.createElement('option');
                option.value = item;
                option.text = item;
                subcategoryDropdown.appendChild(option);
            });
        }
    });
</script>
</x-app-layout>