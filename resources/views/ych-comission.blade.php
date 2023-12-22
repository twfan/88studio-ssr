<x-front-layout>
    <div class="flex flex-col gap-3 text-center items-center divide-y-2 fixed pl-3 py-3 top-1/2 right-0 border-black border-2 rounded-r-none rounded-l-md bg-black text-white z-30">
        <div class="flex flex-col text-center">
            {{-- <span class="text-xl">{{cart}}</span> --}}
            <i class="w-10 h-10 text-white" data-feather="shopping-cart"></i>
        </div>
        <div class="flex flex-col text-center pt-3">
            <span class="text-md">Total Price</span>
            <span class="text-xl mb-5">$100</span>
            {{-- <span class="text-xl mb-5">${{cartTotal}}</span> --}}
            {{-- <Link :href="route('cart.index')"> --}}
                <span class="text-md border-l border-y rounded-l border-white cursor-pointer px-3 py-1">Checkout</span>
            {{-- </Link> --}}
        </div>
    </div>
    <div class="flex flex-col relative items-center justify-center mb-10">
        <div class="flex w-3/4 items-center absolute z-10 top-5 bg-white rounded-full px-7">
            <div class="w-96">
                {{-- <Link :href="route('homepage')"> --}}
                     {{-- <ApplicationLogo class="block h-16 w-full" /> --}}
                {{-- </Link> --}}
                <img src="logo.png" alt="Logo" class="w-full h-full fill-current text-gray-500">
            </div>
            <div class="flex justify-between w-full">
                <div class="flex divide-x-2">
                    {{-- <Link :href="route('ych-comission')"> --}}
                        <div class="mx-4 text-center justify-center flex items-center uppercase">
                            <span>YCH Comission</span>
                        </div>
                    {{-- </Link> --}}
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
                <div class="cursor-pointer">
                    {{-- <div class="bg-red flex flex-row gap-1 z-50 mx-4 text-center justify-center items-center uppercase">
                        <i data-feather="user"></i><span>{{user.name}}</span>
                    </div> --}}
                    {{-- <DropdownMenu :isOpen="isUserDropdownOpen" @update:isOpen="isUserDropdownOpen = $event" @logout="handleLogout" /> --}}
                </div>
                {{-- <Link v-if="!user" :href="route('member.login')"> --}}
                    <div class="bg-red z-50 mx-4 text-center justify-center flex flex-row gap-1 items-center uppercase">
                        <i data-feather="user"></i><span>Login</span>
                    </div>
                {{-- </Link> --}}
            </div>
        </div>
        <div class="w-full h-[47rem] bg-welcome bg-no-repeat bg-center bg-cover flex flex-col justify-center content-center">
            <div class="flex flex-col absolute w-[30rem] top-72 left-72">
                <div class="flex flex-col text-left">
                    <h1 class="text-6xl uppercase text-white mb-2">Grow With Fun</h1>
                    <p class="mb-5">Officia eu dolor proident voluptate anim pariatur proident culpa occaecat ea. Voluptate officia tempor irure esse anim et quis veniam exercitation nulla dolor et duis duis.</p>
                    <a href="#">
                        <span class="text-white rounded-full px-3 py-2 bg-black uppercase opacity-60">See more ych Comission</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute z-20 top-0 right-0 w-[60rem] pointer-events-none">
            <img class="" src="asset-02.png" />
        </div>
    </div>

    <div class="h-full w-full container mx-auto">
        <div class="flex flex-col items-center content-center my-10">
            <h3 class="uppercase text-4xl mb-3">YCH Comission</h3>
            <div class="flex flex-row divide-x-2 gap-3 text-center mb-10 mt-5 text-xl">
                <div :class="activeTab === 'static' ? 'px-6 bg-88-orange rounded-full text-white' : 'px-6 hover:bg-88-orange hover:text-white hover:rounded-full'" class="cursor-pointer px-6 ease-in  transition-all hover:bg-88-orange hover:text-white hover:rounded-full" @click="changeTab('static')">Static Emote</div>
                <div :class="activeTab === 'animate' ? 'px-6 bg-88-orange rounded-full text-white' : 'px-6 hover:bg-88-orange hover:text-white hover:rounded-full'"  class="cursor-pointer px-6 ease-in  transition-all hover:bg-88-orange hover:text-white hover:rounded-full" @click="changeTab('animate')">Animated Emote</div>
                <div class="pl-3">Animated Collection</div>
                <div class="pl-3">PANEL</div>
            </div>
            <div class="grid grid-cols-10 gap-10">
                <div v-for="product in products" class="flex flex-col">
                    <div class="w-24 h-24 mb-1">
                        <img :src="product.image" />
                    </div>
                    <div class="flex flex-row justify-between">
                        <i class="w-4 h-4 hover:fill-red-400 hover:border-red-400" data-feather="heart"></i>
                        <button type='button'>
                            <i class="w-4 h-4"  data-feather="shopping-cart"></i>
                        </button>
                        {{-- <button type='button' @click="addToCart(product)">
                            <i class="w-4 h-4"  :class="{ 'fill-black': addedProduct(product.id)}"  data-feather="shopping-cart"></i>
                        </button> --}}
                    </div>
                </div>
            </div>
            <div v-if="activeTab === 'animate'">
                animate
            </div>
        </div>
    </div>

    <div class="w-full flex flex-col bg-88-orange mt-28 py-10   ">
        <div class="container mx-auto flex flex-row justify-between">
            <div class="w-1/5 flex flex-col">
                <img src="logo.png" alt="Logo" class="w-full h-full fill-current text-gray-500">
            </div>
            <div class="flex flex-row">

            </div>
        </div>
    </div>
</x-front-layout>
