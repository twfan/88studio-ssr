<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="grid grid-cols-5 gap-5">
                <div class="flex flex-col bg-blue-500 text-white rounded p-5">
                    <label for="" class="text-sm">Total Transactions</label>
                    <span class="font-bold text-xl">{{\App\Models\Transaction::count()}}</span>
                </div>
                <div class="flex flex-col bg-blue-500 text-white rounded p-5">
                    <label for="" class="text-sm">Total Revenue</label>
                    <span class="font-bold text-xl">$100</span>
                </div>
            </div> --}}
            <div class="bg-white flex flex-col rounded min-w-full p-5">
                <span class="text-3xl mb-5">Commissions</span>
                <div class="flex gap-3 border-b border-b-slate-100">
                    <button class="px-5 py-3 border-b-2 border-b-black text-sm capitalize">New <span class="rounded-full text-white bg-gray-400 px-2 ">00</span> </button>
                    <button class="px-5 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Ready</button>
                    <button class="px-5 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">WIP</button>
                    <button class="px-5 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">waitlist</button>
                    <button class="px-5 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Client to do</button>
                    <button class="px-5 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Paused</button>
                    <button class="px-5 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Completed</button>
                    <button class="px-5 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">All</button>
                    <button class="px-5 py-3 text-sm capitalize border-b-2 border-b-transparent transition-all ease-in-out duration-200 hover:border-b-2 hover:border-b-gray-300">Archived</button>
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
                        <tr class="">
                            <td class="border text-xs text-center py-5"><span class="px-3 py-1 bg-gray-400 text-white rounded font-bold">New</span></td>
                            <td class="border text-xs text-center py-5"><div class="flex flex-col"><span>Jan, 12, 2024</span><span class="text-gray-400">12:00 AM</span></div></td>
                            <td class="border text-xs text-center py-5"><span class="text-white font-bold px-3 py-1 bg-gray-400 rounded">Unpaid</span></td>
                            <td class="border text-xs text-center py-5"><span class="">-</span></td>
                            <td class="border text-xs text-center py-5"><div class="flex flex-col"><span>John Doe</span><span class="uppercase text-gray-400">Ych chibi twitch emotes mega pack</span></div></td>
                            <td class="border text-xs text-center py-5"><span class="">-</span></td>
                            <td class="border text-xs text-center py-5"><div class="flex justify-center"><button class="openModal"><i class="w-3 h-3" data-feather="eye"></i></button></div></td>
                        </tr>
                        <tr class="">
                            <td class="border text-xs text-center py-5"><span class="px-3 py-1 bg-gray-400 text-white rounded font-bold">New</span></td>
                            <td class="border text-xs text-center py-5"><div class="flex flex-col"><span>Jan, 12, 2024</span><span class="text-gray-400">12:00 AM</span></div></td>
                            <td class="border text-xs text-center py-5"><span class="text-white font-bold px-3 py-1 bg-gray-400 rounded">Unpaid</span></td>
                            <td class="border text-xs text-center py-5"><span class="">-</span></td>
                            <td class="border text-xs text-center py-5"><div class="flex flex-col"><span>John Doe</span><span class="uppercase text-gray-400">Ych chibi twitch emotes mega pack</span></div></td>
                            <td class="border text-xs text-center py-5"><span class="">-</span></td>
                            <td class="border text-xs text-center py-5"><div class="flex justify-center"><button class="openModal"><i class="w-3 h-3" data-feather="eye"></i></button></div></td>
                        </tr>
                    </tbody>
                </table>
                <div id="modalOverlay" class="z-50 fixed top-0 left-0 right-0 bottom-0" style="background-color:rgba(0,0,0,0.5)">
                    <div id="modal" class="rounded bg-gray-100 top-5 left-5 mx-auto w-2/3 h-2/3 my-32 transition-all ease-in-out duration-300 translate-y-6">
                        <div class="flex flex-col p-6">
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
                            <div class="grid grid-cols-4 gap-3">
                                <div class="flex flex-col pr-10">
                                    <div class="flex flex-col gap-1">
                                        <div class="mb-2">
                                            <span class="px-3 py-1 bg-gray-400 text-white rounded font-bold uppercase rounded-lg text-sm">New</span>
                                        </div>
                                        <span class="text-gray-500 text-sm">#2024/01/12</span>
                                        <p class="font-bold text-2xl">Taufan's <span class="uppercase">YCH chibi twitch emotes mega pack</span></p>
                                        <p class="text-gray-500 text-sm">Submitted <span>Jan, 12, 2024</span> at <span>12:00 AM</span></p>
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
                                    <span class="font-bold">Client</span>
                                </div>
                                <div class="col-span-3 bg-white rounded-2xl p-5">
                                    <div class="flex flex-col">
                                        <span class="text-xl font-bold">Request</span>
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
    });

    $('#close').click(function() {
        var modal = $('#modalOverlay');
        modal.removeClass('modal-open');
        setTimeout(function() {
            modal.hide();
        },200);
    });
</script>