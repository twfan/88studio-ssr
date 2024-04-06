<x-member-layout :user="$user">
    <div class="mx-auto mt-10 flex flex-row w-3/4  ">
        <div class="flex flex-col w-full h-full justify-center content-center p-7">
            <h4 class="text-4xl font-bold text-white mb-7">Transaction Detail</h4>
            
            <div class="grid grid-cols-4 gap-3 w-full h-full">
                <div class="flex flex-col col-span-1 gap-3">
                    <div class="bg-white flex flex-col gap-2 rounded p-7">
                        <div class="flex flex-col">
                            <label class="text-gray-300 text-sm">Transaction ID</label>
                            <input id="transaction" type="hidden" value="{{$transaction}}">
                            <span>#{{$transaction->id}}</span>
                        </div>
                        <div class="flex flex-col">
                            <label class="text-gray-300 text-sm">Subtotal</label>
                            <span>${{$transaction->sub_total }}</span>
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
                                <div class="label">
                                    <span class="rounded text-white px-3 py-1 bg-green-400">WIP</span>
                                </div>
                            @elseif ($transaction->status == 'completed')
                            <div class="label">
                                <span class="rounded text-white px-3 py-1 bg-blue-400">Completed</span>
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
                        @endif
                    </div>
                    @if($transaction->status == 'client_to_do')
                    <div class="bg-white rounded p-7 flex flex-col">
                        <h3 class="text-xl font-bold mb-5">Payment</h3>
                        <div id="paypal-button-container" style="max-width:500px;" class="w-full"></div>
                    </div>
                    @endif
                    @if($transaction->status == 'completed')
                        @if (!empty($transaction->finished_product))
                            <div class="bg-white rounded p-7 flex flex-col gap-3">
                                <h1 class="text-2xl mb-2">Final Product</h1>
                                <div class="flex flex-row">
                                    <a href="{{route('member.transaction.download-product', $transaction->id)}}">
                                        <button class="px-3 py-2 flex gap-2 rounded bg-blue-500 text-white">
                                            <span>Download</span>
                                        <i class="w-4 h-4" data-feather="download"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        @endif
                        @if(!empty($transaction->notes_finale))
                        <div class="bg-white rounded p-7 flex flex-col gap-3">
                            <h1 class="text-2xl mb-2">Notes for product</h1>
                            <p>{{$transaction->notes_finale}}</p>
                        </div>
                        @endif
                    @endif
                </div>
                <div class="col-span-3 flex flex-col gap-5">
                    @if ($transaction->status == 'completed')
                    <div class="bg-white rounded p-7">
                        <h1 class="text-2xl mb-2">Review Transaction</h1>
                        <div id="reviewBox" class="flex flex-col gap-3">
                            <div class="flex flex-col">
                                <form action="{{route('member.transaction.review', $transaction->id)}}" method="post">
                                    @csrf
                                    <div class="flex flex-col gap-3">
                                        @if (!empty($transaction->reviewed))
                                            <input type="hidden" name="totalStar" id="totalRating" value="{{$transaction->reviewed->rating}}">
                                        @endif
                                        <div id="rateYo"></div>
                                        <input type="hidden" name="rating" id="rating" value="0">
                                        <textarea class="rounded text-sm" name="comment" cols="30" rows="10" placeholder="comment" {{!empty($transaction->reviewed) ? "disabled" : ''}}>{{  !empty($transaction->reviewed) ? $transaction->reviewed->comment : ""}}</textarea>
                                        <button class="px-3 py-2 rounded text-sm {{!empty($transaction->reviewed) ? 'bg-green-600' : 'bg-blue-400'}} text-white" type="submit" {{!empty($transaction->reviewed) ? "disabled" : ''}}>{{!empty($transaction->reviewed) ? "Thank you for the review" : 'Submit a review!'}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($transaction->status == 'wip')
                        <div id="chatContents" class="bg-white rounded p-7 flex flex-col gap-3">
                            <h1 class="text-2xl mb-2">Chat</h1>
                            <div id="messagesBox" class="border border-slate-300 rounded p-5 h-[30rem] max-h-[30rem] w-full flex flex-col gap-3 overflow-auto"></div>
                            <div id="filePreview2" class="flex items-center hidden">
                                <div class="flex rounded-2xl bg-gray-100 p-3 gap-2 relative">
                                    <button id="deleteFile2" class="absolute -top-1 -right-2"><i class="w-5 h-5 text-white" fill="black" data-feather="x-circle"></i></button>
                                    <i class="w-6 h-6 " data-feather="image"></i>
                                    <span id="fileName2">filename.svg</span>
                                </div>
                            </div>
                            <div class="flex gap-1">
                                <input id="userId" type="hidden" name="" value="{{Auth::user()->id}}">
                                <input id="inputChat" name="inputChat" class="w-full border border-slate-300 rounded" type="text" autocomplete="off">
                                <!--default html file upload button-->
                                <input type="file" id="actual-btn2"  accept="image/*" hidden/>
                                <!--our custom file upload button-->
                                <label for="actual-btn2" class="cursor-pointer p-3 border border-slate-300 hover:bg-slate-300 hover:text-white duration-300 hover:border-slate-300 transition-all ease-in-out rounded" for="attachment-img"> <i class="w-3 h-3 " data-feather="image"></i></label>
                                <button id="sendChat" type="button" class="p-3 border border-slate-300 hover:bg-slate-300 hover:text-white duration-300 hover:border-slate-300 transition-all ease-in-out rounded"><i class="w-3 h-3" data-feather="send"></i></button>
                            </div>
                        </div>
                    @endif
                    @if ($transaction->status != 'completed')
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
                                    {{-- <li>
                                      <div class="flex flex-col gap-1">
                                        <label for="cars">Feel free to choose a promotional voucher in case you possess one.</label>
                                        <select class="rounded-2xl" name="cars" id="cars">
                                          <option value="volvo">Volvo</option>
                                          <option value="saab">Saab</option>
                                          <option value="mercedes">Mercedes</option>
                                          <option value="audi">Audi</option>
                                        </select>
                                      </div>
                                    </li> --}}
                                  </ol>
                            </div>
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
                @elseif ($transaction->status == App\Models\Transaction::CLIENT_TO_DO)
                
                @endif
                
            </div>
        </div>
    </div>
</x-member-layout>


<script>

    function setHeightOverflow() {
        let div = $("#messagesBox");
        div.scrollTop(div.prop('scrollHeight'))
    }

    function getChannelPusher(param) {
        let pusherAppKey = '{{ env('PUSHER_APP_KEY') }}';
        let pusherAppCluster = '{{ env('PUSHER_CLUSTER') }}';

        var pusher = new Pusher(pusherAppKey, {
            cluster: pusherAppCluster,
            encrypted: true
        });

        var channel = pusher.subscribe('chatting-app');
        channel.bind(`${param.channel}`, function(data) {
            

            if (data.author?.id != $('#userId').val() ) {
                if (data.message != null) {
                    $('#messagesBox').append(`
                        <div class="customerChat flex gap-3">
                            <div class="customerChatImg w-12 h-12 rounded">
                                <img class="rounded w-full h-full" src="{{ asset('pp.png') }}" alt="">
                            </div>
                            <div class="customerMessage max-w-[75%] bg-blue-300 p-3 rounded flex flex-col">
                                <span class="text-sm mb-1 capitalize">${data.author?.name}</span>
                                <p>${data.message}</p>
                            </div>
                        </div>
                    `);
                }
                if (data.attachment != '') {
                    $('#messagesBox').append(`
                        <div class="customerChat flex gap-3">
                            <div class="customerChatImg w-12 h-12 rounded">
                                <img class="rounded w-full h-full" src="{{ asset('pp.png') }}" alt="">
                            </div>
                            <div class="customerMessage max-w-[75%] bg-blue-300 p-3 rounded flex flex-col">
                                <span class="text-sm mb-1 capitalize">${data.author?.name}</span>
                                <div class="h-48 w-60 pb-5 rounded">
                                    <img class="w-full h-full object-scale-down" src="${data.attachment}" />
                                </div>
                            </div>
                        </div>
                    `);
                }
            }

            let div = $("#messagesBox");
            div.scrollTop(div.prop('scrollHeight'))
        });
    }

    function setHeightOverflow() {
        let div = $("#messagesBox");
        div.scrollTop(div.prop('scrollHeight'))
    }

    function loadChannel(transaction) {
        fetch("{{ route('member.transactions.load-channel') }}" , {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body :JSON.stringify({
                "transaction" : transaction
            })
        }).then(response => {
            // Check if response is successful
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Parse the response JSON
            return response.json();
        })
        .then(data => {
            // Handle the data
            channelMessage = data;
            let param = channelMessage;

            let pusherAppKey = '{{ env('PUSHER_APP_KEY') }}';
            let pusherAppCluster = '{{ env('PUSHER_CLUSTER') }}';

            var pusher = new Pusher(pusherAppKey, {
                cluster: pusherAppCluster,
                encrypted: true
            });

            var channel = pusher.subscribe('chatting-app');
            channel.bind(`${param.channel}`, function(data) {
                if (data.author?.id != $('#userId').val() ) {
                    if (data.message != null) {
                        $('#messagesBox').append(`
                            <div class="adminChat flex gap-3">
                                <div class="adminChatImg w-12 h-12 rounded">
                                    <img class="rounded w-full h-full" src="{{ asset('icon-01.png') }}" alt="">
                                </div>
                                <div class="adminMessage max-w-[75%] bg-88-orange p-3 rounded flex flex-col">
                                    <span class="text-sm mb-1">Admin</span>
                                    <p>${data.message}</p>
                                </div>
                            </div>
                        `);
                    }
                    if (data.attachment != '') {
                        $('#messagesBox').append(`
                            <div class="adminChat flex gap-3">
                                <div class="adminChatImg w-12 h-12 rounded">
                                    <img class="rounded w-full h-full" src="{{ asset('icon-01.png') }}" alt="">
                                </div>
                                <div class="adminMessage max-w-[75%] bg-88-orange p-3 rounded flex flex-col">
                                    <span class="text-sm mb-1">Admin</span>
                                    <div class="h-48 w-60 pb-5 rounded">
                                        <img class="w-full h-full object-scale-down" src="${data.attachment}" />
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                }

                let div = $("#messagesBox");
                div.scrollTop(div.prop('scrollHeight'))
            });
        
        })
        .catch(error => {
            // Handle errors
            console.error('There was a problem with the fetch operation:', error);
        });
    }


    function loadMessagesToHTML(transaction) {
        fetch("{{ route('member.transactions.load-messages') }}" , {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body :JSON.stringify({
                "transaction" : transaction
            })
        }).then(response => {
            // Check if response is successful
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Parse the response JSON
            return response.json();
        })
        .then(data => {
            // Handle the data
            messageArr = data.messages.transaction_message_detail;
            $('#messagesBox').empty();
            messageArr.forEach(message => {
                if (message.user_id == $('#userId').val()) {
                    if (message.message != null) {
                        $('#messagesBox').append(`
                            <div class="customerChat flex flex-row-reverse gap-3">
                                <div class="customerChatImg w-12 h-12 rounded">
                                    <img class="rounded w-full h-full" src="{{ asset('pp.png') }}" alt="">
                                </div>
                                <div class="customerMessage max-w-[75%] bg-blue-300 p-3 rounded flex flex-col">
                                    <span class="text-sm mb-1 text-right capitalize">${message.user?.name}</span>
                                    <p>${message.message}</p>
                                </div>
                            </div>
                        `);
                    }
                    if (message.attachment != '') {
                        $('#messagesBox').append(`
                            <div class="customerChat flex flex-row-reverse gap-3">
                                <div class="customerChatImg w-12 h-12 rounded">
                                    <img class="rounded w-full h-full" src="{{ asset('pp.png') }}" alt="">
                                </div>
                                <div class="customerMessage max-w-[75%] bg-blue-300 p-3 rounded flex flex-col">
                                    <span class="text-sm mb-1 text-right">${message.author?.name}</span>
                                    <div class="h-48 w-60 pb-5 rounded">
                                        <img class="w-full h-full object-scale-down" src="${message.attachment}" />
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                } else {
                    if (message.message != null) {
                        $('#messagesBox').append(`
                            <div class="adminChat flex gap-3">
                                <div class="adminChatImg w-12 h-12 rounded">
                                    <img class="rounded w-full h-full" src="{{ asset('icon-01.png') }}" alt="">
                                </div>
                                <div class="adminMessage max-w-[75%] bg-88-orange p-3 rounded flex flex-col">
                                    <span class="text-sm mb-1">Admin</span>
                                    <p>${message.message}</p>    
                                </div>
                            </div>
                        `);
                    }
                    if (message.attachment != '') {
                        $('#messagesBox').append(`
                            <div class="adminChat flex gap-3">
                                <div class="adminChatImg w-12 h-12 rounded">
                                    <img class="rounded w-full h-full" src="{{ asset('icon-01.png') }}" alt="">
                                </div>
                                <div class="adminMessage max-w-[75%] bg-88-orange p-3 rounded flex flex-col">
                                    <span class="text-sm mb-1">Admin</span>
                                    <div class="h-48 w-60 pb-5 rounded">
                                        <img class="w-full h-full object-scale-down" src="${message.attachment}" />
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                }
                
            })
    
        })
        .catch(error => {
            // Handle errors
            console.error('There was a problem with the fetch operation:', error);
        });
    }


    $(function () {
        setHeightOverflow();
        let transaction = $("#transaction").val();

        loadMessagesToHTML(transaction);
        loadChannel(transaction);

        $('#sendChat').click(function () {
            let div = $("#messagesBox");
            div.scrollTop(div.prop('scrollHeight'))

            const formData1 = new FormData();
            formData1.append('transaction', JSON.stringify(transaction))
            if ($("#inputChat").val() != '') {
                $('#messagesBox').append(`
                    <div class="customerChat flex flex-row-reverse gap-3">
                        <div class="customerChatImg w-12 h-12 rounded">
                            <img class="rounded w-full h-full" src="{{ asset('pp.png') }}" alt="">
                        </div>
                        <div class="customerMessage max-w-[75%] bg-blue-300 p-3 rounded flex flex-col">
                            <span class="text-sm mb-1 text-right">Admin</span>
                            <p>${$("#inputChat").val()}</p>    
                        </div>
                    </div>
                `);
                formData1.append('message', $("#inputChat").val())
            }
            if ($("#actual-btn2").val() != "") {
                formData1.append('attachment', $("#actual-btn2")[0].files[0])
            }

            fetch("{{ route('member.transactions.message-sent') }}" , {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body : formData1
            }).then(response => {
                // Check if response is successful
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                // Parse the response JSON
                return response.json();
            })
            .then(data => {
                // Handle the data
                if (data.attachment) {
                    $('#messagesBox').append(`
                        <div class="customerChat flex flex-row-reverse gap-3">
                            <div class="customerChatImg w-12 h-12 rounded">
                                <img class="rounded w-full h-full" src="{{ asset('pp.png') }}" alt="">
                            </div>
                            <div class="customerMessage max-w-[75%] bg-blue-300 p-3 rounded flex flex-col">
                                <span class="text-sm mb-1 capitalize">${data.author?.name}</span>
                                <div class="h-48 w-60 pb-5 rounded">
                                    <img class="w-full h-full object-scale-down" src="${data.attachment}" />
                                </div>
                            </div>
                        </div>
                    `);
                }
                $('#inputChat').val('');
                $('#actual-btn2').val('');
                $('#filePreview2').addClass('hidden');
                setHeightOverflow();
            })
            .catch(error => {
                // Handle errors
                console.error('There was a problem with the fetch operation:', error);
            });

        
        })

        $('#inputChat').keypress(function (e) {
            let user = '{{ $user->name }}';
            if (e.which == 13) {
                let div = $("#messagesBox");
                div.scrollTop(div.prop('scrollHeight'))

                const formData1 = new FormData();
                formData1.append('transaction', JSON.stringify(transaction))
                if ($("#inputChat").val() != '') {
                    $('#messagesBox').append(`
                        <div class="customerChat flex flex-row-reverse gap-3">
                            <div class="customerChatImg w-12 h-12 rounded">
                                <img class="rounded w-full h-full" src="{{ asset('pp.png') }}" alt="">
                            </div>
                            <div class="customerMessage max-w-[75%] bg-blue-300 p-3 rounded flex flex-col">
                                <span class="text-sm mb-1 text-right">${user}</span>
                                <p>${$("#inputChat").val()}</p>    
                            </div>
                        </div>
                    `);
                    formData1.append('message', $("#inputChat").val())
                }
                if ($("#actual-btn2").val() != "") {
                    formData1.append('attachment', $("#actual-btn2")[0].files[0])
                }

                fetch("{{ route('member.transactions.message-sent') }}" , {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body : formData1
                }).then(response => {
                    // Check if response is successful
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    // Parse the response JSON
                    return response.json();
                })
                .then(data => {
                    // Handle the data
                    if (data.attachment) {
                        $('#messagesBox').append(`
                            <div class="customerChat flex flex-row-reverse gap-3">
                                <div class="customerChatImg w-12 h-12 rounded">
                                    <img class="rounded w-full h-full" src="{{ asset('pp.png') }}" alt="">
                                </div>
                                <div class="customerMessage max-w-[75%] bg-blue-300 p-3 rounded flex flex-col">
                                    <span class="text-sm mb-1">${user}</span>
                                    <div class="h-48 w-60 pb-5 rounded">
                                        <img class="w-full h-full object-scale-down" src="${data.attachment}" />
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                    $('#inputChat').val('');
                    $('#actual-btn2').val('');
                    $('#filePreview2').addClass('hidden');
                    setHeightOverflow();
                })
                .catch(error => {
                    // Handle errors
                    console.error('There was a problem with the fetch operation:', error);
                });

            }
        });

        $('#actual-btn2').change(function() {
            // Check if files have been selected
            if ($(this).get(0).files.length > 0) {
                const fileName = $(this).get(0).files[0].name;
                const fileExtension = fileName.split('.').pop();
                $('#fileName2').text(`${fileName}`);
                $('#filePreview2').removeClass('hidden');
                
                let div = $("#contentChats");
                div.scrollTop(div.prop('scrollHeight'))
            }
        });

        $('#deleteFile2').click(function() {
            $('#actual-btn2').val('');
            $('#filePreview2').addClass('hidden');
        })

        setHeightOverflow();

        var totalRatingInput = $('#totalRating');

        if (totalRatingInput.length > 0) {
            $("#rateYo").rateYo({
                starWidth: "40px",
                halfStar: true,
                readOnly: true,
                rating: totalRatingInput.val()
            }).on("rateyo.change", function (e, data) {
                var rating = data.rating;
                $("#rating").val(rating);
            });
        } else {
            $("#rateYo").rateYo({
                starWidth: "40px",
                halfStar: true,
            }).on("rateyo.change", function (e, data) {
                var rating = data.rating;
                $("#rating").val(rating);
            });
        }


        


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
                    'amount' : "{{$transaction->grand_total}}",
                })
            }).then(function(res) {
                //res.json();
                return res.json();
            }).then(function(orderData) {
                return orderData.id;
            });
        },
        // Call your server to finalize the transaction
        onApprove(orderData) {
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
                return res.json();
            }).then(function(orderData) {
                window.location.href = "{{ route('member.transaction.show', $transaction->id) }}";
            });
        }
        }).render('#paypal-button-container');
            
    });
</script>