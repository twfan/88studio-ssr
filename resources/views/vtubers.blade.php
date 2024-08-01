<x-front-layout>
    <div class="flex flex-col">
        <x-sign-up-disc></x-sign-up-disc>
        <div class="flex flex-col relative items-center justify-center">
            <x-front-menu :user="$user ?? null"></x-front-menu>
            {{-- <div class="w-full h-screen bg-welcome bg-no-repeat bg-center bg-cover flex flex-col justify-center content-center">
                <div class="flex flex-col absolute w-[30rem] top-32 xl:top-72 2xl:top-96  left-40 2xl:left-80">
                    <div class="flex flex-col text-left">
                        <h1 class="text-6xl uppercase text-white mb-2 font-['Lilita_One']">Grow With Fun</h1>
                        <p class="mb-5">Officia eu dolor proident voluptate anim pariatur proident culpa occaecat ea. Voluptate officia tempor irure esse anim et quis veniam exercitation nulla dolor et duis duis.</p>
                        <a href="{{ route('ych-comission') }}">
                            <span class="text-white rounded-full px-3 py-2 bg-black uppercase opacity-60 font-['Lilita_One']">See more ych Comission</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="absolute z-20 right-10 w-[20rem] xl:w-[40rem] 2xl:w-[60rem] pointer-events-none">
                <img class="" src="asset-02.png" />
            </div> --}}
        </div>
        <div class="flex flex-col justify-center w-3/4 container mx-auto mt-48" id="vtuber">
            <h1 class="uppercase text-3xl mb-6 font-['Lilita_One']">Ready to Adopt Vtuber</h1>
        </div>
        <div class="flex flex-col justify-center">
            <div class="grid divide-x-4 divide-y-4 grid-cols-3 text-center">
                @foreach ($vtubers as $item)
                    <div class="w-full h-[55rem] bg-88-orange relative flex flex-col gap-3">
                        @if ($item->sold_out)
                        <div class="absolute h-full w-full bg-slate-600 z-50 top-0 left-0 opacity-80 flex flex-col items-center justify-center">
                            &nbsp;
                            <span class="text-white text-7xl font-['Lilita_One']">SOLD OUT</span>
                        </div>
                        @endif
                        <div class="h-full w-full absolute top-0 z-0">
                            <img class="h-full w-full object-cover object-top" src="{{ $item->transparent_background }}" alt="">
                        </div>
                        <div class="h-[80%] w-full mt-20 absolute z-20 flex flex-col">
                            <div class="h-full w-full relative">
                                <div class="mx-auto h-full w-3/5 rounded-t-full flex flex-col border-black border-x-4 border-t-4 px-3 pt-3">
                                    <div class="bg-black w-full h-full rounded-t-full">
                                        <div class="flex flex-col text-center text-white pt-10">
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="grow w-full absolute bottom-0">
                                    <img class="w-full object-scale-down" src={{$item->image}} />
                                </div>
                            </div>
                            @if(!empty($user))
                                <button class="showYoutube" data-url="{{$item->youtube_url}}" data-product="{{$item}}">
                                    <div class="border-black border-x-4 border-b-4 rounded-b-2xl p-3 mx-auto w-3/5">
                                        <div class="bg-black text-white text-center rounded-full">
                                            <span class="uppercase text-2xl font-['Lilita_One']">Show Detail</span>
                                        </div>
                                    </div>
                                </button>
                            @else
                            <form action="{{ route('member.login') }}" method="GET" class="w-full">
                                <button class="showYoutube w-full" data-url="{{$item->youtube_url}}" data-product="{{$item}}">
                                    <div class="border-black border-x-4 border-b-4 rounded-b-2xl p-3 mx-auto w-3/5">
                                        <div class="bg-black text-white text-center rounded-full">
                                            <span class="uppercase text-2xl font-['Lilita_One']">Show Detail</span>
                                        </div>
                                    </div>
                                </button>
                            </form>
                                
                            @endif
                        </div>
                        <div class="h-full w-full absolute top-0 z-10 bg-gradient-to-b from-transparent to-88-orange ...">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="w-full flex flex-col bg-88-orange mt-28 py-10">
            <div class="container mx-auto flex flex-row justify-between">
                <div class="w-1/5 flex flex-col">
                    <img src="logo.png" alt="Logo" class="w-full h-full fill-current text-gray-500">
                </div>
                <div class="flex flex-row items-center justify-center divide-x-2 gap-3 uppercase">
                    <span class="ps-3 border-black">YCH COMISSION</span>
                    <span class="ps-3 border-black">SHOP</span>
                    <span class="ps-3 border-black">READY TO ADOPT</span>
                    <span class="ps-3 border-black">ABOUT US</span>
                </div>
                <div class="flex flex-row items-center justify-center gap-3 uppercase">
                    <div class="w-7 h-7">
                        <img class="w-full h-full object-scale-down" src="footer1.png" alt="">
                    </div>
                    <div class="w-7 h-7">
                        <img class="w-full h-full object-scale-down" src="footer2.png" alt="">
                    </div>
                    <div class="w-7 h-7">
                        <img class="w-full h-full object-scale-down" src="footer3.png" alt="">
                    </div>
                    <div class="w-7 h-7">
                        <img class="w-full h-full object-scale-down" src="footer4.png" alt="">
                    </div>
                    <div class="w-7 h-7">
                        <img class="w-full h-full object-scale-down" src="footer5.png" alt="">
                    </div>
                    <div class="w-7 h-7">
                        <img class="w-full h-full object-scale-down" src="footer6.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalOverlay" class="z-50 fixed top-0 left-0 right-0 bottom-0 hidden" style="background-color:rgba(0,0,0,0.5)">
        <div id="modal" class="rounded bg-gray-100 top-5 left-5 mx-auto w-2/3 h-2/3 my-32 transition-all ease-in-out duration-300 translate-y-6 relative">
            <button id="closeBtn" class="p-3 absolute -top-3 -right-3 bg-gray-300 rounded-full shadow-sm hover:brightness-90 ease-in-out duration-300 transition-all">
                <i class="w-4 h-4" data-feather="x"></i>
            </button>
            <div class="flex flex-col overflow-auto h-full">
                <div class="content flex flex-col p-7 h-full gap-3">
                    <div class="h-full w-full flex-grow">
                        <iframe id="youtubeIframe" class="w-full h-full" src="https://www.youtube.com/embed/FKYgWXVDvXs?si=yCwNYCMjLHToReEw&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen>
                        </iframe>
                    </div>
                    <div class="flex items-center w-full justify-center">
                        <button class="btnBuyNow rounded-full px-7 py-2 bg-gray-900 text-white text-2xl" data-product="">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalCheckoutVtuber" class="z-50 fixed top-0 left-0 right-0 bottom-0 hidden" data-user="{{ auth()->user() ? auth()->user()->id : '' }}" data-product="" style="background-color:rgba(0,0,0,0.5)">
        <div id="modalCheckout" class="rounded bg-gray-100 top-5 left-5 mx-auto w-1/3 h-2/3 my-32 transition-all ease-in-out duration-300 translate-y-6 relative">
            <button id="closeBtnCheckoutVtuber" class="p-3 absolute -top-3 -right-3 bg-gray-300 rounded-full shadow-sm hover:brightness-90 ease-in-out duration-300 transition-all">
                <i class="w-4 h-4" data-feather="x"></i>
            </button>
            <div class="flex flex-col overflow-auto h-full items-center p-7">
                <div class="w-3/6">
                    <x-application-logo></x-application-logo>
                </div>
                <div class="flex justify-between w-full border rounded p-5 mt-3">
                    <span id="nameProduct">-</span>
                    <span id="priceProduct">$0</span>
                </div>
                <div class="flex flex-col items-center justify-center w-full border rounded p-5 mt-3">
                    <h3 class="mb-5">Payment</h3>
                    <div id="paypal-button-container" style="max-width:500px;" class="w-full self-center"></div>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>

