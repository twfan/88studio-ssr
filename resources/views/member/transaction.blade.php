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
                        @elseif ($transaction->status == 'payment_declined')
                        <span class="rounded text-red-400">Payment Declined</span>
                        @elseif ($transaction->status == 'paid' || $transaction->status == 'work_in_progress')
                        <span class="rounded text-blue-400">Work in progress</span>
                        @elseif ($transaction->status == 'finished')
                        <span class="rounded text-green-400">Finished</span>
                        @elseif ($transaction->status == 'complete')
                        <span class="rounded text-green-400">Complete Project</span>
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
                                <a href="{{route('member.transaction.show', $transaction->id)}}">
                                    <span v-else class="px-4 py-2 rounded border-2 text-gray-400 rounded">Waiting Confirmation</span>
                                </a>
                            @elseif ($transaction->status == 'payment_declined')
                                <a href="{{route('member.transaction.show', $transaction->id)}}">
                                    <span v-else class="px-4 py-2 rounded border-2 text-red-400 rounded">Payment Declined</span>
                                </a>
                            @elseif ($transaction->status == 'paid' || $transaction->status == 'work_in_progress')
                                <a href="{{route('member.transaction.show', $transaction->id)}}">
                                    <span v-else class="px-4 py-2 rounded border-2 text-blue-400 rounded">Work in progress</span>
                                </a>
                            @elseif ($transaction->status == 'finished')
                                <a href="{{route('member.transaction.show', $transaction->id)}}">
                                    <span v-else class="px-4 py-2 rounded border-2 text-green-400 rounded">Finished</span>
                                </a>
                            @elseif ($transaction->status == 'complete')
                                <a href="{{route('member.transaction.show', $transaction->id)}}">
                                    <span v-else class="px-4 py-2 rounded border-2 text-green-400 rounded">Complete Project</span>
                                </a>
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