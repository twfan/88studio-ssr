<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container w-3/4 p-5 mx-auto flex flex-col">
                    <div class="flex items-center justify-center">
                        <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="w-[30rem] flex flex-col gap-3">
                            @csrf
                            @method('PUT')
                            <!-- Name -->
                            <div class="flex flex-col w-96">
                                <label class="text-sm text-slate-400">User Name</label>
                                <input value="{{ $user->name }}" placeholder="User Name" name="name" class="text-sm border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md  " />
                            </div>
                            <div class="flex flex-col w-96">
                                <label class="text-sm text-slate-400">User Email</label>
                                <input value="{{ $user->email }}" placeholder="Discount Email" name="email" class="text-sm border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md" />
                            </div>
                            <x-input-label for="role" :value="__('User Role')" />
                                <select id="categories" name="role" class="text-sm rounded block w-full p-2.5 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                    <option value="1" class="capitalize" selected disabled>Select category</option>
                                    <option value="user" @if($user->role == 'user') selected @endif>User</option>
                                    <option value="super_admin" @if($user->role == 'super_admin') selected @endif>Super Admin</option>
                                </select>
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

        if (selectedValue == 28) {
            transparentBackgroundField.style.display = 'flex';
            youtubeLinkField.style.display = 'flex';
        } else {
            transparentBackgroundField.style.display = 'none';
            youtubeLinkField.style.display = 'none';
        }
    });
</script>