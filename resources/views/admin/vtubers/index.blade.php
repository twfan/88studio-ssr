<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
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
                                <th class="rounded-s-md bg-slate-100 text-slate-500 text-left p-3">ID</th>
                                <th class="bg-slate-100 text-slate-500 text-left p-3">Grand Total</th>
                                <th class="bg-slate-100 text-slate-500 text-left p-3">Status</th>
                                <th class="bg-slate-100 text-slate-500 text-left p-3">Transaction Date</th>
                                <th class="rounded-e-md bg-slate-100 text-slate-500 text-left p-3">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($transactions as $item)
                                <tr>
                                    <td class="px-3 py-5 border-b-8 border-white">{{$item->id}}</td>
                                    <td class="px-3 py-5 border-b-8 border-white">${{$item->grand_total}}</td>
                                    <td class="px-3 py-5 border-b-8 border-white">
                                        @if ($item->status == 'payment_pending')
                                        <span class="badge badge-danger px-3 py-2 bg-slate-400 text-xs rounded text-white">Waiting payment</span>
                                        @elseif ($item->status == 'payment_confirmation')
                                            <span class="badge badge-danger px-3 py-2 bg-slate-400 text-xs rounded text-white">Waiting confirmation</span>
                                        @elseif ($item->status == 'work_in_progress')
                                            <span class="badge badge-info px-3 py-2 bg-blue-400 text-xs rounded text-white">Work in progress</span>
                                        @elseif ($item->status == 'finished')
                                            <span class="badge badge-success px-3 py-2 bg-green-500 text-xs rounded text-white">Finish</span>
                                        @elseif ($item->status == 'complete')
                                            <span class="badge badge-success px-3 py-2 bg-green-500 text-xs rounded text-white">Project Complete</span>
                                            
                                        @else
                                            
                                        @endif
                                    </td>
                                    <td class="px-3 py-5 border-b-8 border-white">{{$item->created_at}}</td>
                                    <td class="px-3 py-5 border-b-8 border-white ">
                                        <div class="flex flex-col gap-2 h-full">
                                            <a href="{{ route('admin.vtubers.transactions.show', $item->id) }}"  class="btn btn-info px-3 py-2 border rounded flex content-center items-center justify-center gap-1 bg-blue-500 text-white" >
                                              <i class="w-4 h-4" data-feather="eye"></i> Detail
                                            </a>
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
