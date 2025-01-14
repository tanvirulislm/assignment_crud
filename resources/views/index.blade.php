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
      <h1 class="text-2xl font-bold text-gray-800 mb-6">Laravel CRUD Project</h1>

      <!-- Success Message -->
      @if(session('success'))
      <div class="mb-6">
        <div class="p-4 mb-4 text-green-900 bg-green-100 border border-green-300 rounded">
        {{ session('success') }}
        </div>
      </div>
      @endif

      <!-- Search Box -->
      <div class="mb-6">
        <input
          type="text"
          placeholder="Search..."
          class="w-full p-3 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div>

      <!-- Create Product Button -->
      <div class="flex justify-end mb-4">
        <a
          href="{{ route('products.create') }}"
          class="flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
          <i data-feather="plus" class="w-5 h-5 mr-2"></i>
          Create Product
        </a>
      </div>

      <!-- Table -->
      <div class="bg-white overflow-hidden">
        <table class="min-w-full table-fixed border-collapse border border-gray-200">
          <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
              <th class="text-left px-3 py-3 text-lg font-medium text-gray-600 w-16">No</th>
              <th class="text-left px-6 py-3 text-lg font-medium text-blue-600 w-1/4">
                <a href="#" class="flex items-center">
                    Name
                    <i data-feather="arrow-up" style="width: 15px; height: 15px;"></i>
                </a>
              </th>
              <th class="text-left px-6 py-3 text-lg font-medium text-gray-600 w-1/2">Description</th>
              <th class="text-left px-6 py-3 text-lg font-medium text-blue-600 w-24"><a href="#" class="flex items-center">
                    Price
                    <i data-feather="arrow-up" style="width: 15px; height: 15px;"></i>
                </a></th>
              <th class="text-left px-6 py-3 text-lg font-medium text-gray-600 w-24">Stock</th>
              <th class="text-left px-6 py-3 text-lg font-medium text-gray-600 w-24">Image</th>
              <th class="text-left px-6 py-3 text-lg font-medium text-gray-600 w-1/6">Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Table body content goes here -->
            @foreach ($products as $product)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
              <td class="px-3 py-4 text-base text-gray-700"> {{$loop->iteration}}</td>
              <td class="px-6 py-4 text-base text-gray-700">{{$product->name}}</td>
              <td class="px-6 py-4 text-base text-gray-700">{{$product->description}}</td>
              <td class="px-6 py-4 text-base text-gray-700">{{$product->price}}</td>
              <td class="px-6 py-4 text-base text-gray-700">{{$product->stock}}</td>
              <td class="px-6 py-4 text-base text-gray-700">
                <img src="{{ asset('images/' . $product->image) }}" alt="" class="w-12 h-12 rounded-full object-cover" />
              </td>
              <td class="px-6 py-4 text-sm text-gray-700 flex items-center space-x-2">
                <a href="" class="flex items-center px-2 py-1 text-white bg-blue-600 rounded text-sm hover:bg-blue-700">
                  <i data-feather="eye" class="w-4 h-4 mr-1"></i>
                  Show
                </a>
                <a
                  href=""
                  class="flex items-center px-2 py-1 text-white bg-green-600 rounded text-sm hover:bg-green-700">
                  <i data-feather="edit" class="w-4 h-4 mr-1"></i>
                  Edit
                </a>
                <a href="" class="flex items-center px-2 py-1 text-white bg-red-600 rounded text-sm hover:bg-red-700">
                  <i data-feather="trash" class="w-4 h-4 mr-1"></i>
                  Delete
                </a>
              </td>
            </tr>
            @endforeach
            <!-- Add more rows as needed -->
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="flex justify-between items-center mt-4">
        <p class="text-base text-gray-600">
          Showing <span class="font-semibold">1</span> to <span class="font-semibold">5</span> of
          <span class="font-semibold">10</span> Results
        </p>
        <div class="flex space-x-1">
          <a
            href="#"
            class="flex items-center justify-center px-3 py-1 bg-gray-200 text-gray-600 rounded text-sm hover:bg-gray-300">
            <i data-feather="chevron-left" class="w-4 h-4"></i>
          </a>
          <a
            href="#"
            class="flex items-center justify-center px-3 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600">
            1
          </a>
          <a
            href="#"
            class="flex items-center justify-center px-3 py-1 bg-gray-200 text-gray-600 rounded text-sm hover:bg-gray-300">
            2
          </a>
          <a
            href="#"
            class="flex items-center justify-center px-3 py-1 bg-gray-200 text-gray-600 rounded text-sm hover:bg-gray-300">
            <i data-feather="chevron-right" class="w-4 h-4"></i>
          </a>
        </div>
      </div>
    </div>
    <script>
      feather.replace();
    </script>
  </body>
</html>
