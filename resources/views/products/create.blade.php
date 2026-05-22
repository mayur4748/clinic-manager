<x-app-layout>
<div class="max-w-4xl mx-auto p-6">
    <!-- CARD -->
    <div class="bg-white   rounded-lg p-6">
        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800"> Create Product </h2>
            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"> Back </a>
        </div>
        <!-- VALIDATION ERROR -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- FORM -->
        <form id="productForm" action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- CATEGORY -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Category *
                    </label>
                    <select name="category" id="category" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
                        <option value=""> Select Category </option>
                        <option value="Medicine" {{ old('category') == 'Medicine' ? 'selected' : '' }}> Medicine </option>
                        <option value="Equipment" {{ old('category') == 'Equipment' ? 'selected' : '' }}> Equipment </option>
                    </select>
                </div>
                <!-- SUBCATEGORY -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Subcategory *
                    </label>
                    <select name="subcategory" id="subcategory" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
                        <option value=""> Select Subcategory </option>
                    </select>
                </div>
                <!-- PRODUCT NAME -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Product Name *
                    </label>
                    <input type="text" name="product_name" value="{{ old('product_name') }}" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200" placeholder="Enter Product Name">
                </div>
                <!-- PRICE -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Price *
                    </label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200" placeholder="Enter Price">
                </div>
                <!-- QUANTITY -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Quantity *
                    </label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200" placeholder="Enter Quantity">
                </div>
                <!-- STATUS -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Status
                    </label>
                    <select name="status" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}> Active </option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}> Inactive </option>
                    </select>
                </div>
            </div>
            <!-- BUTTON -->
            <div class="mt-6">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg shadow">
                    Save Product
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
<!-- SUBCATEGORY SCRIPT -->

<script>

$(document).ready(function () {

    $('#productForm').validate({
        rules: {
            category: {
                required: true
            },
            subcategory: {
                required: true
            },
            product_name: {
                required: true,
                minlength: 3
            },
            price: {
                required: true,
                number: true,
                min: 1
            },
            quantity: {
                required: true,
                digits: true,
                min: 1
            },
            status: {
                required: true
            }
        },
        messages: {
            category: {
                required: "Please select category"
            },
            subcategory: {
                required: "Please select subcategory"
            },
            product_name: {
                required: "Product name is required",
                minlength: "Minimum 3 characters"
            },
            price: {
                required: "Price is required",
                number: "Only numeric value allowed",
                min: "Minimum price is 1"
            },
            quantity: {
                required: "Quantity is required",
                digits: "Only whole numbers allowed",
                min: "Minimum quantity is 1"
            },
            status: {
                required: "Please select status"
            }
        },
        errorElement: 'span',
        errorClass: 'text-red-500 text-sm',
    });
});

</script>

<script>
    const subcategories = {
        Medicine: [
            'Tablet',
            'Syrup',
            'Injection'
        ],

        Equipment: [
            'Machine',
            'Tool',
            'Monitor'
        ]
    };

    const categoryDropdown = document.getElementById('category');
    const subcategoryDropdown = document.getElementById('subcategory');
    function loadSubcategories(selectedValue = '') {
        let category = categoryDropdown.value;
        subcategoryDropdown.innerHTML = '<option value="">Select Subcategory</option>';
        if(subcategories[category]) {
            subcategories[category].forEach(function(item){
                let selected = item === selectedValue ? 'selected' : '';
                subcategoryDropdown.innerHTML += `<option value="${item}" ${selected}> ${item} </option>`;
            });
        }
    }
    // CATEGORY CHANGE
    categoryDropdown.addEventListener(
        'change',
        function () {
            loadSubcategories();
        }
    );
    // OLD VALUE LOAD
    window.onload = function () {
        loadSubcategories(
            "{{ old('subcategory') }}"
        );
    };
</script>
