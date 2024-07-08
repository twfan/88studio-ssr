<x-front-layout>
    <div class="flex flex-col">
        <div class="flex items-center w-full bg-black h-20 text-white text-2xl text-center justify-center">
            <a href="#">
                <div class="flex">
                    <span>sign up now</span>
                    <button class="ml-2 border-2 border-solid border-yellow-400 rounded-full px-3">50% off</button>
                </div> 
            </a>
        </div>
        <div class="flex flex-col relative items-center justify-center">
            <x-front-menu :user="$user ?? null"></x-front-menu>
            <div class="w-full h-screen bg-welcome bg-no-repeat bg-center bg-cover flex flex-col justify-center items-center content-center">
                <div class="flex flex-col">
                    <div class="flex flex-col text-left">
                        <h1 class="text-6xl uppercase text-white mb-2 font-['Lilita_One']">Coming Soon</h1> 
                </div>
            </div>
        </div>
    </div>
</x-front-layout>

<script>

</script>