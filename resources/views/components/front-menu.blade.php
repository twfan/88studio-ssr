<div class="flex w-3/4 items-center absolute z-10 top-5 bg-white rounded-full px-7">
    <div class="w-96">
        <img src="logo.png" alt="Logo" class="w-full h-full fill-current text-gray-500">
    </div>
    <div class="flex justify-between w-full">
        <div class="flex divide-x-2">
            <button></button>
                <a href="/ych-comission" class="flex items-center">
                    <div class="mx-4 text-center justify-center flex items-center uppercase">
                        <span>YCH Comission</span>
                    </div>
                </a>
                <a href="#" class="flex items-center">
                    <div class="mx-4 text-center justify-center flex items-center uppercase">
                        <span>Shop</span>
                    </div>
                </a>
                <a href="#" class="flex items-center">
                    <div class="mx-4 text-center justify-center flex items-center uppercase">
                        <span>Ready to Adopt</span>
                    </div>
                </a>
                <a href="#" class="flex items-center">
                    <div class="mx-4 text-center justify-center flex items-center uppercase">
                        <span>About us</span>
                    </div>
                </a>
        </div>
        <div class="cursor-pointer">
            <div class="relative inline-block text-left">
                @if (!empty($user))
                    <button id="dropdownButton" type="button"
                            class="bg-red flex flex-row gap-1 z-50 w-40 text-center justify-center items-center uppercase">
                            <i data-feather="user"></i><span>{{ $user->name }}</span>
                    </button>
                    <div id="dropdownMenu"
                        class="absolute z-30 hidden mt-2 space-y-2 w-full bg-white border border-gray-300 rounded-md shadow-md">
                        <a href="{{route('member.transaction.index')}}" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 w-full">Transactions</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-start px-4 py-2 text-gray-800 hover:bg-gray-200 w-full">Log Out</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('member.login') }}" class="bg-red z-50 mx-4 text-center justify-center flex flex-row gap-1 items-center uppercase">
                        <i data-feather="user"></i><span>Login</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click', function () {
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function (event) {
        const isInsideDropdown = dropdownButton.contains(event.target) || dropdownMenu.contains(event.target);
        
        if (!isInsideDropdown) {
            dropdownMenu.classList.add('hidden');
        }
    });
});
</script>