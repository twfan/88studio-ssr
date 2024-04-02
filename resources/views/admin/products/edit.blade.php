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
                    <div class="flex items-center justify-center">
                        <form method="POST" action="{{ route('admin.vtubers.update', $product->id) }}" class="w-[30rem] flex flex-col gap-3" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Category Name')" />
                                <select id="categories" name="category" class="text-sm rounded block w-full p-2.5 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                    <option value="1" class="capitalize" selected disabled>Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif class="text-sm capitalize">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            @if ($product->category_id == 28)
                                <div class="flex flex-col w-96">
                                    <label class="text-sm text-slate-400">Name Product</label>
                                    <input type="text" name="name_product" class="text-sm border-gray-300 text-sm rounded" value="{{$product->product_name}}" />
                                </div>
                            @endif
                            <div class="flex flex-col w-96">
                                <label class="text-sm text-slate-400">ID Product</label>
                                <input type="text" name="id_product" class="text-sm border-gray-300 text-sm rounded" value="{{$product->id_product}}" />
                            </div>
                            <div class="flex flex-col w-96">
                                <label class="text-sm text-slate-400">Image Product</label>
                                <input type="file" name="image" multiple="multiple" class="text-sm border-gray-300 text-sm" />
                            </div>
                            @if($product->category_id == 28)
                                <div class="flex flex-col w-96" id="transparentBackgroundField">
                                    <label class="text-sm text-slate-400">Transparent Background Image Product</label>
                                    <input type="file" name="transparent_background" multiple="multiple" class="text-sm border-gray-300 text-sm" />
                                </div>
                                <div class="flex flex-col w-96" id="youtubeLinkField">
                                    <label class="text-sm text-slate-400">Youtube Link</label>
                                    <input value="{{ $product->youtube_url ? $product->youtube_url : '' }}" placeholder="Youtube Link" name="youtube" type="text" class="text-sm border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md  " />
                                </div>
                                <div class="flex flex-col w-96" id="downloadableProduct">
                                    <label class="text-sm text-slate-400">Download Product</label>
                                    <small class="text-xs italic text-slate-400">Please archive the product in zip first.</small>
                                    <input type="file" name="downloadable_product" class="text-sm border-gray-300 text-sm" />
                                </div>
                            @endif
                            <div class="flex flex-col w-96">
                                <label class="text-sm text-slate-400">Price Product</label>
                                <input placeholder="Price product" name="price" type="number" value="{{ $product->price }}" min="0" class="text-sm border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md" />
                            </div>
                            @if($product->category_id != 28)
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-1">
                                        <input type="checkbox" value="1" name="bestSelling" {{ $product->best_selling ? 'checked' : '' }} />
                                        <label for="bestSelling">Best Selling</label>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <input type="checkbox" value="1" name="newSeller" {{ $product->new_seller ? 'checked' : '' }} />
                                        <label for="newSeller">New Seller</label>
                                    </div>
                                </div>
                            @endif
                            @if($product->category_id == 28)
                                <div class="flex flex-col">
                                    <div class="flex items-center gap-1">
                                        <input type="checkbox" value="1" name="soldOut" {{ $product->soldOut ? 'checked' : '' }} />
                                        <label for="soldOut">Sold Out</label>
                                    </div>
                                </div>
                            @endif
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('admin.products.index') }}" class="text-sm underline">Cancel</a>
                                <x-secondary-button class="ms-4" type="submit">
                                    {{ __('Update') }}
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
        var downloadableProduct = document.getElementById('downloadableProduct');

        if (selectedValue == 28) {
            transparentBackgroundField.style.display = 'flex';
            youtubeLinkField.style.display = 'flex';
            downloadableProduct.style.display = 'flex';
        } else {
            transparentBackgroundField.style.display = 'none';
            youtubeLinkField.style.display = 'none';
            downloadableProduct.style.display = 'none';
        }
    });
</script>