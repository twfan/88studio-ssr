<x-member-layout :user="$user">
    <div class="mx-auto mt-10 flex flex-row w-3/4  ">
        <div class="flex flex-col w-full h-full justify-center content-center p-7">
            <h4 class="text-4xl font-bold text-white mb-7">Transaction Detail</h4>
            
            <div class="grid grid-cols-4 gap-3 w-full h-full">
                <div class="flex flex-col col-span-1 gap-3">
                    <div class="bg-white flex flex-col gap-2 rounded p-7">
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
                                <span class="rounded text-white px-3 py-1 bg-gray-400">New</span>
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
                            <div class="label">
                                <span class="rounded text-white px-3 py-1 bg-green-400">WIP</span>
                            </div>
                            @endif
                        </div>
                        @if ($transaction->status != 'new')
                        <div class="flex flex-col col-span-2"> 
                            <label class="text-gray-300 text-sm">Payment</label>
                            @if ($transaction->payment == 'paid')
                            <div class="label">
                                <span class="rounded text-white px-3 py-1 bg-green-400">Paid</span>
                            </div>
                            @else
                            <div class="label">
                                <span class="rounded text-white px-3 py-1 bg-red-400">Unpaid</span>
                            </div>
                            @endif
                        </div>
                        @endif
                        {{-- <div class="flex flex-col"> 
                            <label class="text-gray-300 text-sm">Invoice</label>
                                <a href="{{route('member.transaction.invoice', $transaction->id)}}">
                                    <span class="underline cursor-pointer">Download</span>
                                </a>
                        </div> --}}
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
                    @if($transaction->status == 'client_to_do')
                    <div class="bg-white rounded p-7 flex flex-col">
                        <h3 class="text-xl font-bold mb-5">Payment</h3>
                        <div id="paypal-button-container" style="max-width:500px;" class="w-full"></div>
                    </div>
                    @endif
                </div>
                <div class="col-span-3">
                    <div class="bg-white rounded p-7">
                        <div class="flex flex-col mt-3 px-5 py-3">
                            <div class="">
                                <h1 class="text-2xl mb-2">Your Commission Request</h1>
                            </div>
                            <div class="flex flex-col">
                                <ol class="flex flex-col gap-10 p-3 list-decimal">
                                    <li>
                                      <div class="flex flex-col gap-1 ">
                                        <p>Please provide any social media or any platform that you use (especially where we can contact you)</p>
                                        <div class="bg-gray-100 rounded-2xl p-3">
                                            <div class="bg-gray-100 rounded-2xl">
                                              <span>{{$transaction->proposal->social_media}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    </li>
                                    <li>
                                      <div class="flex-col gap-1">
                                        <p>How will you be using this work</p>
                                        <div class="flex flex-col gap-1">
                                            <div class="flex items-center gap-1">
                                              <input disabled type="radio" id="personal" name="useFor" value="personal" @if($transaction->proposal->use_for == 'personal') checked  @endif>
                                              <label for="personal">Personal</label>
                                            </div>
                                            <div class="flex items-center gap-1">
                                              <input disabled type="radio" id="streaming" name="useFor" value="streaming" @if($transaction->proposal->use_for == 'streaming') checked  @endif>
                                              <label for="streaming">Commercial/streaming</label>
                                            </div>
                                            <div class="flex items-center gap-1">
                                              <input disabled type="radio" id="merchandise" name="useFor" value="merchandise" @if($transaction->proposal->use_for == 'merchandise') checked  @endif>
                                              <label for="merchandise">Commercial/merchandise</label>
                                            </div>
                                            <div class="flex items-center gap-1">
                                              <input disabled type="radio" id="other" name="useFor" value="other" @if($transaction->proposal->use_for == 'other') checked  @endif>
                                              <input disabled type="text" name="useForOther" class="border-slate-200 px-3 py-2 w-full" placeholder="Other" @if ($transaction->proposal->use_for == 'other') value="{{$transaction->proposal->use_for_other}}" @endif>
                                            </div>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="flex flex-col gap-1">
                                        <p>Please provide reference for your character and the emotes you need (preferably front view with proper lighting if there's any)</p>
                                        <div class="bg-gray-100 rounded-2xl p-3">
                                            <div class="" style="width: 150px; height:100px;" id="reference">
                                                <img class="w-full h-full object-scale-down" id="referenceImage" src="{{$transaction->proposal->reference}}" alt="img">
                                            </div>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="flex flex-col">
                                        <p>Please specify your hard deadline if there's any</p>
                                        <div class="bg-gray-100 rounded-2xl p-3">
                                            <div class="bg-gray-100 rounded-2xl">
                                              <span>{{$transaction->proposal->date}}</span>
                                            </div>
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="flex flex-col gap-1">
                                        <p>If you have ordered from us before and you want to use the same character for your request please send a screenshot of that previous work</p>
                                        <div class="bg-gray-100 rounded-2xl p-3">
                                            @if(!empty($transaction->proposal->previous_work))
                                            <div class="" style="width: 150px; height:100px;" id="previousWork">
                                                <img class="w-full h-full object-scale-down" id="previousWorkImage" src="{{$transaction->proposal->previous_work}}" alt="img">
                                            </div>
                                            @else
                                            <p class="text-center">No image</p>
                                            @endif
                                        </div>
                                      </div>
                                    </li>
                                    <li>
                                      <div class="flex flex-col gap-1">
                                        <label for="cars">Feel free to choose a promotional voucher in case you possess one.</label>
                                        <select class="rounded-2xl" name="cars" id="cars">
                                          <option value="volvo">Volvo</option>
                                          <option value="saab">Saab</option>
                                          <option value="mercedes">Mercedes</option>
                                          <option value="audi">Audi</option>
                                        </select>
                                      </div>
                                    </li>
                                  </ol>
                            </div>
                        </div>
                    </div>
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
                @elseif ($transaction->status == App\Models\Transaction::CLIENT_TO_DO)
                
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
        },
        createOrder() {
            return fetch("{{ route('paypal-create') }}", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body:JSON.stringify({
                    'transaction_id': "{{$transaction->id}}",
                    'user_id' : "{{auth()->user()->id}}",
                    'amount' : "{{$transaction->proposal_project_subtotal}}",
                })
            }).then(function(res) {
                //res.json();
                return res.json();
            }).then(function(orderData) {
                console.log("cek bentar",orderData);
                return orderData.id;
            });
        },
        // Call your server to finalize the transaction
        onApprove(orderData) {
            // console.log("order", orderData)
            return fetch("{{ route('paypal-capture') }}" , {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body :JSON.stringify({
                    'transaction_id' : "{{ $transaction->id }}",
                    'order_id' : orderData.orderID,
                    'payer_id' : orderData.payerID,
                    'payment_id' : orderData.paymentID
                })
            }).then(function(res) {
                // console.log(res.json());
                return res.json();
            }).then(function(orderData) {
                window.location.href = "{{ route('member.transaction.show', $transaction->id) }}";
            });
        }
        }).render('#paypal-button-container');
            
    });
</script>