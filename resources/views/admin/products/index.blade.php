<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container w-3/4 p-5 mx-auto flex flex-col">
                  <div class="w-full flex justify-between mb-3">
                    <div class="flex gap-3">
                      <div class="flex flex-col">
                        <label for="searchByIdProduct" class="text-xs">Search by product ID</label>
                        <input id="searchByIdProduct" type="text" class="text-xs rounded p-3" placeholder="Search by id product" onkeyup="filterProducts()">
                      </div>
                      <div class="flex flex-col">
                        <label for="sortByCategories" class="text-xs">Category</label>
                        <select class="rounded text-xs" name="sortByCategories" id="sortByCategories" onchange="filterProducts()">
                          <option value="" disabled selected>Sort by category</option>
                          <!-- Populate options dynamically based on available categories -->
                          @foreach ($categories as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <a href="{{ route('admin.products.create') }}">
                      <button type="button" class="px-3 py-2 text-sm bg-slate-400 rounded text-white flex flex-row items-center content-center gap-1"><i class="w-4 h-4" data-feather="plus"></i> Create a new product</button>
                    </a>
                  </div>
                    <div class="w-full h-full bg-white p-3 rounded-lg shadow">
                        <table class="table-fixed w-full border-collapse rounded-md">
                            <thead>
                              <tr>
                                <th class="rounded-s-md bg-slate-100 text-slate-500 text-left p-3">Image</th>
                                <th class="bg-slate-100 text-slate-500 text-left p-3">Category</th>
                                <th class="bg-slate-100 text-slate-500 text-left p-3">Product ID</th>
                                <th class="bg-slate-100 text-slate-500 text-left p-3">Price</th>
                                <th class="rounded-e-md bg-slate-100 text-slate-500 text-left p-3">Action</th>
                              </tr>
                            </thead>
                            <tbody id="productList">
                              @foreach ($products as $item)
                              <tr class="productRow">
                                <td class="px-3 py-5 border-b-8 border-white">
                                    <div class="w-20 h-20">
                                      <img src="{{$item->image}}"  onerror="reloadImage(this)" />
                                    </div>
                                  </td>
                                @if(!empty($item->category))
                                  <td class="px-3 py-5 border-b-8 border-white productCategory">{{$item->category->name}}</td>
                                @endif
                                @if(!empty($item->id_product))
                                  <td class="productId px-3 py-5 border-b-8 border-white">{{$item->id_product}}</td>
                                @endif
                                <td class="px-3 py-5 border-b-8 border-white">{{$item->price}}</td>
                                <td class="px-3 py-5 border-b-8 border-white ">
                                    <div class="flex flex-row gap-2 h-full">
                                        <a href="{{ route('admin.products.edit', $item->id) }}"  class="btn btn-danger px-3 py-2 border rounded flex content-center items-center justify-center gap-1 bg-yellow-400 text-white" >
                                          <i class="w-4 h-4" data-feather="edit-2"></i> Edit
                                        </a>
                                        <form name="deleteForm{{$item->id}}" action="{{ route('admin.products.destroy', $item->id) }}" method="POST" style="display: inline;">
                                          @csrf
                                          @method('DELETE')
                                      
                                          <button type="button" onclick="confirmDelete({{$item->id}})" class="btn btn-danger px-3 py-2 border rounded flex bg-red-400 text-white content-center items-center justify-center gap-1" onclick="return confirm('Are you sure you want to delete this category?')">
                                              <i class="w-4 h-4" data-feather="trash"></i>
                                              <span>Delete</span>
                                          </button>
                                        </form>
                                    </div>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                          <div id="paginationLinks">
                            {{ $products->links() }}
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script>

function reloadImage(img) {
  img.src = img.src
}

function confirmDelete(id) {
  event.preventDefault(); 
    Swal.fire({
      title: 'Are you sure?',
      text: 'You won\'t be able to revert this!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        if (result.isConfirmed) {
          // If confirmed, submit the form using the form's name
          document.forms['deleteForm'+id].submit();
        }
      }
    });
}

function filterProducts(page = 1) {
    var selectedCategory = $('#sortByCategories').val();

    $.ajax({
        url: '{{ route("admin.products.collectionByCategory") }}',
        type: 'GET',
        data: { category: selectedCategory, page: page },
        success: function(response) {
            var productList = $('#productList');
            productList.empty(); // Clear the current product list

            response.products.forEach(function(item) {
                var productRow = '<tr class="productRow">' +
                                    '<td class="px-3 py-5 border-b-8 border-white">' +
                                        '<div class="w-20 h-20">' +
                                            '<img src="' + item.image + '" onerror="reloadImage(this)" />' +
                                        '</div>' +
                                    '</td>' +
                                    (item.category ? '<td class="px-3 py-5 border-b-8 border-white productCategory">' + item.category.name + '</td>' : '') +
                                    (item.id_product ? '<td class="productId px-3 py-5 border-b-8 border-white">' + item.id_product + '</td>' : '') +
                                    '<td class="px-3 py-5 border-b-8 border-white">' + item.price + '</td>' +
                                    '<td class="px-3 py-5 border-b-8 border-white">' +
                                        '<div class="flex flex-row gap-2 h-full">' +
                                            '<a href="/admin/products/' + item.id + '/edit/" class="btn btn-danger px-3 py-2 border rounded flex content-center items-center justify-center gap-1 bg-yellow-400 text-white">' +
                                                `<i class="w-4 h-4" data-feather="edit-2"></i> Edit` +
                                            '</a>' +
                                            '<form name="deleteForm' + item.id + '" action="/admin/products/' + item.id + '" method="POST" style="display: inline;">' +
                                                '@csrf' +
                                                '@method("DELETE")' +
                                                '<button type="button" onclick="confirmDelete(' + item.id + ')" class="btn btn-danger px-3 py-2 border rounded flex bg-red-400 text-white content-center items-center justify-center gap-1">' +
                                                    '<i class="w-4 h-4" data-feather="trash"></i>' +
                                                    '<span>Delete</span>' +
                                                '</button>' +
                                            '</form>' +
                                        '</div>' +
                                    '</td>' +
                                '</tr>';
                productList.append(productRow);
            });

            // Update pagination links
            $('#paginationLinks').html(response.pagination);
        },
        error: function(xhr) {
            console.error('An error occurred:', xhr.statusText);
        }
    });
}

// Handle pagination click
$(document).on('click', '#paginationLinks a', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var page = url.split('page=')[1];
    filterProducts(page);
});

</script>
