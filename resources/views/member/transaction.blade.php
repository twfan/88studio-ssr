<x-member-layout :user="$user">
    <div class="mx-auto mt-10 flex flex-row w-3/4  ">
        <div class="flex flex-col w-full h-full justify-center content-center p-7">
            <h4 class="text-4xl font-bold text-white mb-7">Transactions</h4>
            
            <div class="flex flex-col gap-3 w-full h-full justify-center content-center">
                @forelse ($transactions as $transaction)
                @if($transaction->transaction_type != 'direct')
                    <a href="{{route('member.transaction.show', $transaction->id)}}">
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
                                @if ($transaction->status == 'new')
                                <div class="label">
                                    <span class="rounded text-white px-3 py-1 bg-gray-400">Wait for response</span>
                                </div>
                                @elseif ($transaction->status == 'client_to_do')
                                <div class="label">
                                    <span class="rounded text-white px-3 py-1 bg-blue-400">Client To Do</span>
                                </div>
                                @elseif ($transaction->status == 'ready')
                                <div class="label">
                                    <span class="rounded text-white px-3 py-1 bg-green-400">Ready</span>
                                </div>
                                @elseif ($transaction->status == 'wip')
                                <div class="label flex gap-3">
                                    <span class="rounded text-white px-3 py-1 bg-green-400">WIP</span>
                                    @if ($transaction->transactionMessages->last_chat_from == 'admin' && $transaction->transactionMessages->seen_customer == false)
                                        <span class="rounded text-white px-3 py-1 bg-red-400 text-sm">New message from Admin</span>
                                    @endif
                                </div>
                                @elseif ($transaction->status == 'completed')
                                <div class="label">
                                    <span class="rounded text-white px-3 py-1 bg-green-600">Completed</span>
                                </div>
                                @endif
                            </div>
                            {{-- <div class="flex flex-col"> 
                                <label class="text-gray-300 text-sm">Invoice</label>
                                    <a href="{{route('member.transaction.invoice', $transaction->id)}}">
                                        <span class="underline cursor-pointer">Download</span>
                                    </a>
                            </div> --}}
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
                    </a>
                @elseif($transaction->status != 'new')
                    <a href="{{route('member.transaction.show', $transaction->id)}}">
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
                                @if ($transaction->status == 'new')
                                <div class="label">
                                    <span class="rounded text-white px-3 py-1 bg-gray-400">Wait for response</span>
                                </div>
                                @elseif ($transaction->status == 'client_to_do')
                                <div class="label">
                                    <span class="rounded text-white px-3 py-1 bg-blue-400">Client To Do</span>
                                </div>
                                @elseif ($transaction->status == 'ready')
                                <div class="label">
                                    <span class="rounded text-white px-3 py-1 bg-green-400">Ready</span>
                                </div>
                                @elseif ($transaction->status == 'wip')
                                <div class="label flex gap-3">
                                    <span class="rounded text-white px-3 py-1 bg-green-400">WIP</span>
                                    @if ($transaction->transactionMessages->last_chat_from == 'admin' && $transaction->transactionMessages->seen_customer == false)
                                        <span class="rounded text-white px-3 py-1 bg-red-400 text-sm">New message from Admin</span>
                                    @endif
                                </div>
                                @elseif ($transaction->status == 'completed')
                                <div class="label">
                                    <span class="rounded text-white px-3 py-1 bg-green-600">Completed</span>
                                </div>
                                @endif
                            </div>
                            {{-- <div class="flex flex-col"> 
                                <label class="text-gray-300 text-sm">Invoice</label>
                                    <a href="{{route('member.transaction.invoice', $transaction->id)}}">
                                        <span class="underline cursor-pointer">Download</span>
                                    </a>
                            </div> --}}
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
                    </a>
                @endif
                @empty

                @endforelse
            </div>
        </div>
    </div>
</x-member-layout>