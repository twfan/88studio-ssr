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
                            <button class="p-3 border rounded text-white bg-gray-400 singleProduct transition-all ease-in-out duration-300">
                                Single Product
                            </button>
                            {{-- <button class="p-3 border rounded bulkProduct transition-all ease-in-out duration-300">
                                Bulk Product
                            </button> --}}
                        </div>
                        <div class="contentSingle">
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
                                <div>
                                    <x-input-label for="name" :value="__('Category Collection')" />
                                    <select id="categoryCollection" name="categoryCollection" class="text-sm rounded block w-full p-2.5 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                        <option value="1" class="capitalize" selected disabled>Select Collection</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="flex flex-col w-96 hidden" id="productNameField">
                                    <label class="text-sm text-slate-400">Product Name</label>
                                    <input type="text" name="name_product" class="text-sm border-gray-300 text-sm rounded" />
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
                                <div class="flex flex-col w-96 hidden" id="downloadableProduct">
                                    <label class="text-sm text-slate-400">Download Product</label>
                                    <small class="text-xs italic text-slate-400">Please archive the product in zip first.</small>
                                    <input type="file" name="downloadable_product" class="text-sm border-gray-300 text-sm" />
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <a href="{{ route('admin.products.index') }}" class="text-sm underline">Cancel</a>
                                    <x-secondary-button class="ms-4" type="submit">
                                        {{ __('Create') }}
                                    </x-secondary-button>
                                </div>
                            </form>
                        </div>
                        <div class="contentBulkProduct hidden flex flex-col gap-3">
                            <span class="text-sm text-gray-400 italic">Cuma untuk produk sticker saja.</span>
                            <form method="POST" action="{{ route('admin.products.bulk') }}" class="w-[30rem] flex flex-col gap-3" enctype="multipart/form-data">
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
                                <div>
                                    <x-input-label for="products" :value="__('Product Files')" />
                                    <input type="file" name="products[]" multiple>
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
    $('.singleProduct').on('click', function() {
        $('.contentSingle').removeClass('hidden');
        $('.contentBulkProduct').addClass('hidden');
        $('.singleProduct').addClass('text-white bg-gray-400');
        $('.singleProduct').removeClass('hidden');
        $('.bulkProduct').removeClass('text-white bg-gray-400');
    });
    $('.bulkProduct').on('click', function() {
        $('.contentBulkProduct').removeClass('hidden');
        $('.contentSingle').addClass('hidden');
        $('.bulkProduct').addClass('text-white bg-gray-400');
        $('.bulkProduct').removeClass('hidden');
        $('.singleProduct').removeClass('text-white bg-gray-400');
    });
    document.getElementById('categories').addEventListener('change', function () {
        let selectedValue = this.value;
        var transparentBackgroundField = document.getElementById('transparentBackgroundField');
        var youtubeLinkField = document.getElementById('youtubeLinkField');
        var productNameField = document.getElementById('productNameField');
        var downloadableProduct = document.getElementById('downloadableProduct');

        if (selectedValue == 28) {
            transparentBackgroundField.style.display = 'flex';
            youtubeLinkField.style.display = 'flex';
            productNameField.style.display = 'flex';
            downloadableProduct.style.display = 'flex';

        } else {
            transparentBackgroundField.style.display = 'none';
            youtubeLinkField.style.display = 'none';
            productNameField.style.display = 'none';
            downloadableProduct.style.display = 'none';
        }

        console.log("cek", selectedValue)

        fetch("{{ route('admin.categories.collection.show') }}", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body:JSON.stringify({
                    "categoryId" : selectedValue
                })
            }).then(function(res) {
                //res.json();
                console.log("cek",res)
                return res.json();
            }).then(function(orderData) {
                $('#categoryCollection').empty();
                $('#categoryCollection').append(
                    `<option value="" class="text-sm capitalize" selected disabled>Select Collection</option>`
                );
                console.log("cek asd",orderData)
                orderData.forEach(element => {
                    console.log(element);
                    $('#categoryCollection').append(`
                        <option value="${element['id']}" class="text-sm capitalize">${element['name']}</option>
                    `);
                });

            });
    });
</script>