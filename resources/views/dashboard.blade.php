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
                    <button class="px-5 py-3 border-b-2 border-b-black text-sm capitalize">Attention <span class="rounded-full text-white bg-gray-400 px-2 ">00</span> </button>
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
                <div id="modalOverlay" class="z-50 fixed top-0 left-0 right-0 bottom-0">
                    <div id="modal" class="rounded max-w-2xl fixed w-9/12 top-5 left-5">
                        <div class="flex">
                            <h1 class="pt-4">Modal ready</h1>
                            <button id="close">
                                <i class="w-3 h-3" data-feather="x"></i>
                            </button>
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