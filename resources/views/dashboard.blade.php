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
                    <button class="px-2 py-3 border-b-2 border-b-black text-sm capitalize">New <span class="rounded-full text-white bg-gray-400 px-2 ">{{$newTransactions->count()}}</span> </button>
                    <button class="px-2 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Ready <span class="rounded-full text-white bg-gray-400 px-2 ">{{$readyTransactions->count()}}</span></button>
                    <button class="px-2 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">WIP <span class="rounded-full text-white bg-gray-400 px-2 ">{{$wipTransactions->count()}}</span></button>
                    <button class="px-2 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">waitlist <span class="rounded-full text-white bg-gray-400 px-2 ">{{$waitlistTransactions->count()}}</span></button>
                    <button class="px-2 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Client to do <span class="rounded-full text-white bg-gray-400 px-2 ">{{$clientToDoTransactions->count()}}</span></button>
                    <button class="px-2 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Paused <span class="rounded-full text-white bg-gray-400 px-2 ">{{$pausedTransactions->count()}}</span></button>
                    <button class="px-2 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Completed <span class="rounded-full text-white bg-gray-400 px-2 ">{{$completedTransactions->count()}}</span></button>
                    <button class="px-2 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">All <span class="rounded-full text-white bg-gray-400 px-2 ">{{$transactions->count()}}</span></button>
                    <button class="px-2 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Archived <span class="rounded-full text-white bg-gray-400 px-2 ">{{$archivedTransactions->count()}}</span></button>
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
                        @foreach ($dataTransactions as $transaction)
                            <tr class="">
                                <td class="border text-xs text-center py-5"><span class="px-3 py-1 bg-gray-400 text-white rounded font-bold">{{$transaction->status}}</span></td>
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
                        @endforeach
                    </tbody>
                </table>
                <div id="modalOverlay" class="z-50 fixed top-0 left-0 right-0 bottom-0 hidden" style="background-color:rgba(0,0,0,0.5)">
                    <div id="modal" class="rounded bg-gray-100 top-5 left-5 mx-auto w-2/3 h-2/3 my-32 transition-all ease-in-out duration-300 translate-y-6">
                        <div class="flex flex-col p-6 h-full">
                            <div class="flex justify-between mb-3">
                                <button id="close" class="pr-3 py-3">
                                    <i class="w-7 h-7" data-feather="chevron-left"></i>
                                </button>
                                <div class="flex flex-row-reverse gap-3 items-center px-5 font-bold">
                                    <div>
                                        <button class="px-3 py-2 gap-1 flex h-auto justify-center items-center bg-green-400 rounded-full text-sm"><i class="w-4 h-4" data-feather="check"></i> <span>Send Proposal</span></button>
                                    </div>
                                    <div>
                                        <button class="px-3 py-2 gap-1 flex h-auto justify-center items-center hover:text-red-400 transition-all ease-in-out duration-150 rounded-full text-sm"><i class="w-4 h-4" data-feather="x-circle"></i> <span>Decline</span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-3 grow overflow-auto">
                                <div class="flex flex-col pr-10 overscroll-auto overflow-auto">
                                    <div class="flex flex-col gap-1">
                                        <div class="mb-2">
                                            <span class="transactionStatus px-3 py-1 bg-gray-400 text-white rounded font-bold uppercase rounded-lg text-sm">New</span>
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
                                        <button class="w-full text-center rounded-full bg-green-700 text-white flex gap-1 items-center justify-center py-2 text-sm font-bold">
                                            <i class="w-3 h-3" data-feather="check-square"></i>
                                            <span>Move to waitlist</span>
                                        </button>
                                        <button class="w-full text-center rounded-full border border-2 border-black flex gap-1 items-center justify-center py-2 text-sm font-bold">
                                            <i class="w-3 h-3" data-feather="archive"></i>
                                            <span>Archive</span>
                                        </button>
                                    </div>
                                    <hr class="my-5">
                                    
                                </div>
                                <div class="col-span-3 bg-white rounded-2xl p-7 h-full">
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
                                                      <input type="radio" id="personal" name="useFor" value="personal">
                                                      <label for="personal">Personal</label>
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                      <input type="radio" id="streaming" name="useFor" value="streaming">
                                                      <label for="streaming">Commercial/streaming</label>
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                      <input type="radio" id="merchandise" name="useFor" value="merchandise">
                                                      <label for="merchandise">Commercial/merchandise</label>
                                                    </div>
                                                    <div class="flex items-center gap-1">
                                                      <input type="radio" id="other" name="useFor" value="other">
                                                      <input type="text" name="useForOther" class="border-slate-200 px-3 py-2 w-full " placeholder="Other">
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


        $('#modalOverlay .transactionStatus').html(transactionData.status);
        $('#modalOverlay #client .name').html(userData.name);
        $('#modalOverlay #client .email').html(userData.email);
        $('#modalOverlay #submited .dateSubmited').html(formattedDate);
        $('#modalOverlay #submited .timeSubmited').html(formattedDateTime);
        $('#modalOverlay #socialMedia .socialMediaAnswer').html(proposalData.social_media);
        if (proposalData.reference) {
            $('#modalOverlay #reference #referenceImage').attr('src',proposalData.refrence);
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
        var modal = $('#modalOverlay');
        modal.removeClass('modal-open');
        setTimeout(function() {
            modal.hide();
        },200);
    });
</script>