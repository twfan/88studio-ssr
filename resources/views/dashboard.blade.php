<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col rounded min-w-full p-5">
                <span class="text-3xl mb-5">Commissions</span>
                <div class="flex gap-3 border-b border-b-slate-100">
                    <a href="{{route('admin.dashboard')}}">
                        <button class="{{ Route::current()->parameter('status') == '' ? 'border-b-2 border-b-black' : 'border-b-2 border-b-transparent' }} px-2 py-3 text-sm capitalize">New @if($newTransactions->count()) <span class="rounded-full text-white bg-gray-400 px-2 ">{{$newTransactions->count()}}</span> @endif </button>
                    </a>
                    <a href="{{route('admin.dashboard', 'ready')}}">
                        <button class="{{ Route::current()->parameter('status') == 'ready' ? 'border-b-2 border-b-black' : 'border-b-2 border-b-transparent' }} px-2 py-3 text-sm capitalize  transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Ready @if($readyTransactions->count() > 0)  <span class="rounded-full text-white bg-gray-400 px-2 ">{{$readyTransactions->count()}}</span>@endif</button>
                    </a>
                    <a href="{{route('admin.dashboard', 'wip')}}">
                        <button class="px-2 py-3 text-sm capitalize {{ Route::current()->parameter('status') == 'wip' ? 'border-b-2 border-b-black' : 'border-b-2 border-b-transparent' }} transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">WIP @if($wipTransactions->count() > 0)  <span class="rounded-full text-white bg-gray-400 px-2 ">{{$wipTransactions->count()}}</span>  @endif</button>
                    </a>
                    <a href="{{route('admin.dashboard', 'waitlist')}}">
                        <button class="px-2 py-3 text-sm capitalize {{ Route::current()->parameter('status') == 'waitlist' ? 'border-b-2 border-b-black' : 'border-b-2 border-b-transparent' }} transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">waitlist @if($waitlistTransactions->count() > 0)  <span class="rounded-full text-white bg-gray-400 px-2 ">{{$waitlistTransactions->count()}}</span>@endif</button>
                    </a>
                    <a href="{{route('admin.dashboard', 'client_to_do')}}">
                        <button class="px-2 py-3 text-sm capitalize {{ Route::current()->parameter('status') == 'client_to_do' ? 'border-b-2 border-b-black' : 'border-b-2 border-b-transparent' }} transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Client to do @if($clientToDoTransactions->count() > 0)  <span class="rounded-full text-white bg-gray-400 px-2 ">{{$clientToDoTransactions->count()}}</span>@endif</button>
                    </a>
                    <a href="{{route('admin.dashboard', 'paused')}}">
                        <button class="px-2 py-3 text-sm capitalize {{ Route::current()->parameter('status') == 'paused' ? 'border-b-2 border-b-black' : 'border-b-2 border-b-transparent' }} transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Paused @if($pausedTransactions->count() > 0)  <span class="rounded-full text-white bg-gray-400 px-2 ">{{$pausedTransactions->count()}}</span>@endif</button>
                    </a>
                    <a href="{{route('admin.dashboard', 'completed')}}">
                        <button class="px-2 py-3 text-sm capitalize {{ Route::current()->parameter('status') == 'completed' ? 'border-b-2 border-b-black' : 'border-b-2 border-b-transparent' }} transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Completed @if($completedTransactions->count() > 0)  <span class="rounded-full text-white bg-gray-400 px-2 ">{{$completedTransactions->count()}}</span>@endif</button>
                    </a>
                    <a href="{{route('admin.dashboard', 'all')}}">
                        <button class="px-2 py-3 text-sm capitalize {{ Route::current()->parameter('status') == 'all' ? 'border-b-2 border-b-black' : 'border-b-2 border-b-transparent' }} transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">All @if($transactions->count() > 0)  <span class="rounded-full text-white bg-gray-400 px-2 ">{{$transactions->count()}}</span>@endif</button>
                    </a>
                    <a href="{{route('admin.dashboard', 'archived')}}">
                        <button class="px-2 py-3 text-sm capitalize {{ Route::current()->parameter('status') == 'archived' ? 'border-b-2 border-b-black' : 'border-b-2 border-b-transparent' }} transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Archived @if($archivedTransactions->count() > 0)  <span class="rounded-full text-white bg-gray-400 px-2 ">{{$archivedTransactions->count()}}</span>@endif</button>
                    </a>
                </div>
                <table class="mt-5">
                    <thead>
                        <tr>
                            <th class="text-xs capitalize border">Status</th>
                            <th class="text-xs capitalize border">Submitted</th>
                            <th class="text-xs capitalize border">Payment</th>
                            <th class="text-xs capitalize border">Confirmed</th>
                            <th class="text-xs capitalize border">Client</th>
                            <th class="text-xs capitalize border">Timeline</th>
                            <th class="border"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataTransactions as $transaction)
                            <tr class="">
                                <td class="border text-xs text-center py-5">
                                    <span class="px-3 py-1 @if($transaction->status == 'wip') bg-blue-400 @elseif($transaction->status == 'ready') bg-green-400 @elseif($transaction->status == 'new') bg-gray-400 @else bg-gray-400  @endif  text-white rounded font-bold">{{$transaction->status}}</span>
                                </td>
                                <td class="border text-xs text-center py-5"><div class="flex flex-col"><span>{{Carbon\Carbon::parse($transaction->created_at)->format('M, d, Y')}}</span><span class="text-gray-400">{{Carbon\Carbon::parse($transaction->created_at)->format('H:i A')}}</span></div></td>
                                @if ($transaction->payment == 'unpaid')
                                    <td class="border text-xs text-center py-5"><span class="text-white font-bold px-3 py-1 rounded capitalize bg-red-400">{{$transaction->payment}}</span></td>
                                @elseif ($transaction->payment == 'paid')
                                    <td class="border text-xs text-center py-5"><span class="text-white font-bold px-3 py-1 rounded capitalize bg-green-400">{{$transaction->payment}}</span></td>
                                @endif
                                <td class="border text-xs text-center py-5"><span class="">-</span></td>
                                <td class="border text-xs text-center py-5"><div class="flex flex-col"><span class="capitalize">{{$transaction->user->name}}</span><span class="text-gray-400">{{$transaction->user->email}}</span></div></td>
                                <td class="border text-xs text-center py-5"><span class="">-</span></td>
                                <td class="border text-xs text-center py-5"><div class="flex justify-center"><button class="openModal" data-user="{{ $transaction->user }}" data-proposal="{{ $transaction->proposal }}" data-transaction="{{ $transaction }}"><i class="w-3 h-3" data-feather="eye"></i></button></div></td>
                            </tr>
                        @empty
                            <tr>
                                <td class="border text-xs text-center py-5" colspan="7"> No data found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div id="modalOverlay" class="z-50 fixed top-0 left-0 right-0 bottom-0" style="background-color:rgba(0,0,0,0.5)">
                    <div id="modal" class="rounded bg-gray-100 top-5 left-5 mx-auto w-2/3 h-2/3 my-32 transition-all ease-in-out duration-300 translate-y-6">
                        <div class="flex flex-col p-6 h-full">
                            <div class="flex justify-between mb-3">
                                <button id="close" class="pr-3 py-3">
                                    <i class="w-7 h-7" data-feather="chevron-left"></i>
                                </button>
                                <div class="flex flex-row-reverse gap-3 items-center px-5 font-bold">
                                    <div id="markAsWipBtn" class="hidden">
                                        <button class="px-3 py-2 gap-1 flex h-auto justify-center items-center bg-green-400 rounded-full text-sm"><span>Mark as WIP</span></button>
                                    </div>
                                    <div id="sendProposalBtn">
                                        <button class="px-3 py-2 gap-1 flex h-auto justify-center items-center bg-green-400 rounded-full text-sm"><i class="w-4 h-4" data-feather="check"></i> <span>Send Proposal</span></button>
                                    </div>
                                    <div id="pauseBtn" class="hidden">
                                        <button class="px-3 py-2 gap-1 flex h-auto justify-center items-center hover:text-red-400 transition-all ease-in-out duration-150 rounded-full text-sm"><i class="w-4 h-4" data-feather="pause"></i> <span>Pause</span></button>
                                    </div>
                                    <div id="declineBtn">
                                        <button class="px-3 py-2 gap-1 flex h-auto justify-center items-center hover:text-red-400 transition-all ease-in-out duration-150 rounded-full text-sm"><i class="w-4 h-4" data-feather="x-circle"></i> <span>Decline</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-3 grow overflow-auto">
                                <div class="flex flex-col pr-10 overscroll-auto overflow-auto">
                                    <div class="flex flex-col gap-1">
                                        <div class="mb-2">
                                            <span class="transactionStatus px-3 py-1 bg-gray-400 text-white rounded font-bold capitalize rounded-lg text-sm">New</span>
                                        </div>  
                                        <span class="font-bold">Client</span>
                                        <div class="flex flex-col" id="client">
                                            <div class="flex flex-col">
                                                <span class="capitalize font-bold name">Taufan erlangga</span>
                                                <span class="text-gray-500 text-sm email">taufan.erlangga@gmail.com</span>
                                            </div>
                                        </div>
                                        <p class="text-gray-500 text-sm" id="submited">Submitted <span class="dateSubmited">Jan, 12, 2024</span><br/> at <span class="timeSubmited">12:00 AM</span></p>
                                    </div>
                                    <div class="flex flex-col gap-2 mt-5 mb-3">
                                        <button class="moveToWaitlistBtn w-full text-center rounded-full bg-green-700 text-white flex gap-1 items-center justify-center py-2 text-sm font-bold">
                                            <i class="w-3 h-3" data-feather="check-square"></i>
                                            <span>Move to waitlist</span>
                                        </button>
                                        <button class="w-full text-center rounded-full border border-2 border-black flex gap-1 items-center justify-center py-2 text-sm font-bold">
                                            <i class="w-3 h-3" data-feather="archive"></i>
                                            <span>Archive</span>
                                        </button>
                                    </div>
                                    <hr class="my-5">
                                    <div class="overview flex flex-col gap-3 hidden">
                                        <h3 class="font-bold">Overview</h3>
                                        <div class="bg-white rounded-2xl p-5 flex flex-col gap-5 text-sm">
                                            <div class="flex justify-between">
                                                <span>Payment</span>
                                                <span class="text-green-800 overviewStatus">status</span>
                                            </div>
                                            <hr />
                                            <div class="flex justify-between">
                                                <span>Estimated Start</span>
                                                <div>
                                                    <span class="font-bold text-green-950 bg-green-100 rounded-2xl px-3 py-1 overviewEstimatedStart">Jan 9999</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col col-span-3">
                                    <div class="flex">
                                        
                                    </div>
                                    <div class=" bg-white rounded-2xl p-7 h-full">
                                        <div class="flex flex-col gap-5">
                                            <span class="text-xl font-bold">Request</span>
                                            <div class="flex-col">
                                                <p>Please provide any social media or any platform that you use (especially where we can contact you)</p>
                                                <div class="bg-gray-100 rounded-2xl p-3" id="socialMedia">
                                                    <p class="socialMediaAnswer">Answer</p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex-col">
                                                <p>How will you be using this work</p>
                                                <div class="bg-gray-100 rounded-2xl p-3">
                                                    <div class="flex flex-col gap-1" id="useFor">
                                                        <div class="flex items-center gap-1">
                                                          <input disabled type="radio" id="personal" name="useFor" value="personal">
                                                          <label for="personal">Personal</label>
                                                        </div>
                                                        <div class="flex items-center gap-1">
                                                          <input disabled type="radio" id="streaming" name="useFor" value="streaming">
                                                          <label for="streaming">Commercial/streaming</label>
                                                        </div>
                                                        <div class="flex items-center gap-1">
                                                          <input disabled type="radio" id="merchandise" name="useFor" value="merchandise">
                                                          <label for="merchandise">Commercial/merchandise</label>
                                                        </div>
                                                        <div class="flex items-center gap-1">
                                                          <input disabled type="radio" id="other" name="useFor" value="other">
                                                          <input disabled type="text" name="useForOther" class="border-slate-200 px-3 py-2 w-full " placeholder="Other">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-col">
                                                <p>Please provide reference for your character and the emotes you need (preferably front view with proper lighting if there's any)</p>
                                                <div class="bg-gray-100 rounded-2xl p-3">
                                                    <div class="" style="width: 150px; height:100px;" id="reference">
                                                        <img class="w-full h-full object-scale-down" id="referenceImage" src="http://88studio-ssr.test/images/vtuber.png" alt="img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-col">
                                                <p>Please specify your hard deadline if there's any</p>
                                                <div class="bg-gray-100 rounded-2xl p-3">
                                                    <div class="bg-gray-100 rounded-2xl p-3">
                                                        <p id="deadline">Answer</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-col">
                                                <p>List Order</p>
                                                <div class="bg-gray-100 rounded-2xl p-3">
                                                    <div class="bg-gray-100 rounded-2xl p-3 flex flex-row gap-3" id="listOrder">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-col">
                                                <p>Please send us proof of payment after you have paid</p>
                                                <div class="bg-gray-100 rounded-2xl p-3">
                                                    <div class="bg-gray-100 rounded-2xl p-3">
                                                        <p>Answer</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-col">
                                                <p>If you have ordered from us before and you want to use the same character for your request please send a screenshot of that previous work.</p>
                                                <div class="bg-gray-100 rounded-2xl p-3">
                                                    <div class="" style="width: 150px; height:100px;" id="previousWork">
                                                        <img class="w-full h-full object-scale-down" id="previousWorkImage" src="http://88studio-ssr.test/images/vtuber.png" alt="img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-col mt-4">
                                                <h2 class="text-xl font-bold">Proposal</h2>
                                            </div>
                                            <form class="bg-gray-100 rounded-2xl p-5 flex flex-col gap-5" action="{{route('admin.proposal.send')}}" method="POST">
                                                @csrf
                                                <input type="hidden" id="transactionId" name="transactionId" value="">
                                                <input type="hidden" id="proposalId" name="proposalId" value="">
                                                <div class="flex flex-col">
                                                    <span class="mb-2">Scope</span>
                                                    <div class="bg-gray-200 rounded-2xl">
                                                        <textarea id="scope" name="scope" placeholder="Confirm project deliverables and note any task adjustments made based on their submitted request." class="border-transparent bg-gray-200 rounded-2xl w-full" rows="4" cols="100"></textarea>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="mb-2">Timeline</span>
                                                    <div class="bg-gray-200 rounded-2xl p-5 flex flex-col gap-3">
                                                        <div class="flex justify-between">
                                                            <div class="flex flex-col grow-1">
                                                                <span class="font-bold">Estimated start</span>
                                                                <span class="text-sm text-slate-500">When you expect to start work</span>
                                                            </div>
                                                            <div class="flex">
                                                                <input  name="estimated_start" class="w-full bg-gray-300 rounded-full border-transparent focus:border-transparent" type="text" id="datepicker" required autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="flex justify-between">
                                                            <div class="flex flex-col grow-1">
                                                                <span class="font-bold">Guaranteed delivery</span>
                                                                <span class="text-sm text-slate-500">Client may request full refund after this date.</span>
                                                            </div>
                                                            <div class="flex">
                                                                <input name="guaranteed_delivery" class="w-full bg-gray-300 rounded-full border-transparent focus:border-transparent" type="text" id="datepicker2" required autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="mb-2">Payment</span>
                                                    <div class="bg-gray-200 rounded-2xl p-5">
                                                        <div class="flex justify-between">
                                                            <div class="flex flex-col grow-1">
                                                                <span class="font-bold">Project Subtotal</span>
                                                                <span class="text-sm text-slate-500">For all services   </span>
                                                            </div>
                                                            <div class="flex">
                                                                <input class="bg-gray-300 border-transparent p-3 rounded-l-2xl focus:border-transparent" type="number" name="subtotal" required>
                                                                <span class="p-3 bg-gray-300 rounded-r-2xl">USD</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col sendProposalAndInvoice">
                                                    <button type="submit" class="rounded-full py-2 bg-green-500 hover:bg-green-600 transition-all ease-in-out duration-300 text-sm">Send proposal and invoice</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>

    $(document).ready(function() {
         // Initialize the datepicker
        $("#datepicker").datepicker({
            minDate: 0,
            changeMonth: true,   // Enable month selection
            changeYear: false
        });
        $("#datepicker2").datepicker({
            minDate: 0,
            changeMonth: true,   // Enable month selection
            changeYear: false
        });
    });
    
    $('.openModal').click(function () {
        $('#modalOverlay').show();
        let proposalData = $(this).data('proposal');
        let transactionData = $(this).data('transaction');
        let userData = $(this).data('user');
        console.log(transactionData, userData, proposalData);
        const currentDate = new Date(transactionData.created_at);
        console.log(currentDate)
        // Format the date using Intl.DateTimeFormat
        const formattedDate = new Intl.DateTimeFormat('id-ID', {
            month: 'short', // 'short' or 'long' for short or long month names
            day: 'numeric',
            year: 'numeric',
        }).format(currentDate);

        const formattedDateTime = new Intl.DateTimeFormat('id-ID', {
            hour: 'numeric',
            minute: '2-digit',
            // hour12: true, // Use 12-hour format (true) or 24-hour format (false)
        }).format(currentDate);

        console.log(formattedDateTime);
        // let transactionDetail = JSON.parse(transactionData.transaction_details);
        console.log("json",transactionData.transaction_details);
        console.log("json again", transactionData);
        if (transactionData.status === "ready") {
            $("#modalOverlay input[name='subtotal']").attr("disabled", true);
        }

        $('#markAsWipBtn').click(function() {
            console.log("wip", transactionData)
            return fetch("{{ route('admin.transactions.progress') }}" , {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body :JSON.stringify({
                    "id" : transactionData.id,
                    "status" : "wip",
                })
            }).then(function(res) {
                
            }).then(function(orderData) {
                window.location.href = "{{ route('admin.dashboard','wip') }}";
            });
        });

        
        $("#modalOverlay input[name='subtotal']").val(transactionData.proposal.project_subtotal);
        $("#modalOverlay input[name='estimated_start']").val(transactionData.proposal.estimated_start);
        $("#modalOverlay input[name='guaranteed_delivery']").val(transactionData.proposal.guaranteed_delivery);
        $("#modalOverlay #scope").val(transactionData.proposal.scope);
        $("#modalOverlay #proposalId").val(transactionData.proposal.id);
        $("#modalOverlay #transactionId").val(transactionData.id);
        $('#modalOverlay .transactionStatus').html(transactionData.status);
        if(transactionData.status === "ready") {
            $('#modalOverlay .transactionStatus').removeClass('bg-gray-400');
            $('#modalOverlay .transactionStatus').addClass('bg-green-400');

            $('#modalOverlay #sendProposalBtn').addClass('hidden');
            $('#modalOverlay #markAsWipBtn').removeClass('hidden');
            $('#modalOverlay #declineBtn').addClass('hidden');
            $('#modalOverlay #pauseBtn').removeClass('hidden');

            $('#modalOverlay .sendProposalAndInvoice').addClass('hidden');
            $('#modalOverlay .moveToWaitlistBtn').addClass('hidden');

        } else if(transactionData.status === "wip") {
            $('#modalOverlay .transactionStatus').removeClass('bg-gray-400');
            $('#modalOverlay .transactionStatus').addClass('bg-blue-400');

            $('#modalOverlay .overview').removeClass('hidden');
            $('#modalOverlay .overviewStatus').html(transactionData.payment);
            $('#modalOverlay .overviewEstimatedStart').html(transactionData.proposal.estimated_start);
        }
        $('#modalOverlay #client .name').html(userData.name);
        $('#modalOverlay #client .email').html(userData.email);
        $('#modalOverlay #submited .dateSubmited').html(formattedDate);
        $('#modalOverlay #submited .timeSubmited').html(formattedDateTime);
        $('#modalOverlay #socialMedia .socialMediaAnswer').html(proposalData.social_media);
        if (proposalData.reference) {
            $('#modalOverlay #reference #referenceImage').attr('src',proposalData.reference);
        } else {
            $('#modalOverlay #reference #referenceImage').hide();
        }

        if (proposalData.use_for === 'streaming') {
            $('#modalOverlay #useFor #streaming').prop('checked', true);
        } else if (proposalData.use_for === 'personal') {
            $('#modalOverlay #useFor #personal').prop('checked', true);
        } else if (proposalData.use_for === 'merchandise') {
            $('#modalOverlay #useFor #merchandise').prop('checked', true);
        } else if (proposalData.use_for === 'other') {
            $('#modalOverlay #useFor #other').prop('checked', true);
            $('input[name="useForOther"]').value(proposalData.use_for_other);
        }

        if (proposalData.date) {
            $('#modalOverlay #deadline').html(proposalData.date);
        }

        transactionData.transaction_details.forEach(function(item) {
            let imgElement = $('<img class="w-full h-full" src="#" alt="">');
            console.log(item.product.image)
            imgElement.attr('src', item.product.image);
            let innerDiv = $('<div class="w-20 h-20"></div>');
            innerDiv.append(imgElement);
            $('#listOrder').append(innerDiv);
        });

        if (proposalData.previous_work) {
            $('#modalOverlay #previousWork #previousWorkImage').attr('src',proposalData.previous_work);
        } else {
            $('#modalOverlay #previousWork #previousWorkImage').hide();
        }
    });

    $('#close').click(function() {
        $('#listOrder').empty();
        var modal = $('#modalOverlay');
        modal.removeClass('modal-open');
        setTimeout(function() {
            modal.hide();
        },200);
    });
</script>