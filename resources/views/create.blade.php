<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laravel CRUD Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&display=swap");
      body {
        font-family: "Figtree", sans-serif;
      }
    </style>
  </head>
  <body class="bg-gray-100 py-10">
    <div class="max-w-7xl mx-auto p-6 sm:px-8 lg:px-10 bg-white shadow-md rounded-md">
      <!-- Header -->
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Create Product</h1>

        <!-- Back Button -->
        <a
          href="{{ route('products.index') }}"
          class="flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          <i data-feather="arrow-left" class="w-5 h-5 mr-2"></i>
          Back
        </a>
      </div>

      <!-- Horizontal Line -->
      <hr class="border-t-1 border-gray-300 mb-6" />
      <!-- Error Message -->
      @if ($errors->any())
      <div class="mb-6">
          <div class="p-4 mb-4 text-red-900 bg-red-100 border border-red-300 rounded">
              {{ $errors->first() }}
          </div>
      </div>
      @endif


      <!-- Edit Product Form -->
      <form action="{{ route('products') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- First Row: Product Name, Stock, Price -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div class="flex flex-col">
            <label for="productName" class="text-lg font-semibold text-gray-700 mb-2">Product Name</label>
            <input
              type="text"
              name="name"
              id="productName" value="{{old('name')}}"
              class="border border-gray-300 px-3 py-2 text-gray-800 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
          </div>

          <div class="flex flex-col">
            <label for="stock" class="text-lg font-semibold text-gray-700 mb-2">Stock</label>
            <input
              type="text"
              name="stock"
              id="stock" value="{{old('stock')}}"
              class="border border-gray-300 px-3 py-2 text-gray-800 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
          </div>

          <div class="flex flex-col">
            <label for="price" class="text-lg font-semibold text-gray-700 mb-2">Price</label>
            <input
              type="text"
              name="price" value="{{old('price')}}"
              id="price"
              class="border border-gray-300 px-3 py-2 text-gray-800 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
          </div>
        </div>

        <!-- Second Row: Product Details and Image -->
        <div class="grid grid-cols-1 gap-6 mt-6">
          <div class="flex flex-col">
            <label for="productDetails" class="text-lg font-semibold text-gray-700 mb-2">Product Details</label>
            <textarea
              name="description"
              id="productDetails" value="{{old('description')}}"
              rows="4"
              class="border border-gray-300 px-3 py-2 text-gray-800 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
          </div>

          <div class="flex flex-col">
            <label for="productImage" class="text-lg font-semibold text-gray-700 mb-2">Product Image</label>
            <input
              type="file"
              name="image"
              id="productImage" value="{{old('image')}}"
              class="border border-gray-300 px-3 py-2 text-gray-800 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
          </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
          <button
            type="submit"
            class="px-6 py-2 bg-blue-500 text-white text-sm font-medium rounded shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 flex items-center">
            <i data-feather="save" class="w-4 h-4 mr-2"></i>
            <!-- Feather Icon for save -->
            Save Product
          </button>
        </div>
      </form>
    </div>

    <script>
      feather.replace();
    </script>
  </body>
</html>
