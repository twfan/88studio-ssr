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
                                <td class="border text-xs text-center py-5">
                                    <div class="flex justify-center">
                                        <button class="openModal relative" data-user="{{ $transaction->user }}" data-proposal="{{ $transaction->proposal }}" data-transaction="{{ $transaction }}">
                                            <i class="w-3 h-3" data-feather="eye"></i>
                                            @if ($transaction->status == 'wip' && $transaction->transactionMessages->last_chat_from == 'user' && $transaction->transactionMessages->seen_admin == false)
                                                <div class="w-2 h-2 bg-red-700 absolute -right-1 -top-1 animate-ping rounded-full">&nbsp;</div>
                                            @endif
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="border text-xs text-center py-5" colspan="7"> No data found</td>
                            </tr>
                        @endforelse
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
                                    <div id="markAsCompleteBtn" class="hidden">
                                        <button class="px-3 py-2 gap-1 flex h-auto justify-center items-center bg-green-400 rounded-full text-sm"><span>Mark as Complete</span></button>
                                    </div>
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
                                        <button class="archiveBtn w-full text-center rounded-full border border-2 border-black flex gap-1 items-center justify-center py-2 text-sm font-bold">
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
                                    <div class="flex mb-3 modalTab {{ Route::current()->parameter('status') == 'wip' ? '' : 'hidden'}}">
                                        <button id="modalTabDetails" class="modalTabDetails px-3 py-1 border-b border-b-transparent hover:border-b-black ease-in-out duration-300 transition-all text-sm">Details</button>
                                        <button id="modalTabFinal" class="modalTabFinal px-3 py-1 border-b border-b-transparent hover:border-b-black ease-in-out duration-300 transition-all text-sm">Final Delivery</button>
                                        <button id="modalTabChat" class="modalTabChat px-3 py-1 border-b border-b-transparent hover:border-b-black ease-in-out duration-300 transition-all text-sm relative">Chats
                                            <div class="pingChat w-2 h-2 bg-red-700 absolute right-1 top-1 animate-ping rounded-full hidden">&nbsp;</div>
                                        </button>
                                    </div>
                                    <div class=" bg-white rounded-2xl p-7 h-full">
                                        <div id="contentDetails" class="flex flex-col gap-5">
                                            <div class="flex flex-col hidden" id="finalDeliveryContent">
                                                <h3 class="text-xl font-bold">Final Delivery</h3>
                                                <div class="flex flex-col">
                                                    <form action="{{route('admin.transactions.download-product')}}">
                                                        <input type="hidden" name="transactionIdFinal" id="transactionIdDownloadProduct">    
                                                        <button type="submit">
                                                            <div class="border bg-white rounded flex flex-col p-5 text-center items-center justify-center content-center">
                                                                <i class="" data-feather="download"></i>
                                                                <span class="text-xs mt-2">Download File</span>
                                                            </div>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

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
                                                        {{-- <img class="w-full h-full object-scale-down" id="referenceImage" src="http://88studio-ssr.test/images/vtuber.png" alt="img"> --}}
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
                                                        {{-- <img class="w-full h-full object-scale-down" id="previousWorkImage" src="http://88studio-ssr.test/images/vtuber.png" alt="img"> --}}
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
                                                    <span class="mb-2">Discount Voucher</span>
                                                    <div class="bg-gray-200 rounded-2xl p-5">
                                                        <div class="flex justify-between">
                                                            <div class="flex flex-col grow-1">
                                                                <span class="font-bold">Selected Voucher Discount</span>
                                                            </div>
                                                            <div class="flex flex-col text-center gap-1">
                                                                <span class="text-sm text-slate-500" id="discount_name"></span>
                                                                <span class="text-sm text-slate-500" id="discount_amount"></span>
                                                                <span class="text-sm text-slate-500" id="discount_amount_type"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span class="mb-2">Payment</span>
                                                    <div class="bg-gray-200 rounded-2xl p-5 flex flex-col gap-3">
                                                        <div class="flex justify-between">
                                                            <div class="flex flex-col grow-1">
                                                                <span class="font-bold">Project Subtotal</span>
                                                                <span class="text-sm text-slate-500">For all services   </span>
                                                            </div>
                                                            <div class="flex">
                                                                <input class="bg-gray-300 border-transparent p-3 rounded-l-2xl focus:border-transparent" id="project_subtotal" type="number" name="subtotal" required>
                                                                <span class="p-3 bg-gray-300 rounded-r-2xl">USD</span>
                                                            </div>
                                                        </div>
                                                        <div class="flex justify-between">
                                                            <div class="flex flex-col grow-1">
                                                                <span class="font-bold">Project Discount</span>
                                                                <span class="text-sm text-slate-500"></span>
                                                            </div>
                                                            <div class="flex">
                                                                <input class="bg-gray-300 border-transparent p-3 rounded-l-2xl focus:border-transparent" id="project_discount" type="number" name="discount" required readonly>
                                                                <span class="p-3 bg-gray-300 rounded-r-2xl">USD</span>
                                                            </div>
                                                        </div>
                                                        <div class="flex justify-between">
                                                            <div class="flex flex-col grow-1">
                                                                <span class="font-bold">Project Grandtotal</span>
                                                                <span class="text-sm text-slate-500"></span>
                                                            </div>
                                                            <div class="flex">
                                                                <input class="bg-gray-300 border-transparent p-3 rounded-l-2xl focus:border-transparent" id="project_grandtotal" type="number" name="grandtotal" required readonly>
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
                                        <div id="contentFinals" class="flex flex-col gap-5">
                                            <h4 class="text-2xl font-bold">Final Delivery</h4>
                                            <div class="flex items-center gap-3 text-slate-400">
                                                <i class="w-4 h-4 " data-feather="users"></i>
                                                <span class="text-sm">This will only be privately shared with {users}</span>
                                            </div>
                                            <div class="border border-slate-200 rounded-2xl p-5 flex flex-col gap-5">
                                                <div class="bg-pink-200 p-3 rounded-2xl flex gap-2 items-center">
                                                    <i class="w-5 h-5 text-slate-600" data-feather="info"></i>
                                                    <p class="text-sm text-slate-600">This drop box is FINAL files only. Contact clients through DMs if you still require client approval.</p>
                                                </div>
                                                <textarea id="textareaDescribeFinal" placeholder="Describe your delivery and include any applicable file explanations, how-tos, and usage details..." class="rounded-2xl border-gray-100 bg-gray-100 focus:border-gray-100 outline-none focus:outline-none" name="" id="" cols="30" rows="10"></textarea>
                                                <div class="flex">
                                                    <div class="flex gap-5 items-start">
                                                        <!--default html file upload button-->
                                                        <input type="file" id="actual-btn" hidden/>

                                                        <!--our custom file upload button-->
                                                        <label class="px-3 py-2 bg-black rounded-full text-white flex gap-1 items-center text-sm" for="actual-btn"> <i class="w-4 h-4 " data-feather="upload-cloud"></i> Upload File</label>
                                                        <div id="filePreview" class="flex items-center hidden">
                                                            <div class="flex rounded-2xl bg-gray-100 p-3 gap-2 relative">
                                                                <button id="deleteFile" class="absolute -top-1 -right-2"><i class="w-5 h-5 text-white" fill="black" data-feather="x-circle"></i></button>
                                                                <i class="w-6 h-6 " data-feather="file"></i>
                                                                <span id="fileName">filename.svg</span>
                                                            </div>
                                                        </div>
                                                        {{-- <a href="{{route('admin.transactions.tes')}}" class="bg-black rounded white p-3 text-white">Download File</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="contentChats" class="flex flex-col gap-5">
                                            <h4 class="text-2xl font-bold">Chats</h4>
                                            <div id="messagesBox" class="flex flex-col border border-slate-300 rounded gap-3 p-5 h-96 max-h-96 overflow-auto"></div>
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

    const modalFinal = 'final';
    const modalDetails = 'detail';
    const modalChats = 'chats';

    let channelMessage = '';

    let modalTab = 'detail';


    let transactionData = '';
    let userData = '';


    let pusherAppKey = '{{ env('PUSHER_APP_KEY') }}';
    let pusherAppCluster = '{{ env('PUSHER_CLUSTER') }}';

    let pusher = new Pusher(pusherAppKey, {
        cluster: pusherAppCluster,
        encrypted: true
    });


    let channel = pusher.subscribe('chatting-app');

    function changeTab(param) {
        modalTab = param;
        if (modalTab == modalFinal) {
            $('.modalTabFinal').addClass('active');
            $('.modalTabDetails').removeClass('active');
            $('.modalTabChat').removeClass('active');
            $('#contentFinals').show();
            $('#contentDetails').hide();
            $('#contentChats').hide();
        } else if(modalTab == modalDetails) {
            $('.modalTabFinal').removeClass('active');
            $('.modalTabChat').removeClass('active');
            $('.modalTabDetails').addClass('active');
            $('#contentFinals').hide();
            $('#contentChats').hide();
            $('#contentDetails').show();
        } else if(modalTab == modalChats) {
            $('.modalTabFinal').removeClass('active');
            $('.modalTabDetails').removeClass('active');
            $('.modalTabChat').addClass('active');
            $('#contentDetails').hide();
            $('#contentFinals').hide();
            $('#contentChats').show();

        }
    }

    function setHeightOverflow() {
        let div = $("#messagesBox");
        div.scrollTop(div.prop('scrollHeight'))
    }
    
    function getDataFinalForm() {
        const textareadDescription = $('#textareaDescribeFinal').val();
        const fileFinal = $('#actual-btn').prop('files')[0];
        return {textareadDescription, fileFinal}
    }

    function loadMessagesToHTML(messages) {
        $('#messagesBox').empty();
        messages.forEach(message => {
            if (message.user_id != $('#userId').val()) {
                if (message.message != null) {
                    $('#messagesBox').append(`
                        <div class="customerChat flex gap-3">
                            <div class="customerChatImg w-12 h-12 rounded">
                                <img class="rounded w-full h-full" src="{{ asset('pp.png') }}" alt="">
                            </div>
                            <div class="customerMessage max-w-[75%] bg-blue-300 p-3 rounded flex flex-col">
                                <span class="text-sm mb-1">Username</span>
                                <p>${message.message}</p>
                            </div>
                        </div>
                    `);
                }
                if (message.attachment != '') {
                    $('#messagesBox').append(`
                        <div class="customerChat flex gap-3">
                            <div class="customerChatImg w-12 h-12 rounded">
                                <img class="rounded w-full h-full" src="{{ asset('pp.png') }}" alt="">
                            </div>
                            <div class="customerMessage max-w-[75%] bg-blue-300 p-3 rounded flex flex-col">
                                <span class="text-sm mb-1">Username</span>
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
                        <div class="adminChat flex flex-row-reverse gap-3">
                            <div class="adminChatImg w-12 h-12 rounded">
                                <img class="rounded w-full h-full" src="{{ asset('icon-01.png') }}" alt="">
                            </div>
                            <div class="adminMessage max-w-[75%] bg-88-orange p-3 rounded flex flex-col">
                                <span class="text-sm mb-1 text-right">Admin</span>
                                <p>${message.message}</p>    
                            </div>
                        </div>
                    `);
                }
                if (message.attachment != '') {
                    $('#messagesBox').append(`
                        <div class="adminChat flex flex-row-reverse gap-3">
                            <div class="adminChatImg w-12 h-12 rounded">
                                <img class="rounded w-full h-full" src="{{ asset('icon-01.png') }}" alt="">
                            </div>
                            <div class="adminMessage max-w-[75%] bg-88-orange p-3 rounded flex flex-col">
                                <span class="text-sm mb-1 text-right">Admin</span>
                                <div class="h-48 w-60 pb-5 rounded">
                                    <img class="w-full h-full object-scale-down" src="${message.attachment}" />
                                </div>
                            </div>
                        </div>
                    `);
                }
            }
            
        })
    }

    function getChannelPusher(param) {

        channel.bind(`${param.channel}`, function(data) {

            if (data.author?.id != $('#userId').val() ) {
                if (data.message != null) {
                    $('#messagesBox').append(`
                        <div class="customerChat flex gap-3">
                            <div class="customerChatImg w-12 h-12 rounded">
                                <img class="rounded w-full h-full" src="{{ asset('pp.png') }}" alt="">
                            </div>
                            <div class="customerMessage max-w-[75%] bg-blue-300 p-3 rounded flex flex-col">
                                <span class="text-sm mb-1">Username</span>
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
                                <span class="text-sm mb-1">Username</span>
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

    $(document).ready(function() {

        changeTab(modalDetails);

        $('#modalTabFinal').click(function () {
            changeTab(modalFinal);
        });
        
        $('#modalTabDetails').click(function () {
            changeTab(modalDetails);
        });
        

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

        $('#actual-btn').change(function() {
            // Check if files have been selected
            if ($(this).get(0).files.length > 0) {
                const fileName = $(this).get(0).files[0].name;
                const fileExtension = fileName.split('.').pop();
                $('#fileName').text(`${fileName}`);
                $('#filePreview').removeClass('hidden');
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

        $('#deleteFile').click(function() {
            $('#actual-btn').val('');
            $('#filePreview').addClass('hidden');
        })

        $('#deleteFile2').click(function() {
            $('#actual-btn2').val('');
            $('#filePreview2').addClass('hidden');
        })

        
    });

    $('#inputChat').keypress(function (e) {
        if (e.which == 13) {
            let div = $("#messagesBox");
            div.scrollTop(div.prop('scrollHeight'))

            const formData1 = new FormData();
            formData1.append('transaction', JSON.stringify(transactionData))
            formData1.append('customer', userData)
            if ($("#inputChat").val() != '') {
                $('#messagesBox').append(`
                    <div class="adminChat flex flex-row-reverse gap-3">
                        <div class="adminChatImg w-12 h-12 rounded">
                            <img class="rounded w-full h-full" src="{{ asset('icon-01.png') }}" alt="">
                        </div>
                        <div class="adminMessage max-w-[75%] bg-88-orange p-3 rounded flex flex-col">
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

            fetch("{{ route('admin.transactions.message-sent') }}" , {
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
                        <div class="adminChat flex flex-row-reverse gap-3">
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

    
    
    $('.openModal').click(function () {
        $('#modalOverlay').show();
        $('#messagesBox').empty();
        let proposalData = $(this).data('proposal');
        transactionData = $(this).data('transaction');
        userData = $(this).data('user');
        let messages = '';
        const currentDate = new Date(transactionData.created_at);

        if(transactionData.status == 'ready' || transactionData.status == 'wip') {
            $('#project_grandtotal').val(transactionData.grand_total ? transactionData.grand_total : 0);
            $('#project_discount').val(transactionData.discount ? transactionData.discount : 0);
        }

        if (transactionData.transaction_messages?.last_chat_from == 'user') {
            $('.pingChat').removeClass('hidden');
        } else {
            $('.pingChat').addClass('hidden');
        }

        if(transactionData.status == 'wip') {
            fetch("{{ route('admin.transactions.load-messages') }}" , {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body :JSON.stringify({
                "transaction" : transactionData
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
            message = data.messages.transaction_message_detail;
            loadMessagesToHTML(message)
        })
        .catch(error => {
            // Handle errors
            console.error('There was a problem with the fetch operation:', error);
        });

        fetch("{{ route('admin.transactions.load-channel') }}" , {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body :JSON.stringify({
                "transaction" : transactionData
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
            getChannelPusher(channelMessage)
        })
        .catch(error => {
            // Handle errors
            console.error('There was a problem with the fetch operation:', error);
        });
        }

        $('#modalTabChat').click(function () {
            changeTab(modalChats);
            
            let div = $("#messagesBox");
            div.scrollTop(div.prop('scrollHeight'))
        });

        $('#sendChat').click(function () {
            let div = $("#messagesBox");
            div.scrollTop(div.prop('scrollHeight'))

            const formData1 = new FormData();
            formData1.append('transaction', JSON.stringify(transactionData))
            formData1.append('customer', userData)
            if ($("#inputChat").val() != '') {
                $('#messagesBox').append(`
                    <div class="adminChat flex flex-row-reverse gap-3">
                        <div class="adminChatImg w-12 h-12 rounded">
                            <img class="rounded w-full h-full" src="{{ asset('icon-01.png') }}" alt="">
                        </div>
                        <div class="adminMessage max-w-[75%] bg-88-orange p-3 rounded flex flex-col">
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

            fetch("{{ route('admin.transactions.message-sent') }}" , {
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
                        <div class="adminChat flex flex-row-reverse gap-3">
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


        $('#transactions').val(transactionData);
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

        if (transactionData.status === "ready") {
            $("#modalOverlay input[name='subtotal']").attr("disabled", true);
        }

        $('#markAsWipBtn').click(function() {
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

        $('#markAsCompleteBtn').click(function() {
            const data = getDataFinalForm();
            const textArea = data.textareadDescription
            const file = data.fileFinal

            const formData = new FormData();
            formData.append('textArea', textArea)
            formData.append('file', file)
            formData.append('transactionId', transactionData.id)

            return fetch(`{{ route('admin.transactions.mark-as-complete')}}` , {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body : formData
            }).then(function(res) {
                
            }).then(function(orderData) {
                window.location.href = "{{ route('admin.dashboard','completed') }}";
            });
        })
        
        $('.moveToWaitlistBtn').click(function() {
            const formData = new FormData();
            formData.append('transactionId', transactionData.id)

            return fetch(`{{ route('admin.transactions.move-to-waitlist')}}` , {
                method: 'POST',
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body : formData
            }).then(function(res) {
                
            }).then(function(orderData) {
                window.location.href = "{{ route('admin.dashboard','waitlist') }}";
            });
        })


        $("#modalOverlay input[name='subtotal']").val(transactionData.proposal.project_subtotal);
        $("#modalOverlay input[name='estimated_start']").val(transactionData.proposal.estimated_start);
        $("#modalOverlay input[name='guaranteed_delivery']").val(transactionData.proposal.guaranteed_delivery);
        $("#modalOverlay #scope").val(transactionData.proposal.scope);
        $("#modalOverlay #proposalId").val(transactionData.proposal.id);
        $("#modalOverlay #transactionId").val(transactionData.id);
        $("#modalOverlay #transactionIdDownloadProduct").val(transactionData.id);
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
            changeTab(modalFinal);

            $('#modalOverlay .transactionStatus').removeClass('bg-gray-400');
            $('#modalOverlay .transactionStatus').addClass('bg-blue-400');
            $('#modalOverlay .moveToWaitlistBtn').addClass('hidden');
            $('#modalOverlay #sendProposalBtn').addClass('hidden');
            $('#modalOverlay #declineBtn').addClass('hidden');
            $('#modalOverlay .sendProposalAndInvoice').addClass('hidden');
            $('#modalOverlay #markAsCompleteBtn').removeClass('hidden');

            $('#modalOverlay .overview').removeClass('hidden');
            $('#modalOverlay .overviewStatus').html(transactionData.payment);
            $('#modalOverlay .overviewEstimatedStart').html(transactionData.proposal.estimated_start);
        } else if (transactionData.status === "client_to_do") {
            $('#modalOverlay #sendProposalBtn').addClass('hidden');
            $('#modalOverlay #declineBtn').addClass('hidden');
        } else if (transactionData.status === "completed") {
            $('#modalOverlay #sendProposalBtn').addClass('hidden');
            $('#modalOverlay #declineBtn').addClass('hidden');
            $('#modalOverlay #markAsWipBtn').addClass('hidden');
            $('#modalOverlay #markAsCompleteBtn').addClass('hidden');
            $('#modalOverlay .moveToWaitlistBtn').addClass('hidden');
            $('#modalOverlay .archiveBtn').addClass('hidden');
            $('#modalOverlay .sendProposalAndInvoice').addClass('hidden');
            $('#modalOverlay #finalDeliveryContent').removeClass('hidden');
        } else if (transactionData.status === "waitlist") {
            $('#modalOverlay .moveToWaitlistBtn').addClass('hidden');
            $('#modalOverlay #declineBtn').addClass('hidden');
            $('#modalOverlay .archiveBtn').addClass('hidden');
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
       
        if(proposalData.discount) {
            $('#modalOverlay #discount_name').html(proposalData.discount.name)
            if(proposalData.discount.amount_type == 'fixed') {
                $('#modalOverlay #discount_amount').html(`$ ${proposalData.discount.amount}`)
                $('#project_discount').val(proposalData.discount.amount)
            } else {
                $('#modalOverlay #discount_amount').html(`% ${proposalData.discount.amount}`)
            }
            $('#modalOverlay #discount_amount_type').html(proposalData.discount.amount_type)
        }

        $('#project_subtotal').change(function(){
            let grandTotal = 0;
            if(proposalData.discount.amount_type == 'fixed') {
                grandTotal = $(this).val() - proposalData.discount.amount
                $('#project_grandtotal').val(grandTotal)
            } else {
                let discount = ($(this).val() * (proposalData.discount.amount / 100))
                grandTotal = $(this).val() - ($(this).val() * (proposalData.discount.amount / 100))
                $('#project_grandtotal').val(grandTotal)

                $('#project_discount').val(discount)
            }
            $('#project_grandtotal').val(grandTotal)
        });

        transactionData.transaction_details.forEach(function(item) {
            let imgElement = $('<img class="w-full h-full" src="#" alt="">');
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

        channel.unbind(`${channelMessage.channel}`)
        setTimeout(function() {
            modal.hide();
        },200);
    });

</script>