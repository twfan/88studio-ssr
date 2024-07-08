<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container w-3/4 p-5 mx-auto flex flex-col">
                    <div class="flex items-center justify-center">
                        <form method="POST" action="{{ route('admin.settings.store') }}" class="w-[30rem] flex flex-col gap-3">
                            @csrf
                            <div>
                                <x-input-label for="tos" :value="__('TOS')" />
                                <textarea name="front_page_tos_content" id="editor" class="px-5">
                                    {{$tos->contents}}
                                </textarea>
                                <x-input-error :messages="$errors->get('tos')" class="mt-2" />
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-secondary-button class="ms-4" type="submit">
                                    {{ __('Save') }}
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
</script>
