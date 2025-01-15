<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laravel CRUD Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&display=swap");
      body {
        font-family: "Figtree", sans-serif;
      }
    </style>
  </head>
  <body class="bg-gray-100 py-10">
    <div class="max-w-7xl mx-auto p-6 sm:px-8 lg:px-10 bg-white shadow-md rounded-md">
    <div class="flex justify-between items-center mb-6">
      <!-- Header -->
      <h1 class="text-2xl font-bold text-gray-800 mb-6">Laravel CRUD Project</h1>

      <!-- Create Product Button -->
      <div class="flex justify-end mb-4">
        <a
          href="{{ route('products.create') }}"
          class="flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
          <i data-feather="plus" class="w-5 h-5 mr-2"></i>
          Create Product
        </a>
      </div>
    </div>

<!-- Success Message -->
@if(session('success'))
      <div class="mb-6">
        <div class="p-4 mb-4 text-green-900 bg-green-100 border border-green-300 rounded">
        {{ session('success') }}
        </div>
      </div>
      @endif

      <div>
  <!-- Search Box -->
  <div class="mb-6">
    <input
      type="text"
      id="search"
      placeholder="Search..."
      class="w-full p-3 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
  </div>

  <!-- Table -->
  <div class="bg-white overflow-hidden">
    <table class="min-w-full table-fixed border-collapse border border-gray-200">
      <thead class="bg-gray-100 border-b border-gray-200">
        <tr>
          <th class="text-left px-3 py-3 text-lg font-medium text-gray-600 w-16">No</th>
          <th class="text-left px-6 py-3 text-lg font-medium text-blue-600 w-1/4">
          <a class="flex items-center" href="?sort_column=name&sort_direction={{ ($sortColumn == 'name' && $sortDirection == 'asc') ? 'desc' : 'asc' }}">
                  Name
                  @if($sortColumn == 'name')
                      @if($sortDirection == 'asc')
                          <i data-feather="arrow-up" style="width: 15px; height: 15px;"></i>
                      @else
                          <i data-feather="arrow-down" style="width: 15px; height: 15px;"></i>
                      @endif
                      @else
                      <i data-feather="arrow-up" style="width: 15px; height: 15px;"></i>
                  @endif
              </a>
          </th>
          <th class="text-left px-6 py-3 text-lg font-medium text-gray-600 w-1/2">Description</th>
          <th class="text-left px-6 py-3 text-lg font-medium text-blue-600 w-24">
            <a href="?sort_column=price&sort_direction={{ ($sortColumn == 'price' && $sortDirection == 'asc') ? 'desc' : 'asc' }}" class="flex items-center">
              Price
              @if($sortColumn == 'price')
                @if($sortDirection == 'asc')
                  <i data-feather="arrow-up" style="width: 15px; height: 15px;"></i>
                @else
                  <i data-feather="arrow-down" style="width: 15px; height: 15px;"></i>
                @endif
              @else
                <i data-feather="arrow-up" style="width: 15px; height: 15px;"></i>
              @endif
            </a>
          </th>
          <th class="text-left px-6 py-3 text-lg font-medium text-gray-600 w-24">Stock</th>
          <th class="text-left px-6 py-3 text-lg font-medium text-gray-600 w-24">Image</th>
          <th class="text-left px-6 py-3 text-lg font-medium text-gray-600 w-1/6">Action</th>
        </tr>
      </thead>
      <tbody id="search-results">
        @foreach ($products as $product)
        <tr class="border-b border-gray-200 hover:bg-gray-50">
          <td class="px-3 py-4 text-base text-gray-700"> {{$loop->iteration}}</td>
          <td class="px-6 py-4 text-base text-gray-700">{{$product->name}}</td>
          <td class="px-6 py-4 text-base text-gray-700">{{Str::limit($product->description, 90, '...')}}</td>
          <td class="px-6 py-4 text-base text-gray-700">{{$product->price}}</td>
          <td class="px-6 py-4 text-base text-gray-700">{{$product->stock}}</td>
          <td class="px-6 py-4 text-base text-gray-700">
            <img src="{{ asset('images/' . $product->image) }}" alt="" class="w-24 h-24 rounded-full border-blue-600 border-2 object-cover" />
          </td>
          <td class="px-6 py-4 text-sm text-gray-700">
            <div class="flex items-center space-x-2">
              <!-- Show Button -->
              <a href="{{ route('products.show', $product->id) }}" class="flex items-center px-2 py-1 text-white bg-blue-600 rounded text-sm hover:bg-blue-700">
                <i data-feather="eye" class="w-4 h-4 mr-1"></i>
                Show
              </a>
              <!-- Edit Button -->
              <a href="{{ route('products.edit', $product->id) }}" class="flex items-center px-2 py-1 text-white bg-green-600 rounded text-sm hover:bg-green-700">
                <i data-feather="edit" class="w-4 h-4 mr-1"></i>
                Edit
              </a>
              <!-- Delete Button (Form) -->
              <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center px-2 py-1 text-white bg-red-600 rounded text-sm hover:bg-red-700">
                  <i data-feather="trash" class="w-4 h-4 mr-1"></i>
                  Delete
                </button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

    <!-- Search Box -->
    <!-- <div class="mb-6">
        <input
          type="text"
          placeholder="Search..."
          class="w-full p-3 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
      </div> -->

      <!-- Table -->
      <!-- <div class="bg-white overflow-hidden">
        <table class="min-w-full table-fixed border-collapse border border-gray-200">
          <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
              <th class="text-left px-3 py-3 text-lg font-medium text-gray-600 w-16">No</th>
              <th class="text-left px-6 py-3 text-lg font-medium text-blue-600 w-1/4">
              <a class="flex items-center" href="?sort_column=name&sort_direction={{ ($sortColumn == 'name' && $sortDirection == 'asc') ? 'desc' : 'asc' }}">
                  Name
                  @if($sortColumn == 'name')
                      @if($sortDirection == 'asc')
                          <i data-feather="arrow-up" style="width: 15px; height: 15px;"></i>
                      @else
                          <i data-feather="arrow-down" style="width: 15px; height: 15px;"></i>
                      @endif
                      @else
                      <i data-feather="arrow-up" style="width: 15px; height: 15px;"></i>
                  @endif
              </a>
              </th>
              <th class="text-left px-6 py-3 text-lg font-medium text-gray-600 w-1/2">Description</th>
              <th class="text-left px-6 py-3 text-lg font-medium text-blue-600 w-24"><a href="?sort_column=price&sort_direction={{ ($sortColumn == 'price' && $sortDirection == 'asc') ? 'desc' : 'asc' }}" class="flex items-center">
                    Price
                    @if($sortColumn == 'price')
                        @if($sortDirection == 'asc')
                            <i data-feather="arrow-up" style="width: 15px; height: 15px;"></i>
                        @else
                            <i data-feather="arrow-down" style="width: 15px; height: 15px;"></i>
                        @endif
                    @else
                        <i data-feather="arrow-up" style="width: 15px; height: 15px;"></i>
                    @endif
                </a>
              </th>
              <th class="text-left px-6 py-3 text-lg font-medium text-gray-600 w-24">Stock</th>
              <th class="text-left px-6 py-3 text-lg font-medium text-gray-600 w-24">Image</th>
              <th class="text-left px-6 py-3 text-lg font-medium text-gray-600 w-1/6">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
              <td class="px-3 py-4 text-base text-gray-700"> {{$loop->iteration}}</td>
              <td class="px-6 py-4 text-base text-gray-700">{{$product->name}}</td>
              <td class="px-6 py-4 text-base text-gray-700">{{Str::limit($product->description, 90, '...')}}</td>
              <td class="px-6 py-4 text-base text-gray-700">{{$product->price}}</td>
              <td class="px-6 py-4 text-base text-gray-700">{{$product->stock}}</td>
              <td class="px-6 py-4 text-base text-gray-700">
                <img src="{{ asset('images/' . $product->image) }}" alt="" class="w-12 h-12 rounded-full border-blue-600 border-2 object-cover" />
              </td>
              <td class="px-6 py-4 text-sm text-gray-700">
              <div class="flex items-center space-x-2">
                  <a href="{{ route('products.show', $product->id) }}" class="flex items-center px-2 py-1 text-white bg-blue-600 rounded text-sm hover:bg-blue-700">
                      <i data-feather="eye" class="w-4 h-4 mr-1"></i>
                      Show
                  </a>
                  <a href="{{ route('products.edit', $product->id) }}" class="flex items-center px-2 py-1 text-white bg-green-600 rounded text-sm hover:bg-green-700">
                      <i data-feather="edit" class="w-4 h-4 mr-1"></i>
                      Edit
                  </a>
                  <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="flex items-center px-2 py-1 text-white bg-red-600 rounded text-sm hover:bg-red-700">
                          <i data-feather="trash" class="w-4 h-4 mr-1"></i>
                          Delete
                      </button>
                  </form>
              </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div> -->
      <!-- Pagination -->
      <div class="flex justify-end items-center mt-4">
        <div>
        {{ $products->links('pagination::tailwind') }}
        </div>
      
      </div>


    </div>
    <script>
      feather.replace();
    </script>
    <script>
      $(document).ready(function () {
    $('#search').on('keyup', function () {
        let query = $(this).val();

        $.ajax({
            url: "{{ route('products.search') }}",
            type: "GET",
            data: { query: query },
            success: function (data) {
                $('#search-results').empty();  // Clear the previous results

                if (data.length > 0) {
                    $.each(data, function (index, product) {
                        $('#search-results').append(`
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-3 py-4 text-base text-gray-700">${index + 1}</td>
                                <td class="px-6 py-4 text-base text-gray-700">${product.name}</td>
                                <td class="px-6 py-4 text-base text-gray-700">${product.description.slice(0, 90)}...</td>
                                <td class="px-6 py-4 text-base text-gray-700">${product.price}</td>
                                <td class="px-6 py-4 text-base text-gray-700">${product.stock}</td>
                                <td class="px-6 py-4 text-base text-gray-700">
                                    <img src="/images/${product.image}" alt="" class="w-12 h-12 rounded-full border-blue-600 border-2 object-cover" />
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="flex items-center space-x-2">
                                        <a href="/products/${product.id}" class="flex items-center px-2 py-1 text-white bg-blue-600 rounded text-sm hover:bg-blue-700">
                                            <i data-feather="eye" class="w-4 h-4 mr-1"></i>
                                            Show
                                        </a>
                                        <a href="/products/${product.id}/edit" class="flex items-center px-2 py-1 text-white bg-green-600 rounded text-sm hover:bg-green-700">
                                            <i data-feather="edit" class="w-4 h-4 mr-1"></i>
                                            Edit
                                        </a>
                                        <form action="/products/${product.id}" method="POST" class="inline-block">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <button type="submit" class="flex items-center px-2 py-1 text-white bg-red-600 rounded text-sm hover:bg-red-700">
                                                <i data-feather="trash" class="w-4 h-4 mr-1"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#search-results').html(`
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-600">
                                No products found.
                            </td>
                        </tr>
                    `);
                }
            }
        });
    });
});

    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  </body>
</html>
