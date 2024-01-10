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
                    <span class="font-bold mb-3">Transaction Info</span>
                    <div class="grid grid-cols-7 gap-3">
                        <div class="flex flex-col">
                            <label for="" class="text-slate-400 text-sm">Transaction Id</label>
                            <span>#{{$transaction->id}}</span>
                        </div>
                        <div class="flex flex-col">
                            <label for="" class="text-slate-400 text-sm">Sub Total</label>
                            <span>${{$transaction->sub_total}}</span>
                        </div>
                        <div class="flex flex-col">
                            <label for="" class="text-slate-400 text-sm">Discount</label>
                            <span>${{$transaction->discount}}</span>
                        </div>
                        <div class="flex flex-col">
                            <label for="" class="text-slate-400 text-sm">Grand Total</label>
                            <span>${{$transaction->grand_total}}</span>
                        </div>
                        <div class="flex flex-col col-span-3">
                            <label for="" class="text-slate-400 text-sm">Status</label>
                            @if ($transaction->status == 'payment_confirmation')
                                <span class="rounded text-gray-400 font-bold text-sm">Waiting Payment Confirmation</span>
                            @elseif ($transaction->status == 'payment_pending')
                                <span class="rounded text-gray-400 font-bold text-sm">Payment Pending</span>
                            @elseif ($transaction->status == 'paid')
                                <span class="rounded text-gray-400 font-bold text-sm">Payment Approve</span>
                            @elseif ($transaction->status == 'work_in_progress')
                                <span class="rounded text-gray-400 font-bold text-sm">Work In Progress</span>
                            @elseif ($transaction->status == 'payment_declined')
                                <span class="rounded text-gray-400 font-bold text-sm">Payment Declined</span>
                            @elseif ($transaction->status == 'finished')
                                <span class="rounded text-gray-400 font-bold text-sm">Finish</span>
                            @elseif ($transaction->status == 'revision')
                                <span class="rounded text-gray-400 font-bold text-sm">Revision</span>
                            @endif
                        </div>
                        <div class="flex flex-col col-span-7 mt-3">
                            <label for="" class="text-slate-400 text-sm">Ordered Items</label>
                            <div class="grid grid-cols-7 gap-3">
                                @foreach ($transaction->transactionDetails as $item)    
                                    <div class="flex flex-col">
                                        <div class="w-24 h-24 mb-1">
                                            <img src="{{asset($item->product->image)}}" alt="" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if ($transaction->status == 'finished')
                        <hr class="my-7">
                        <div class="flex flex-col">
                            <span class="font-bold mb-3">Finished Product</span>
                            <form action="{{route('admin.transactions.download-product', $transaction->id)}}">
                                <button type="submit">
                                    <div class="border rounded flex flex-col p-5 text-center items-center justify-center content-center">
                                        <i class="" data-feather="download"></i>
                                        <span class="text-xs mt-2">Download File</span>
                                    </div>
                                </button>
                            </form>
                        </div>
                    @endif
                    @if ($transaction->status == 'work_in_progress' || $transaction->status == 'revision')
                        <hr class="my-7">
                        <form action="{{route('admin.transactions.upload-product', $transaction->id)}}" method="POST" class="flex flex-col" enctype="multipart/form-data">
                        @csrf
                            <span class="font-bold mb-3">Upload Finished Product</span> 
                            <input type="file" name="finished_product" id="">
                            <div>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3">Upload</button>
                            </div>
                        </form>
                    @endif
                    <hr class="my-7"/>
                    <span class="font-bold mb-3">Payment Info</span>
                    <div class="grid grid-cols-4 gap-3">
                        <div class="flex flex-col">
                            <label for="" class="text-slate-400 text-sm">Payment Email</label>
                            <span>{{$transaction->sender_paypal_email}}</span>
                        </div>
                        <div class="flex flex-col col-span-2">
                            <label for="" class="text-slate-400 text-sm">Attachment</label>
                            <div class="w-72 h-72 mb-1">
                                <img src="{{asset($transaction->payment_url)}}" alt="" />
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <label for="" class="text-slate-400 text-sm">Action</label>
                            <div class="flex flex-col gap-3">
                                @if ($transaction->status == 'payment_confirmation')
                                    <form action="{{route('admin.transactions.approval-payment', $transaction->id)}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="approve">
                                        <button type="submit" class="btn btn-success px-3 py-2 border rounded flex content-center items-center justify-center gap-1 bg-blue-500 text-white text-sm w-full">
                                            <i class="w-4 h-4" data-feather="check"></i> Approve payment
                                        </button>
                                    </form>
                                    <form action="{{route('admin.transactions.approval-payment', $transaction->id)}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="action" value="decline">
                                        <button type="submit" class="btn btn-success px-3 py-2 border rounded flex content-center items-center justify-center gap-1 bg-red-500 text-white text-sm w-full">
                                            <i class="w-4 h-4" data-feather="x"></i> Decline payment
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr class="my-7"/>
                    <span class="font-bold mb-3">Room of discussion</span>
                    <div class="w-full h-96 border rounded">
                        {{-- chat --}}
                    </div>
                    <div class="flex flex-row items-center justify-center content-center mt-3 gap-3">
                        <input type="text" class="w-full h-10 border-slate-200 rounded" placeholder="Type your text here"/>
                        <button class="border rounded h-10 text-slate-500"><i class="w-full h-full" data-feather="send"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    function confirmDelete(id) {
      console.log(id)
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
