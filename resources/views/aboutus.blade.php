<x-front-layout>
    <div class="flex flex-col">
        <x-sign-up-disc></x-sign-up-disc>
        <div class="flex flex-col relative items-center justify-center">
            <x-front-menu :user="$user ?? null"></x-front-menu>
            <div class="w-full h-screen bg-aboutus bg-no-repeat bg-center bg-cover flex flex-col justify-center content-center">
                <div class="flex flex-col absolute w-[30rem] left-40 2xl:left-80">
                    <div class="flex flex-col text-left">
                        <h1 class="text-6xl uppercase mb-2 font-['Lilita_One']">HI IM "ECA"</h1>
                        <h2 class="text-4xl uppercase mb-7 font-['Lilita_One']">MASCOT OF 88STUDIO</h2>
                        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet diam hendrerit, iaculis orci quis, aliquet lorem. Proin convallis ultricies sodales. Fusce dapibus magna eget dapibus feugiat. Sed ultrices porta elementum. Fusce interdum arcu ac congue gravida. Fusce id dolor rhoncus, efficitur tellus vel, facilisis ligula. Integer pulvinar ornare pellentesque. Cras mattis, leo sit amet viverra pellentesque, risus massa lobortis justo, eget blandit elit purus non lacus. <br /><br /> In quis est et leo accumsan dignissim quis eget turpis. Phasellus ornare, quam vitae auctor iaculis, arcu magna consectetur felis, ac fringilla arcu massa at sem. Donec blandit sodales nibh, non vulputate tortor congue eu. Maecenas diam urna, consectetur sit amet fringilla at, aliquam id diam. Morbi aliquam, risus non pharetra varius, lectus orci condimentum metus, ac pulvinar erat augue vel nunc.</p>
                    </div>
                </div>
            </div>
            <div class="absolute z-20 right-64 top-6 h-full pointer-events-none">
                <img class="h-full" src="{{ asset('images/aboutus-2.png') }}" />
            </div>
        </div>
        <x-footer></x-footer>
    </div>
</x-front-layout>