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
        <h1 class="text-2xl font-bold text-gray-800">Product Information</h1>

        <!-- Back Button -->
        <a
          href="{{ route('products.index') }}"
          class="flex items-center px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          <i data-feather="arrow-left" class="w-5 h-5 mr-2"></i>
          Back
        </a>
      </div>
      <hr class="border-t-1 border-gray-300 mb-6" />
      <!-- Product Information -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- First Row: Product Name, Stock, Price -->
        <div class="flex flex-col">
          <label for="productName" class="text-lg font-semibold text-gray-700 mb-2">Product Name</label>
          <div class="text-gray-800">Akij Biri</div>
        </div>

        <div class="flex flex-col">
          <label for="stock" class="text-lg font-semibold text-gray-700 mb-2">Stock</label>
          <div class="text-gray-800">140</div>
        </div>

        <div class="flex flex-col">
          <label for="price" class="text-lg font-semibold text-gray-700 mb-2">Price</label>
          <div class="text-gray-800">841</div>
        </div>

        <!-- Second Row: Product Details and Image -->
        <div class="lg:col-span-3 flex flex-col">
          <label for="productDetails" class="text-lg font-semibold text-gray-700 mb-2">Product Details</label>
          <div class="text-gray-800 mb-4">Its Causes Cancer</div>

          <label for="productImage" class="text-lg font-semibold text-gray-700 mb-2">Product Image</label>
          <img
            src="https://placehold.co/500x400"
            alt="Product Image"
            class="w-60 h-auto rounded" />
        </div>
      </div>
    </div>

    <script>
      feather.replace();
    </script>
  </body>
</html>
