<x-front-layout>
    <div class="flex flex-col">
        <x-sign-up-disc></x-sign-up-disc>
        <div class="flex flex-col relative items-center justify-center">
            <x-front-menu :user="$user ?? null"></x-front-menu>
            <div class="w-full h-screen bg-welcome bg-no-repeat bg-center bg-cover flex flex-col justify-center items-center content-center">
                <div class="flex flex-col">
                    <div class="flex flex-col text-center items-center">
                        <div class="w-1/3 h-1/3">
                            <img src="{{ asset('images/shop-asset.webp') }}" alt="">
                        </div>
                        <h1 class="text-6xl uppercase text-white mb-2 font-['Lilita_One']">Coming Soon</h1> 
                </div>
            </div>
        </div>
    </div>
</x-front-layout>

<script>

</script>