<x-member-layout :user="$user">
    <div class="mx-auto mt-10 flex flex-row w-3/4  ">
        <div class="flex flex-col w-full h-full justify-center content-center p-7">
            <h4 class="text-4xl font-bold text-white mb-7">Transactions</h4>
            
            <div class="flex flex-col gap-3 w-full h-full justify-center content-center">
                @forelse ($transactions as $transaction)
                <div class="grid grid-cols-9 bg-white rounded p-7">
                    <div class="flex flex-col">
                        <label class="text-gray-300 text-sm">Transaction ID</label>
                        <span>#{{$transaction->id}}</span>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-300 text-sm">Subtotal</label>
                        <span>${{$transaction->sub_total}}</span>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-300 text-sm">Discount</label>
                        <span>${{$transaction->discount}}</span>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-gray-300 text-sm">Grand Total</label>
                        <span>${{$transaction->grand_total}}</span>
                    </div>  
                    <div class="flex flex-col col-span-2"> 
                        <label class="text-gray-300 text-sm">Status</label>
                        @if ($transaction->status == 'payment_pending')
                        <span class="rounded text-red-400">Pending Payment</span>   
                        @elseif ($transaction->status == 'payment_confirmation')
                        <span class="rounded text-gray-400">Waiting Confirmation</span>
                        @endif
                    </div>
                    <div class="flex flex-col"> 
                        <label class="text-gray-300 text-sm">Invoice</label>
                        {{-- <a :href="route('member.invoice', transaction.id)"> --}}
                            <a href="{{route('member.transaction.invoice', $transaction->id)}}">
                                <span class="underline cursor-pointer">Download</span>
                            </a>
                        {{-- </a> --}}
                    </div>
                    <div class="flex flex-col col-span-2 mt-3 items-end">
                        <div class="mt-1">
                            @if ($transaction->status == 'payment_pending')
                                <a href="{{route('member.transaction.payment-confirmation', $transaction->id)}}">
                                    <span class="px-4 py-2 rounded border-2 text-green-500 rounded">Payment Confirmation</span>
                                </a>
                            @elseif ($transaction->status == 'payment_confirmation')
                                <span v-else class="px-4 py-2 rounded border-2 text-gray-400 rounded">Waiting Confirmation</span>
                            @endif
                        </div>
                    </div>
                </div>

                @empty

                @endforelse
            </div>
        </div>
    </div>
</x-member-layout>