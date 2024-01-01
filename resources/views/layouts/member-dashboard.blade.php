<x-front-layout>
    <div class="flex flex-col relative items-center justify-center">
        <div class="flex w-3/4 items-center bg-white rounded-full px-7">
            <div class="w-96">
                <Link :href="route('homepage')">
                    <a href="{{route('')}}"></a>
                    <x-application-logo></x-application-logo>
                </Link>
            </div>
            <div class="flex justify-between w-full">
                <div class="flex divide-x-2">
                    <Link :href="route('ych-comission')">
                        <div class="mx-4 text-center justify-center flex items-center uppercase">
                            <span>YCH Comission</span>
                        </div>
                    </Link>
                    <a href="#">
                        <div class="mx-4 text-center justify-center flex items-center uppercase">
                            <span>Shop</span>
                        </div>
                    </a>
                    <a href="#">
                        <div class="mx-4 text-center justify-center flex items-center uppercase">
                            <span>Ready to Adopt</span>
                        </div>
                    </a>
                    <a href="#">
                        <div class="mx-4 text-center justify-center flex items-center uppercase">
                            <span>About us</span>
                        </div>
                    </a>
                </div>
                {{-- <div @click="toggleUserDropdown" class="cursor-pointer">
                    <div class="bg-red flex flex-row gap-1 z-50 mx-4 text-center justify-center items-center uppercase">
                        <i data-feather="user"></i><span>{{user.name}}</span>
                    </div>
                    <DropdownMenu :isOpen="isUserDropdownOpen" @update:isOpen="isUserDropdownOpen = $event" @logout="handleLogout" />
                </div> --}}
                {{-- <Link v-if="!user" :href="route('member.login')">
                    <div class="bg-red z-50 mx-4 text-center justify-center flex flex-row gap-1 items-center uppercase">
                        <i data-feather="user"></i><span>Login</span>
                    </div>
                </Link> --}}
            </div>
        </div>
        <div class="w-full h-full min-h-screen pb-14 bg-welcome bg-no-repeat bg-center bg-cover flex flex-col content-center">
            <slot />
        </div>
    </div>
</x-front-layout>