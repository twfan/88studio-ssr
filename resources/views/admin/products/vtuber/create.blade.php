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
                        <div class="contentSingle">
                            <form method="POST" action="{{ route('admin.vtubers.store') }}" class="w-[30rem] flex flex-col gap-3" enctype="multipart/form-data">
                                @csrf
                                <!-- Name -->
                                <div class="flex flex-col w-96" id="productNameField">
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
                                <div class="flex flex-col w-96" id="transparentBackgroundField">
                                    <label class="text-sm text-slate-400">Transparent Background Image Product</label>
                                    <input type="file" name="transparent_background" multiple="multiple" class="text-sm border-gray-300 text-sm" />
                                </div>
                                <div class="flex flex-col w-96" id="youtubeLinkField">
                                    <label class="text-sm text-slate-400">Youtube Link</label>
                                    <input placeholder="Youtube Link" name="youtube" class="text-sm border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md  " />
                                </div>
                                <div class="flex flex-col w-96">
                                    <label class="text-sm text-slate-400">Price Product</label>
                                    <input placeholder="Price product" name="price" type="number" min="0" class="text-sm border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md" />
                                </div>
                                <div class="flex flex-col w-96" id="downloadableProduct">
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
    });
</script>