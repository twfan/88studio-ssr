<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Discounts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container w-3/4 p-5 mx-auto flex flex-col">
                    <div class="flex items-center justify-center">
                        <form method="POST" action="{{ route('admin.discounts.store') }}" class="w-[30rem] flex flex-col gap-3">
                            @csrf
                            <!-- Name -->
                            <div class="flex flex-col w-96">
                                <label class="text-sm text-slate-400">Discount Name</label>
                                <input placeholder="Discount Name" name="name" class="text-sm border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md  " />
                            </div>
                            <div class="flex flex-col w-96">
                                <label class="text-sm text-slate-400">Amount</label>
                                <input placeholder="Discount Amount" name="price" type="number" min="0" class="text-sm border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md" />
                            </div>
                            <div class="flex flex-col w-96">
                                <label class="text-sm text-slate-400">Use for</label>
                                <div class="flex gap-3">
                                    <div class="flex items-center text-sm gap-1">
                                        <input type="radio" id="singleRadio" name="limitation" value="single" checked>
                                        <label for="singleRadio">Single</label>
                                    </div>
                                    <div class="flex items-center text-sm gap-1">
                                        <input type="radio" id="multipleRadio" name="limitation" value="multiple" checked>
                                        <label for="multipleRadio">Multiple</label>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col w-96">
                                <label class="text-sm text-slate-400" for="distributeTo">Distribute to</label>
                                <select id="distributeTo" name="distribute_to" class="text-sm rounded block w-full p-2.5 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                    <option value="1" class="capitalize" selected disabled>Select</option>
                                    <option value="all_user" class="capitalize">Everyone</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('admin.products.index') }}" class="text-sm underline">Cancel</a>
                                <x-secondary-button class="ms-4" type="submit">
                                    {{ __('Create') }}
                                </x-secondary-button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    document.getElementById('categories').addEventListener('change', function () {
        var selectedValue = this.value;
        var transparentBackgroundField = document.getElementById('transparentBackgroundField');
        var youtubeLinkField = document.getElementById('youtubeLinkField');

        if (selectedValue == 28) {
            transparentBackgroundField.style.display = 'flex';
            youtubeLinkField.style.display = 'flex';
        } else {
            transparentBackgroundField.style.display = 'none';
            youtubeLinkField.style.display = 'none';
        }
    });
</script>