<script>
    $(document).ready(function(){

        function stopVideo() {
            console.log("stop video")
            var iframe = document.getElementById("youtubeIframe");
            var iframeSrc = iframe.src;
            // Setting the src attribute to an empty string will stop the video
            iframe.src = iframeSrc;
        }

        let productVtuber = "";
        let userData = "";

        $('.showYoutube').on('click', function () {
            var url = $(this).data('url');
            var product = $(this).data('product');
            $('#youtubeIframe').attr('src', url)
            $('#modalOverlay').show();
            $('.btnBuyNow').attr('data-product', JSON.stringify(product));
        })

        $('#closeBtn').on('click', function () {
            stopVideo();
            $('#modalOverlay').hide();
        })
        
        $('.btnBuyNow').on('click', function () {
            var product = $(this).data('product');
            var user = $(this).data('user');
            $('#modalOverlay').hide();
            $('#modalCheckoutVtuber').show();
            $('#modalCheckoutVtuber').attr('data-product', product);
            $('#nameProduct').html(product.product_name);
            $('#priceProduct').html(product.price);
            userData = $('#modalCheckoutVtuber').attr('data-user'); 
            productVtuber = product
        })

        $('#closeBtnCheckoutVtuber').on('click', function () {
            $('#modalCheckoutVtuber').hide();
        })

        paypal.Buttons({
        style: {
            layout: 'horizontal',
            color:  'blue',
            shape:  'rect',
            label:  'pay',
            tagline: true,
            disableMaxWidth: true
        },
        createOrder() {
            return fetch("{{ route('paypal-create-direct') }}", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body:JSON.stringify({
                    "product_id" : productVtuber.id,
                    'user' : userData,
                })
            }).then(function(res) {
                //res.json();
                return res.json();
            }).then(function(orderData) {
                return orderData.id;
            });
        },
        // Call your server to finalize the transaction
        onApprove(orderData) {
            return fetch("{{ route('paypal-capture-direct') }}" , {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body :JSON.stringify({
                    'user' : userData,
                    'product_id' : productVtuber.id,
                    'order_id' : orderData.orderID,
                    'payer_id' : orderData.payerID,
                    'payment_id' : orderData.paymentID
                })
            }).then(function(res) {
                return res.json(); // This returns another promise
            })
            .then(function(data) {
                window.location.href = data.url;
            });
        }
        }).render('#paypal-button-container');
    })

</script>