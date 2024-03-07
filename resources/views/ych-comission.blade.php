<x-front-layout>
    <div class="flex flex-col gap-3 text-center items-center divide-y-2 fixed pl-3 py-3 top-1/2 right-0 border-black border-2 rounded-r-none rounded-l-md bg-black text-white z-30">
        <div class="flex flex-col text-center">
            {{-- <span class="text-xl">{{cart}}</span> --}}
            <span class="text-xl cartItemTotal">{{$cartItemTotal}}</span>
            <i class="w-10 h-10 text-white" data-feather="shopping-cart"></i>
        </div>
        <div class="flex flex-col text-center pt-3">
            <span class="text-md">Total Price</span>
            <span class="text-xl mb-5 cartTotalPrice">${{$cartTotalPrice}}</span>
            <a href="{{route('member.cart.index')}}">
                <span class="text-md border-l border-y rounded-l border-white cursor-pointer px-3 py-1">Checkout</span>
            </a>
        </div>
    </div>
    <div class="flex flex-col relative items-center justify-center mb-10">
        <x-front-menu :user="$user" />
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
        <div class="absolute z-20 top-0 right-10 w-[60rem] pointer-events-none">
            <img class="" src="asset-02.png" />
        </div>
    </div>

    <div class="h-full w-full container mx-auto">
        <div class="flex flex-col gap-4 my-10">
            <h3 class="uppercase text-4xl">YCH Comission</h3>
            <div class="flex flex-row divide-x-2 text-xl">
                <div class="">
                    <button id="staticEmoteBtn" class="mr-3 px-3 ease-in transition-all rounded-full hover:bg-88-orange hover:text-white hover:rounded-full">Static Emote</button>
                </div>
                <div class="">
                    <button id="animatedEmoteBtn" class="mx-3 px-3 ease-in transition-all rounded-full hover:bg-88-orange hover:text-white hover:rounded-full">Animated Emote</button>
                </div>
                <div class="">
                    <button id="panelBtn" class="ml-3 px-3 ease-in transition-all rounded-full hover:bg-88-orange hover:text-white hover:rounded-full"></button>
                    PANEL
                </div>
            </div>
            <span class="text-slate-300">The price only applies for 1 character and human based only</span>
            <div id="staticEmote" class="grid grid-cols-10 gap-10 mt-5">
                @foreach ($products as $product)
                    <div class="flex flex-col">
                        <div class="max-h-32 w-full mb-1">
                            <img class="w-full h-full object-fill" src="{{asset($product->image)}}" alt="" />
                        </div>
                        <div class="flex flex-row justify-between">
                            <i class="w-4 h-4 hover:fill-red-400 hover:border-red-400" data-feather="heart"></i>
                            @if (!empty($user))
                                <button class="addToCartButton" data-product="{{ $product }}">
                                    {{-- @if (in_array($product->id, $addedProduct)) --}}
                                    @if (!empty($addedProduct))
                                        @if ($addedProduct->contains($product->id))
                                            <i class="w-4 h-4 fill-black" data-feather="shopping-cart"></i>
                                        @else
                                            <i class="w-4 h-4" data-feather="shopping-cart"></i>
                                        @endif

                                    @else
                                        <i class="w-4 h-4" data-feather="shopping-cart"></i>
                                    @endif
                                </button>
                            @else
                            <form action="{{ route('member.login') }}" method="GET">
                                <button type="submit">
                                    <i class="w-4 h-4" data-feather="shopping-cart"></i>
                                </button>
                            </form>
                            @endif
                            {{-- <button type='button' @click="addToCart(product)">
                                <i class="w-4 h-4"  :class="{ 'fill-black': added   Product(product.id)}"  data-feather="shopping-cart"></i>
                            </button> --}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="animatedEmote" class="grid grid-cols-10 gap-10 hidden">
                <div class="flex flex-col">
                    <div class="max-h-32 w-full  mb-1">
                        <img class="w-full h-full" src="/images/comission/animated-emote/AN16.webp" alt="" />
                    </div>
                    <div class="flex flex-row justify-between">
                        <i class="w-4 h-4 hover:fill-red-400 hover:border-red-400" data-feather="heart"></i>
                        <form action="{{ route('member.login') }}" method="GET">
                            <button type="submit">
                                <i class="w-4 h-4" data-feather="shopping-cart"></i>
                            </button>
                        </form>
                        {{-- <button type='button' @click="addToCart(product)">
                            <i class="w-4 h-4"  :class="{ 'fill-black': added   Product(product.id)}"  data-feather="shopping-cart"></i>
                        </button> --}}
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="max-h-32 w-full  mb-1">
                        <img class="w-full h-full" src="/images/comission/animated-emote/AN17.webp" alt="" />
                    </div>
                    <div class="flex flex-row justify-between">
                        <i class="w-4 h-4 hover:fill-red-400 hover:border-red-400" data-feather="heart"></i>
                        <form action="{{ route('member.login') }}" method="GET">
                            <button type="submit">
                                <i class="w-4 h-4" data-feather="shopping-cart"></i>
                            </button>
                        </form>
                        {{-- <button type='button' @click="addToCart(product)">
                            <i class="w-4 h-4"  :class="{ 'fill-black': added   Product(product.id)}"  data-feather="shopping-cart"></i>
                        </button> --}}
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="max-h-32 w-full  mb-1">
                        <img class="w-full h-full" src="/images/comission/animated-emote/AN18.webp" alt="" />
                    </div>
                    <div class="flex flex-row justify-between">
                        <i class="w-4 h-4 hover:fill-red-400 hover:border-red-400" data-feather="heart"></i>
                        <form action="{{ route('member.login') }}" method="GET">
                            <button type="submit">
                                <i class="w-4 h-4" data-feather="shopping-cart"></i>
                            </button>
                        </form>
                        {{-- <button type='button' @click="addToCart(product)">
                            <i class="w-4 h-4"  :class="{ 'fill-black': added   Product(product.id)}"  data-feather="shopping-cart"></i>
                        </button> --}}
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="max-h-32 w-full  mb-1">
                        <img class="w-full h-full" src="/images/comission/animated-emote/AN19.webp" alt="" />
                    </div>
                    <div class="flex flex-row justify-between">
                        <i class="w-4 h-4 hover:fill-red-400 hover:border-red-400" data-feather="heart"></i>
                        <form action="{{ route('member.login') }}" method="GET">
                            <button type="submit">
                                <i class="w-4 h-4" data-feather="shopping-cart"></i>
                            </button>
                        </form>
                        {{-- <button type='button' @click="addToCart(product)">
                            <i class="w-4 h-4"  :class="{ 'fill-black': added   Product(product.id)}"  data-feather="shopping-cart"></i>
                        </button> --}}
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="max-h-32 w-full  mb-1">
                        <img class="w-full h-full" src="/images/comission/animated-emote/AN20.webp" alt="" />
                    </div>
                    <div class="flex flex-row justify-between">
                        <i class="w-4 h-4 hover:fill-red-400 hover:border-red-400" data-feather="heart"></i>
                        <form action="{{ route('member.login') }}" method="GET">
                            <button type="submit">
                                <i class="w-4 h-4" data-feather="shopping-cart"></i>
                            </button>
                        </form>
                        {{-- <button type='button' @click="addToCart(product)">
                            <i class="w-4 h-4"  :class="{ 'fill-black': added   Product(product.id)}"  data-feather="shopping-cart"></i>
                        </button> --}}
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="max-h-32 w-full  mb-1">
                        <img class="w-full h-full" src="/images/comission/animated-emote/AN21.webp" alt="" />
                    </div>
                    <div class="flex flex-row justify-between">
                        <i class="w-4 h-4 hover:fill-red-400 hover:border-red-400" data-feather="heart"></i>
                        <form action="{{ route('member.login') }}" method="GET">
                            <button type="submit">
                                <i class="w-4 h-4" data-feather="shopping-cart"></i>
                            </button>
                        </form>
                        {{-- <button type='button' @click="addToCart(product)">
                            <i class="w-4 h-4"  :class="{ 'fill-black': added   Product(product.id)}"  data-feather="shopping-cart"></i>
                        </button> --}}
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="max-h-32 w-full  mb-1">
                        <img class="w-full h-full" src="/images/comission/animated-emote/AN16.webp" alt="" />
                    </div>
                    <div class="flex flex-row justify-between">
                        <i class="w-4 h-4 hover:fill-red-400 hover:border-red-400" data-feather="heart"></i>
                        <form action="{{ route('member.login') }}" method="GET">
                            <button type="submit">
                                <i class="w-4 h-4" data-feather="shopping-cart"></i>
                            </button>
                        </form>
                        {{-- <button type='button' @click="addToCart(product)">
                            <i class="w-4 h-4"  :class="{ 'fill-black': added   Product(product.id)}"  data-feather="shopping-cart"></i>
                        </button> --}}
                    </div>
                </div>
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
 
<script>
    $(document).ready(function () {

        $('#staticEmoteBtn').on('click', function () {
            $('#staticEmote').removeClass('hidden');
            $('#animatedEmote').addClass('hidden');
        });
        
        $('#animatedEmoteBtn').on('click', function () {
            console.log("tes");
            $('#staticEmote').addClass('hidden');
            $('#animatedEmote').removeClass('hidden');
        });
        // Assuming you have a button or trigger with the ID 'addToCartButton'
        $('.addToCartButton').on('click', function (e) {
            e.preventDefault();

            // Get the product ID from the data attribute or any other way you store it
            var product = $(this).data('product');
            var svg = $(this).find('svg');
            var cartItemTotal = $('.cartItemTotal');
            var cartTotalPrice = $('.cartTotalPrice');

            // Make the AJAX request
            $.ajax({
                url: '{{ route("member.cart.store") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product: product
                    // Include any additional data you need to send to the controller
                },
                success: function (data) {
                    // Handle success response
                    cartItemTotal.html(data.cartItemTotal)
                    cartTotalPrice.html("$" + data.cartTotalPrice)

                     // Assuming 'fill' is a property in your data
                    if (data.action === 'add') {
                        // Add the filled-icon class
                       svg.addClass('fill-black');
                    } else {
                        // Remove the filled-icon class
                       svg.removeClass('fill-black');
                    }
                    // You can perform additional actions on success if needed
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    console.error(error);
                    // You can perform additional actions on error if needed
                }
            });
        });
    });
</script>
