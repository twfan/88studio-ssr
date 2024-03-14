<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container w-3/4 p-5 mx-auto flex flex-col">
                    <div class="flex flex-col items-center justify-center">
                        <div class="flex items-start justify-start gap-1 mb-3">
                            <button class="p-3 border rounded text-white bg-gray-400">
                                Single Product
                            </button>
                            <button class="p-3 border rounded ">
                                Bulk Product
                            </button>
                        </div>
                        <div class="contentSinlge">
                            <form method="POST" action="{{ route('admin.products.store') }}" class="w-[30rem] flex flex-col gap-3" enctype="multipart/form-data">
                                @csrf
                                <!-- Name -->
                                <div>
                                    <x-input-label for="name" :value="__('Category Name')" />
                                    <select id="categories" name="category" class="text-sm rounded block w-full p-2.5 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                        <option value="1" class="capitalize" selected disabled>Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" class="text-sm capitalize">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="flex flex-col w-96">
                                    <label class="text-sm text-slate-400">ID Product</label>
                                    <input type="text" name="id_product" class="text-sm border-gray-300 text-sm rounded" />
                                </div>
                                <div class="flex flex-col w-96">
                                    <label class="text-sm text-slate-400">Image Product</label>
                                    <input type="file" name="image" multiple="multiple" class="text-sm border-gray-300 text-sm" />
                                </div>
                                <div class="flex flex-col w-96 hidden" id="transparentBackgroundField">
                                    <label class="text-sm text-slate-400">Transparent Background Image Product</label>
                                    <input type="file" name="transparent_background" multiple="multiple" class="text-sm border-gray-300 text-sm" />
                                </div>
                                <div class="flex flex-col w-96 hidden" id="youtubeLinkField">
                                    <label class="text-sm text-slate-400">Youtube Link</label>
                                    <input placeholder="Youtube Link" name="youtube" class="text-sm border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md  " />
                                </div>
                                <div class="flex flex-col w-96">
                                    <label class="text-sm text-slate-400">Price Product</label>
                                    <input placeholder="Price product" name="price" type="number" min="0" class="text-sm border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md" />
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <a href="{{ route('admin.products.index') }}" class="text-sm underline">Cancel</a>
                                    <x-secondary-button class="ms-4" type="submit">
                                        {{ __('Create') }}
                                    </x-secondary-button>
                                </div>
                            </form>
                        </div>
                        <div class="contentBulkProduct">
                            <form method="POST" action="{{ route('admin.products.store') }}" class="w-[30rem] flex flex-col gap-3" enctype="multipart/form-data">
                                @csrf
                                <!-- Name -->
                                <div>
                                    <x-input-label for="name" :value="__('Category Name')" />
                                    <select id="categories" name="category" class="text-sm rounded block w-full p-2.5 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                        <option value="1" class="capitalize" selected disabled>Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" class="text-sm capitalize">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
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