<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-5 gap-5">
                <div class="flex flex-col bg-blue-500 text-white rounded p-5">
                    <label for="" class="text-sm">Total Transactions</label>
                    <span class="font-bold text-xl">{{\App\Models\Transaction::count()}}</span>
                </div>
                <div class="flex flex-col bg-blue-500 text-white rounded p-5">
                    <label for="" class="text-sm">Total Revenue</label>
                    <span class="font-bold text-xl">$100</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
