<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Transactions") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container w-3/4 p-5 mx-auto flex flex-col">
                    <span class="font-bold mb-3">Transaction Info</span>
                    <div class="grid grid-cols-6 gap-5">
                        
                        <div class="flex flex-col">
                            <label for="" class="text-slate-400 text-sm"
                                >Transaction Id</label
                            >
                            <span>#{{$transaction->id}}</span>
                        </div>
                        <div class="flex flex-col">
                            <label for="" class="text-slate-400 text-sm"
                                >Sub Total</label
                            >
                            <span>${{$transaction->sub_total}}</span>
                        </div>
                        <div class="flex flex-col">
                            <label for="" class="text-slate-400 text-sm"
                                >Discount</label
                            >
                            <span>${{$transaction->discount}}</span>
                        </div>
                        <div class="flex flex-col">
                            <label for="" class="text-slate-400 text-sm"
                                >Grand Total</label
                            >
                            <span>${{$transaction->grand_total}}</span>
                        </div>
                        <div class="flex flex-col col-span-3">
                            <label for="" class="text-slate-400 text-sm"
                                >Status</label
                            >
                            @if ($transaction->status == 'completed')
                            <span
                                class="rounded text-gray-400 font-bold text-sm"
                                >Completed</span
                            >
                            @endif
                        </div>
                        <div class="flex flex-col">
                            <label for="" class="text-slate-400 text-sm"
                                >Payment Email</label
                            >
                            <span>{{$transaction->user->email}}</span>
                        </div>
                        <div class="flex flex-col col-span-7 mt-3">
                            <label for="" class="text-slate-400 text-sm"
                                >Ordered Items</label
                            >
                            <div class="grid grid-cols-7 gap-3">
                                @foreach ($transaction->transactionDetails as $item)
                                <div class="flex flex-col">
                                    <div class="w-24 h-24 mb-1">
                                        <img
                                            src="{{asset($item->product->image)}}"
                                            alt=""
                                        />
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                    </div>
                    <div class="flex text-right w-full items-end justify-end">
                        <a href="{{route('admin.vtubers.index')}}" class="px-3 py-2 rounded border">Back</a>
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
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.isConfirmed) {
                    // If confirmed, submit the form using the form's name
                    document.forms["deleteForm" + id].submit();
                }
            }
        });
    }
</script>
