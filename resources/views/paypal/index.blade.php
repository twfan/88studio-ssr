<x-member-layout :user="$user">
    <div class="mx-auto mt-10 flex flex-row w-3/4  ">
        <div class="flex flex-col w-full h-full justify-center content-center p-7">
            <h4 class="text-4xl font-bold text-white mb-7">Transaction Detail</h4>
            
            <div class="flex flex-col gap-3 w-full h-full justify-center content-center">
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
                        @elseif ($transaction->status == 'paid')
                            <span class="rounded text-gray-400">Payment Confirmed</span>
                        @elseif ($transaction->status == 'finished')
                            <span class="rounded text-green-400">Finish</span>
                        @elseif ($transaction->status == 'revision')
                            <span class="rounded text-yellow-400">Revision</span>
                        @elseif ($transaction->status == 'review')
                            <span class="rounded text-green-400">Review</span>
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
                                <span class="px-4 py-2 rounded border-2 text-green-500 rounded">Payment Confirmation</span>
                            @elseif ($transaction->status == 'payment_confirmation')
                                <span v-else class="px-4 py-2 rounded border-2 text-gray-400 rounded">Waiting Confirmation</span>
                            @elseif ($transaction->status == 'paid')
                                <span v-else class="px-4 py-2 rounded border-2 text-gray-400 rounded">Payment Confirmed</span>
                            @endif
                        </div>
                    </div>
                    @if ($transaction->status == 'finished')
                    <div class="flex flex-col col-span-9 mt-5">
                        <div class="flex flex-col">
                            <label class="text-gray-400 text-sm mb-2">Here is your product</label>
                            <form action="{{route('member.transaction.download-product', $transaction->id)}}">
                                <button type="submit">
                                    <div class="border bg-white rounded flex flex-col p-5 text-center items-center justify-center content-center">
                                        <i class="" data-feather="download"></i>
                                        <span class="text-xs mt-2">Download File</span>
                                    </div>
                                </button>
                            </form>
                        </div>
                        <div class="flex flex-col mt-5">
                            <label class="text-gray-400 text-sm mb-2">Are you satisfied with your products?</label>
                            <div class="flex">
                                <form action="{{route('member.transaction.approval-revision', $transaction->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="finished">
                                    <button type="submit" class="btn btn-success px-3 py-2 border rounded flex content-center items-center justify-center gap-1 bg-blue-500 text-white text-sm w-full">
                                        <i class="w-4 h-4" data-feather="check"></i> Yes, i am satisfied.
                                    </button>
                                </form>
                                <form action="{{route('member.transaction.approval-revision', $transaction->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="action" value="revision">
                                    <button type="submit" class="btn btn-success px-3 py-2 border rounded flex content-center items-center justify-center gap-1 bg-red-500 text-white text-sm w-full">
                                        <i class="w-4 h-4" data-feather="x"></i> No, i want revisions.  
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @elseif($transaction->status == 'review')
                    <div class="flex flex-col col-span-9 mt-5">
                        <div class="flex flex-col mt-5">
                            <label class="text-gray-400 text-sm mb-2">Please give us a review and comment?</label>
                            <form action="{{route('member.transaction.review', $transaction->id)}}" method="post">
                                @csrf
                                <div class="flex flex-col gap-3">
                                    <div id="rateYo"></div>
                                    <input type="hidden" name="rating" id="rating" value="0">
                                    <textarea class="rounded text-sm" name="comment" cols="30" rows="10" placeholder="comment"></textarea>
                                    <button class="px-3 py-2 rounded text-sm bg-blue-400 text-white" type="submit">Submit a review!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
                @if ($transaction->status == 'paid' || $transaction->status == 'work_in_progress')
                    tes
                @elseif ($transaction->status == 'payment_confirmation')
                <hr class="my-7"/>
                <div class="flex flex-col gap-3">
                    <div class="flex flex-col">
                        <span>1. Upload your master character.</span>
                        <input type="file" name="master" id="">
                    </div>
                    <div class="flex flex-col">
                        <span>2. Wait for 2-3 days after status became work in progress.</span>
                    </div>
                    <div class="flex flex-col">
                        <span>3. If status become finished, you can download your character.</span>
                    </div>
                </div>

                @elseif ($transaction->status == 'finished')
                    <hr class="my-7">
                @elseif ($transaction->status == 'ready')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1 class="text-3xl md:text-5xl font-extrabold text-center uppercase mb-12 bg-gradient-to-r from-indigo-400 via-purple-500 to-indigo-600 bg-clip-text text-transparent transform -rotate-2">Make A Payment</h1>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <center>
                            <a href="{{ route('make.payment') }}" class="w-full bg-indigo-500 uppercase rounded-xl font-extrabold text-white px-6 h-8">Pay with PayPal👉</a>
                        </center>
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    </div>
</x-member-layout>


<script>
    $(function () {
        $("#rateYo").rateYo({
            starWidth: "40px",
            halfStar: true,
        }).on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $("#rating").val(rating);
        });


        paypal.Buttons({
        style: {
            layout: 'horizontal',
            color:  'blue',
            shape:  'rect',
            label:  'pay',
            tagline: true,
            disableMaxWidth: true
        }
        }).render('#paypal-button-container');
            
    });
</script>