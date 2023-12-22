<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container w-3/4 p-5 mx-auto flex flex-col">
                    <div class="w-full flex flex-row-reverse mb-3">
                    <a href="{{ route('admin.categories.create') }}">
                      <button type="button" class="px-3 py-2 text-sm bg-slate-400 rounded text-white flex flex-row items-center content-center gap-1"><i class="w-4 h-4" data-feather="plus"></i> Create a new category</button>
                    </a>
                    </div>
                    <div class="w-full h-full bg-white p-3 rounded-lg shadow">
                        <table class="table-fixed w-full border-collapse rounded-md">
                            <thead>
                              <tr>
                                <th class="bg-slate-100 text-slate-500 text-left p-3">Name</th>
                                <th class="rounded-e-md bg-slate-100 text-slate-500 text-left p-3">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($categories as $item)
                              <tr>
                                <td class="px-3 py-5 border-b-8 border-white">{{$item->name}}</td>
                                <td class="px-3 py-5 border-b-8 border-white flex flex-row gap-2">
                                  <a href="{{ route('admin.categories.edit', $item->id) }}"  class="btn btn-danger px-3 py-2 border rounded flex bg-yellow-400 text-white" >
                                    <i class="w-4 h-4" data-feather="edit-2"></i> 
                                  </a>
                                  <form name="deleteForm" action="{{ route('admin.categories.destroy', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                
                                    <button type="button" onclick="confirmDelete()" class="btn btn-danger px-3 py-2 border rounded flex bg-red-400 text-white content-center items-center justify-center gap-1" onclick="return confirm('Are you sure you want to delete this category?')">
                                        <i class="w-4 h-4" data-feather="trash"></i>
                                        <span>Delete</span>
                                    </button>
                                  </form>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script>
      function confirmDelete() {
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
                document.forms['deleteForm'].submit();
              }
            }
         });
      }
</script>
