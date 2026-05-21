<x-app-layout>
<div class="container p-5">
    <h2 class="text-2xl font-bold mb-5">
        Edit Product
    </h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        {{-- Category --}}
        <div class="mb-3">
            <label>Category</label>
            <select name="category" id="category" class="form-control">
                <option value="">Select Category</option>
                <option value="Medicine" {{ $product->category == 'Medicine' ? 'selected' : '' }}> Medicine </option>
                <option value="Equipment" {{ $product->category == 'Equipment' ? 'selected' : '' }}> Equipment </option>
            </select>
        </div>
        {{-- Subcategory --}}
        <div class="mb-3">
            <label>Subcategory</label>
            <select name="subcategory" id="subcategory" class="form-control"> </select>
        </div>
        {{-- Product Name --}}
        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}">
        </div>
        {{-- Price --}}
        <div class="mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}">
        </div>
        {{-- Quantity --}}
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}">
        </div>
        {{-- Status --}}
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}> Active </option>
                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}> Inactive </option>
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded"> Update Product </button>
    </form>
</div>
<script>
    const subcategories = {
        Medicine: ['Tablet', 'Syrup'],
        Equipment: ['Machine', 'Tool']
    };
    let categoryDropdown = document.getElementById('category');
    let subcategoryDropdown = document.getElementById('subcategory');
    let selectedSubcategory = "{{ $product->subcategory }}";
    function loadSubcategories(category) {
        subcategoryDropdown.innerHTML = '';
        if (subcategories[category]) {
            subcategories[category].forEach(function(item) {
                let option = document.createElement('option');
                option.value = item;
                option.text = item;
                if (item === selectedSubcategory) {
                    option.selected = true;
                }
                subcategoryDropdown.appendChild(option);
            });
        }
    }
    loadSubcategories(categoryDropdown.value);
    categoryDropdown.addEventListener('change', function () {
        loadSubcategories(this.value);
    });
</script>

</x-app-layout>