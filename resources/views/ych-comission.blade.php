<x-front-layout>
    <x-sign-up-disc></x-sign-up-disc>
    {{-- fixed old style cart --}}
    <div class="flex flex-col gap-3 text-center items-center divide-y-2 fixed pl-3 py-3 top-1/2 right-0 border-black border-2 rounded-r-none rounded-l-md bg-black text-white z-30 hidden">
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
    <div class="flex flex-col relative items-center justify-center">
        <x-front-menu :user="$user" />
        <div class="w-full h-[50rem] bg-ych bg-no-repeat bg-center bg-cover flex flex-col justify-center content-center">
            <div class="flex flex-col absolute w-[30rem] top-72 left-72">
                @if($reviews->count() > 0)
                    <div class="flex flex-col text-left">
                    <h1 class="text-4xl font-['Lilita_One'] text-white">What they say about us</h1>
                        <div class="flex flex-col relative">
                            <div class="reviewSlider cursor-pointer">
                                @foreach ($reviews as $review)
                                    <div class="bg-white rounded-lg border-black border p-10 flex flex-col">
                                        <div class="flex mb-3 gap-3">
                                            {{-- <div class="w-64 h-40 border rounded-lg">
                                                <img class="w-full h-full rounded object-scale-down" src="{{asset($review->transaction->verified_media)}}" alt="">
                                            </div> --}}
                                            <div class="flex flex-col justify-end gap-2">
                                                <div class="flex gap-5">
                                                    <div class="flex flex-col">
                                                        <div class="w-10 h-10 bg-88-orange rounded flex items-center justify-center uppercase text-lg text-white">{{substr($review->user->name, 0, 1)}}</div>
                                                        <span class="capitalize">{{$review->user->name}}</span>
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <div id="stars-container">
                                                            @php
                                                                $ratingString = $review->rating; // Your rating string
                                                                $rating = floatval($ratingString); // Convert rating to float
                                                                $fullStars = floor($rating); // Get integer part (number of full stars)
                                                                $hasHalfStar = $rating - $fullStars === 0.5; // Check if there's a half star
                                                            @endphp
                                                            <!-- Loop to generate full stars -->
                                                            @for ($i = 0; $i < $fullStars; $i++)
                                                                <i class="fa-solid fa-star fa-xl" style="color:#FFDF00;"></i>
                                                            @endfor
                                                            
                                                            <!-- If there's a half star, add it -->
                                                            @if ($hasHalfStar)
                                                                <i class="fa-regular fa-star-half-stroke fa-xl" style="color:#FFDF00;"></i>
                                                            @endif
                                                        </div>
                                                        <span class="text-xs text-slate-400">{{ $review->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="h-28 w-full reviewText">{{$review->comment}}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="absolute top-[50%] w-full">
                                <div class="nav-slider flex justify-between w-full relative z-30">
                                    <button class="prev px-3 py-3 bg-white text-slate-800 rounded-full border border-black absolute -left-8" type="button">
                                        <i data-feather="chevron-left"></i>
                                    </button>
                                    <button class="next px-3 py-3 bg-white text-slate-800 rounded-full border border-black absolute -right-8" type="button">
                                        <i data-feather="chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="h-full w-full container mx-auto mb-20">
        <div class="flex flex-col gap-4">
            <div class="flex">
                <h3 class="uppercase text-4xl font-['Lilita_One'] bg-red-600 text-white pt-5 px-3 pb-3 rounded-b-lg">YCH Comission</h3>
            </div>
            <div class="flex flex-row divide-x-2 text-xl">
                @foreach($categories as $item)
                    <div class="pl-3">
                        <a href="{{ route('ych-comission', $item->value) }}">
                            <button class="mr-3 px-3 ease-in transition-all  {{ Route::current()->parameter('category') == $item->value ? 'bg-88-orange text-white rounded-full hover:bg-88-orange hover:text-white hover:rounded-full' : '' }} {{ Route::current()->parameter('category') == $item->value ? 'bg-88-orange text-white rounded-full hover:bg-88-orange hover:text-white hover:rounded-full' : '' }} rounded-full hover:bg-88-orange hover:text-white hover:rounded-full">{{$item->name}}</button>
                        </a>
                    </div>
                @endforeach
            </div>
            <span class="text-slate-300">The price only applies for 1 character and human based only</span>
            <div class="w-2/6 flex flex-col">
                <small>Search</small>
                <input class="w-full rounded px-3 py-2" type="text" name="search" id="searchInput" placeholder="Type 'love' to highlight products">
            </div>
            @if (!empty($user))
                @php
                    $productIds = collect($user->productLike)->pluck('product_id')->toArray();
                @endphp
            @endif
            <div class="flex flex-row gap-4">
                <div class="basis-9/12">
                    <div id="staticEmote" class="grid grid-cols-7 gap-10">
                        @foreach ($products as $product)
                            <div class="flex flex-col relative product p-1 sticker-container border {{ !empty($addedProduct) && $addedProduct->contains($product->id ) ? 'border-88-orange' : 'border-transparent'}}" data-collection="{{ strtolower($product->collection_name) }}">
                                @if ($product->best_selling)
                                    <div class="max-h-10 max-w-10 absolute -top-2 -right-2 z-50">
                                        <img class="w-full h-full object-scale-down" src="{{asset('best-selling.png')}}" alt="">
                                    </div>
                                @endif
                                @if ($product->new_seller)
                                    <div class="max-h-10 max-w-10 absolute -top-2 -right-2 z-50">
                                        <img class="w-full h-full object-scale-down" src="{{asset('new.png')}}" alt="">
                                    </div>
                                @endif
                                <div class="max-h-32 w-full mb-1 relative image-display">
                                    <img class="w-full h-full object-fill lazy z-10" src="{{asset($product->image)}}" alt="{{$product->id_product}}" data-action="zoom"> 
                                </div>
                                <div class="flex flex-row justify-between">
                                    @if (!empty($user))
                                        @if(in_array($product->id, $productIds))
                                            <div class="flex gap-1">
                                                <button class="likeButton flex gap-1" data-product="{{ $product }}">
                                                    <i class="w-4 h-4 fill-red-400 hover:fill-red-400 hover:border-red-400" data-feather="heart"></i>
                                                    <span class="text-sm likeCount">{{ $product->likes->count() ? $product->likes->count() : 0 }}</span>
                                                </button>
                                            </div>
                                        @else
                                            <div class="flex gap-1">
                                                <button class="likeButton flex gap-1" data-product="{{ $product }}">
                                                    <i class="w-4 h-4 hover:fill-red-400 hover:border-red-400" data-feather="heart"></i>
                                                    <span class="text-sm likeCount">{{ $product->likes->count() ? $product->likes->count() : 0 }}</span>
                                                </button>
                                            </div>
                                        @endif
                                        <button class="addToCartButton" data-product="{{ $product }}">
                                            {{-- @if (in_array($product->id, $addedProduct)) --}}
                                            @if (!empty($addedProduct))
                                                @if ($addedProduct->contains($product->id))
                                                    <i class="w-4 h-4 fill-red-400" data-feather="shopping-cart"></i>
                                                @else
                                                    <i class="w-4 h-4" data-feather="shopping-cart"></i>
                                                @endif
        
                                            @else
                                                <i class="w-4 h-4" data-feather="shopping-cart"></i>
                                            @endif
                                        </button>
                                    @else
                                        <form action="{{ route('member.login') }}" method="GET">
                                            <button type="submit" class="flex gap-1" data-product="{{ $product }}">
                                                <i class="w-4 h-4 hover:fill-red-400 hover:border-red-400" data-feather="heart"></i>
                                                <span class="text-sm likeCount">{{ $product->likes->count() ? $product->likes->count() : 0 }}</span>
                                            </button>
                                        </form>
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
                </div>
                <div class="basis-3/12">
                    <div class="px-5 sticky top-0 ">
                        <div class="flex flex-col">
                            <h2 class="text-2xl mb-1 font-['Lilita_One']">Details & TOS</h2>
                            <div class="w-full max-h-[20rem] min-h-[20rem] h-[20rem] border rounded-lg pb-3 pt-3 relative">
                                <button id="expandTos" class="absolute p-3 -top-4 -right-3 bg-gray-300 rounded-full hover:animate-pulse">
                                    <i class="w-4 h-4" data-feather="maximize-2"></i>
                                </button>
                                <div class="content w-full h-full px-7 overflow-auto font-['Open_Sans']">
                                    @if(!empty($category->tos))
                                        {!! $category->tos !!}
                                    @endif
                                </div>
                            </div>
                            <div class="checkout flex flex-col mt-3">
                                <h2 class="text-2xl mb-1  font-['Lilita_One']">Estimated Price</h2>
                                <div class="flex rounded-lg">
                                    <div class="basis-3/4 flex rounded-l-lg bg-gray-900 text-white py-3 px-5 content-center items-center">
                                        <span class="text-2xl cartItemTotal">{{$cartItemTotal}}</span>
                                        <i class="w-7 h-7" data-feather="shopping-cart"></i>
                                        <span class="text-4xl mx-2">=</span>
                                        <span class="text-2xl cartTotalPrice">$ {{$cartTotalPrice}}</span>
                                    </div>
                                    <a class="basis-1/4 p-3 rounded-r-lg bg-88-orange text-white flex items-center content-center" href="{{route('member.cart.index')}}">
                                        <span class="text-2xl font-['Lilita_One']">Checkout</span>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer></x-footer>
    <div id="modalOverlay" class="z-50 fixed top-0 left-0 right-0 bottom-0 hidden" style="background-color:rgba(0,0,0,0.5)">
        <div id="modal" class="rounded bg-gray-100 top-5 left-5 pb-5 mx-auto w-1/3 h-2/3 my-32 transition-all ease-in-out duration-300 translate-y-6 relative">
            <button id="closeBtn" class="p-3 absolute -top-3 -right-3 bg-gray-300 rounded-full shadow-sm hover:brightness-90 ease-in-out duration-300 transition-all">
                <i class="w-4 h-4" data-feather="x"></i>
            </button>
            <div class="flex flex-col overflow-auto">
                <div class="content p-7">
                    @if(!empty($category->tos))
                        {!! $category->tos !!}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="modalOverlayReviews" class="z-50 fixed top-0 left-0 right-0 bottom-0 hidden" style="background-color:rgba(0,0,0,0.5)">
        <div id="modalReviews" class="rounded bg-gray-100 top-5 left-5 pb-5 mx-auto w-1/3 h-2/3 my-32 transition-all ease-in-out duration-300 translate-y-6 relative overflow-auto flex flex-col">
            <div class="p-7">
                <button id="closeBtnReviews" class="p-3 bg-gray-300 rounded-full shadow-sm hover:brightness-90 ease-in-out duration-300 transition-all">
                    <i class="w-4 h-4" data-feather="x"></i>
                </button>
            </div>
            <div class="flex flex-col overflow-auto">
                <div class="content px-7 pb-7">
                    <h2 class="text-3xl mb-4">Reviews & Ratings</h2>
                    <div class="flex flex-col gap-6">
                        @foreach ($reviews as $review)
                            <div class="flex flex-col">
                                <span class="capitalize">{{$review->user->name}}</span>
                                <span class="text-xs text-slate-400 mb-3">Verified Purchase</span>
                                <div class="w-full border rounded p-4 flex flex-col gap-3">
                                    <div class="flex gap-3">
                                        <div class="stars-container">
                                            @php
                                                $ratingString = "5"; // Your rating string
                                                $rating = floatval($ratingString); // Convert rating to float
                                                $fullStars = floor($rating); // Get integer part (number of full stars)
                                                $hasHalfStar = $rating - $fullStars === 0.5; // Check if there's a half star
                                            @endphp
                                            <!-- Loop to generate full stars -->
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <i class="fa-solid fa-star fa-xl" style="color:#FFDF00;"></i>
                                            @endfor
                                            
                                            <!-- If there's a half star, add it -->
                                            @if ($hasHalfStar)
                                                <i class="fa-regular fa-star-half-stroke fa-xl" style="color:#FFDF00;"></i>
                                            @endif
                                        </div>
                                        <div class="time flex flex-col">
                                            <span class="text-xs">{{$review->created_at}}</span>
                                            <span class="text-xs">{{$review->created_at->format('F Y')}}</span>
                                        </div>
                                    </div>
                                    <p>{{$review->comment}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3 flex items-center justify-center">
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
 
<script>


document.querySelectorAll(".reviewSlider").forEach((slider) => {
    tns({
        container: slider,
        items: 1,
        slideBy: "page",
        autoplay: true,
        speed: 400,
        controlsContainer: ".nav-slider",
        prevButton: ".prev",
        nextButton: ".next",
        autoplayButton: false,
        autoplayText: ["", ""],
        autoplayButtonOutput: false,
    });
});
    
    $(document).ready(function () {

        function rearrangeProducts(searchQuery) {
            console.log("searchQuery", searchQuery)
            if(searchQuery == "") {
                $('.product').each(function() {
                    $(this).removeClass('hidden');
                });
            } else {
                $('.product').each(function() {
                    var productCollection = $(this).data('collection').toLowerCase();
                    
                    if (productCollection.includes(searchQuery)) {
                        $(this).addClass('highlight');
                    } else {
                        $(this).addClass('hidden');
                    }
                });
    
                // var $highlightedProducts = $('.highlight');
                // var $otherProducts = $('.product').not($highlightedProducts);
    
                // $('#staticEmote').html($highlightedProducts).append($otherProducts);
            }
        }

        // function rearrangeProducts(searchQuery) {
        //     $('.product').each(function() {
        //         var productCollection = $(this).data('collection').toLowerCase();
                
        //         if (productCollection.includes(searchQuery)) {
        //             $(this).addClass('highlight');
        //         }
        //     });

        //     var $highlightedProducts = $('.highlight');

        //     // If there are highlighted products, scroll to the first one
        //     if ($highlightedProducts.length > 0) {
        //         $highlightedProducts[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
        //     }
        // }

        function removeHighlight() {
            $('.product').removeClass('hidden');
        }

        $('#searchInput').on('input', function() {
            removeHighlight();
            var searchQuery = $(this).val().toLowerCase();
            if (searchQuery === '') {
                console.log('No search query');
                removeHighlight();
            } else {
                rearrangeProducts(searchQuery);
            }
        });


        var images = $('.image-display').find('img');
        for (var i = 0; i < images.length; i++) {
            images[i].addEventListener('contextmenu', function(event) {
                event.preventDefault();
            });
        }

        $('.lazy').Lazy({
            combined: true,
            delay: 5000,
            enableThrottle: true,
            throttle: 250
        });

        $("#rateYo").rateYo({
            starWidth: "40px",
            halfStar: true,
            readOnly: true,
            rating: 4
        });

        $('#expandTos').on('click', function () {
            $('#modalOverlay').show();
        })
        
        $('.reviewSlider').on('click', function () {
            $('#modalOverlayReviews').show();
        })
        
        $('#closeBtn').on('click', function () {
            $('#modalOverlay').hide();
        })
        
        $('#closeBtnReviews').on('click', function () {
            $('#modalOverlayReviews').hide();
        })

        $('#staticEmoteBtn').on('click', function () {
            $('#staticEmote').removeClass('hidden');
            $('#animatedEmote').addClass('hidden');
        });
        
        $('#animatedEmoteBtn').on('click', function () {
            $('#staticEmote').addClass('hidden');
            $('#animatedEmote').removeClass('hidden');
        });

        $(document).on('click', '.likeButton', function (e) {
            e.preventDefault();
            var svg = $(this).find('svg');
            let span = $(this).find('span')
            let likeCount = span.html();

            let product = $(this).data('product');
            $.ajax({
                url: '{{ route("member.product.like") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product: product
                },
                success: function (data) {
                    if (data.action === 'like') {
                        svg.addClass('fill-red-400');
                        let likeCount2 = parseInt(likeCount);
                        likeCount2++;
                        span.html(likeCount2);
                    } else {
                        svg.removeClass('fill-red-400');
                        let likeCount2 = parseInt(likeCount);
                        likeCount2--;
                        span.html(likeCount2);
                    }
                }
            })
        })

        // Assuming you have a button or trigger with the ID 'addToCartButton'
        $(document).on('click', '.addToCartButton', function (e) {
            e.preventDefault();

            // Get the product ID from  pthe data attribute or any other way you store it
            var product = $(this).data('product');
            var svg = $(this).find('svg');
            var cartItemTotal = $('.cartItemTotal');
            var cartTotalPrice = $('.cartTotalPrice');

            var parentDiv = $(this).closest('.sticker-container');
    
            

               
            
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
                       svg.addClass('fill-red-400');
                       
                       // Add a border to the parent .sticker-container
                        if (parentDiv.length) {
                            parentDiv.css('border', '1px solid #EBAA00'); // Add your desired border style
                        }
                    } else {
                        // Remove the filled-icon class
                       svg.removeClass('fill-red-400');
                       if (parentDiv.length) {
                            parentDiv.css('border', '1px solid transparent'); // Add your desired border style
                        }
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
