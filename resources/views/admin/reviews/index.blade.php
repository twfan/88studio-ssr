<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reviews') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container w-3/4 p-5 mx-auto flex flex-col">
                    <div class="w-full flex flex-row-reverse mb-3">
                    </div>
                    <div class="w-full h-full bg-white p-3 rounded-lg shadow">
                        <table class="table-fixed w-full border-collapse rounded-md">
                            <thead>
                              <tr>
                                <th class="bg-slate-100 text-slate-500 text-left p-3">User</th>
                                <th class="bg-slate-100 text-slate-500 text-left p-3">Transactions</th>
                                <th class="bg-slate-100 text-slate-500 text-left p-3">Rating</th>
                                <th class="bg-slate-100 text-slate-500 text-left p-3">Comment</th>
                                <th class="rounded-e-md bg-slate-100 text-slate-500 text-left p-3">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $item)
                                    <tr>
                                        <td style="padding:10px;">{{$item->user_id}}</td> 
                                        <td style="padding:10px;">{{$item->transaction_id}}</td>
                                        <td style="padding:10px;">{{$item->rating}}</td>
                                        <td style="padding:10px;">{{$item->comment}}</td>
                                        <td class="px-3 py-5 border-b-8 border-white ">
                                            <div class="flex flex-row gap-2 h-full">
                                                <form name="deleteForm{{$item->id}}" action="{{ route('admin.reviews.destroy', $item->id) }}" method="POST" style="display: inline;">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
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
</script>
