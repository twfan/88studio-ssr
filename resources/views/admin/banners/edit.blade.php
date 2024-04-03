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
                            <form method="POST" action="{{ route('admin.banners.update', $banner->id) }}" class="w-[30rem] flex flex-col gap-3" enctype="multipart/form-data">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="flex flex-col gap-4 w-96">
                                            @foreach ($errors->all() as $error)
                                                <li class="bg-red-200 text-red-500 text-white rounded px-3 py-5">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @method('PUT')
                                @csrf
                                <!-- Name -->
                                <div class="flex flex-col w-96" id="productNameField">
                                    <label class="text-sm text-slate-400">Banner Name</label>
                                    <input type="text" name="name" class="text-sm border-gray-300 text-sm rounded" value="{{$banner->name}}" />
                                </div>
                                <div class="flex flex-col w-96">
                                    <label class="text-sm text-slate-400">Image Banner</label>
                                    <input type="file" name="image" class="text-sm border-gray-300 text-sm"  />
                                </div>
                                <div class="flex flex-col w-96">
                                    <labe for="status" class="text-sm text-slate-400">Status banner</labe>
                                    <select  id="status" name="status" class="text-sm rounded block w-full p-2.5 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                        <option value="" class="capitalize" {{$banner->status == '' ? 'selected' : ''}} disabled>Select status banner</option>
                                        <option value="active" class="text-sm capitalize" {{$banner->status == 'active' ? 'selected' : ''}}>Active</option>
                                        <option value="inactive" class="text-sm capitalize" {{$banner->status == 'inactive' ? 'selected' : ''}}>Inactive</option>
                                    </select>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <a href="{{ route('admin.banners.index') }}" class="text-sm underline">Cancel</a>
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
    </div>
</x-app-layout>
