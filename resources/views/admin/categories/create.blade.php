<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container w-3/4 p-5 mx-auto flex flex-col">
                    <div class="flex items-center justify-center">
                        <form method="POST" action="{{ route('admin.categories.store') }}" class="w-[30rem] flex flex-col gap-3">
                            @csrf
                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Category Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                                {{-- <div>
                                    <x-input-label for="collection" :value="__('Collection Category')" />
                                    <x-text-input id="collection" class="block mt-1 w-full" type="text" name="collection" :value="old('collection')" required autofocus autocomplete="collection" />
                                </div>
                                <input type="hidden" name="collections" id="collections-hidden">
                                <div>
                                    <button type="button" id="add-child-btn" class="bg-slate-400 text-white px-3 py-2 rounded text-sm">Add Child</button>
                                </div> --}}
                            <span id="title-collection" class="hidden">Child Collections</span>
                            <ul id="collections-display" class="flex flex-col gap-2 list-disc list-inside">

                            </ul>
                            <div>
                                <x-input-label for="tos" :value="__('TOS')" />
                                <textarea name="content" id="editor" class="px-5">
                                </textarea>
                                <x-input-error :messages="$errors->get('tos')" class="mt-2" />
                            </div>
                            <div class="flex items-center justify-end mt-4">
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
    $(document).ready(function() {
        var collections = []; // Initialize an empty array for collections

        $('#add-child-btn').click(function() {
            var collectionInput = $('#collection');
            var collectionValue = collectionInput.val().trim();
            if (collectionValue !== '') {
                collections.push(collectionValue); // Push the value to the collections array
                updateCollectionsDisplay();
                updateHiddenInput();
                collectionInput.val(''); // Clear the input field
            }
        });

        function updateCollectionsDisplay() {
            var collectionsContainer = $('#collections-display');
            collectionsContainer.empty();
            $.each(collections, function(index, value) {
                collectionsContainer.append('<li><div class="flex gap-3"><span>' + value + '</span> <button type="button" class="bg-slate-400 text-white px-3 py-2 rounded text-sm">Remove</button></div></li>');
            });
        }

        function updateHiddenInput() {
            var hiddenInput = $('#collections-hidden');
            hiddenInput.val(collections.join(','));
        }
    });
</script>
