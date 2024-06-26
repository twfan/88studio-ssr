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
                        <form id="categoryUpdate" method="POST" action="{{ route('admin.categories.update' , $category->id) }}" class="w-[30rem]">
                            @method('PUT')
                            @csrf
                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Category Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$category->name}}" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="tos" :value="__('TOS')" />
                                <textarea name="content" id="editor" class="px-5">
                                    {{$category->tos}}
                                </textarea>
                                <x-input-error :messages="$errors->get('tos')" class="mt-2" />
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-secondary-button class="ms-4" type="submit">
                                    {{ __('Update') }}
                                </x-secondary-button>
                            </div>
                        </form>
                    </div>
                    <form class="collection gap-3 mx-auto w-[30rem] flex flex-col" method="POST" action="{{ route('admin.categories.collection.store' ) }}">
                        @csrf
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <div>
                            <x-input-label for="collection" :value="__('Collection Category')" />
                            <x-text-input id="collection" class="block mt-1 w-full" type="text" name="collection" :value="old('collection')" required autofocus autocomplete="collection" />
                        </div>
                        <div>
                            <button type="submit" id="add-child-btn" class="bg-slate-400 text-white px-3 py-2 rounded text-sm">Add Child</button>
                        </div>
                    </form>

                    <div class="border p-5 rounded flex flex-col gap-3 w-[30rem] mx-auto mt-5">
                        @foreach ($categoryCollection as $item)
                            <form method="POST" action="{{ route('admin.categories.collection.remove', $item->id) }}" class="flex gap-2 items-center">
                                @method('DELETE')
                                @csrf
                                <span>{{$item->name}}</span>
                                <input type="hidden" name="categoryId" value="{{$category->id}}">
                                <input type="hidden" name="collectionId" value="{{$item->id}}">
                                <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded text-sm" id="remove-collection">Remove</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    
    
    
    $('#categoryUpdate').submit(function(e) {
        
        e.preventDefault();
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let editor = $("#editor").val();


        const name = $('#name').val();
        const editorData = editor;

        $.ajax({
            url: '{{ route('admin.categories.update' , $category->id) }}',
            method: 'POST',
            data: {
                _method: 'PUT',
                name: name,
                tos: editorData
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                Swal.fire({
                    title: "Category Updated",
                    icon: "success",
                    confirmButtonText: "Ok"
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('admin.categories.index') }}";
                    }
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: "Category Update failed",
                    icon: "error",
                    confirmButtonText: "Ok"
                }).then((result) => {
                    console.error('Error sending message:', error);
                });
            }
        });
    });
</script>
