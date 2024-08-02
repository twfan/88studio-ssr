<x-front-layout>
    <div class="flex flex-col">
        <x-sign-up-disc></x-sign-up-disc>
        <div class="flex flex-col relative items-center justify-center">
            <x-front-menu :user="$user ?? null"></x-front-menu>
            <div class="w-full h-screen bg-aboutus bg-no-repeat bg-center bg-cover flex flex-col justify-center content-center">
                <div class="flex flex-col absolute w-[30rem] left-40 2xl:left-80">
                    <div class="flex flex-col text-left">
                        <h1 class="text-6xl uppercase mb-2 font-['Lilita_One']">HI, I'M "ECA"</h1>
                        <h2 class="text-4xl uppercase mb-7 font-['Lilita_One']">MASCOT OF 88STUDIO</h2>
                        <div class="context xl:h-[50vh] overflow-auto">
                            <p class="mb-5">Let me tell you a story.It’s not a romantic, sad, or happy story. This is the story of our journey, about what we do and love, and of course, about our lovely 88 Studio.</p>
                        <p class="mb-5">
                            Where should I start?</br>
                            A long time ago, a meteor crashed to Earth, and then… wiped out all the dinosaurs! Well, it’s not that long actually! Hehe.
                        </p>
                        <p class="mb-5">
                            Let’s be frank, our 88 Studio was established in 2017 under the name eightyeightdesign. That was when our design journey began! Since we love to play games, we decided to focus on game-related services. We started by creating graphic designs for streamers, including caricatures and mascot logos in our early years. Then, we found our love and passion for Twitch emotes and VTuber creations. And so, 88 Studio decided to create me, their lovely mascot!
                        </p>
                        <p class="mb-5">
                            We love supporting streamers with our lovely emotes, offering affordable options for their streams too. Of course! Our services going to beyond not just stuck making an emotes. We learning everyday and trying new things to give the best support in this streaming world. Now, we open service to create Vtuber Model and Rigging too, and there will be many more items available in our web-store! More to come! 

                        </p>
                        <p class="mb-5">
                            Oh oh, we also create adoptable model or ready-to-adopt model for anyone who wants to become a Vtuber and start streaming!  Let's support each other and feel free to share your ideas with us too.

                        </p>
                        <p class="mb-5">
                            Alright, that's all about our 88 studio! We can talk more about me again at other times! So, stay tuned! :*
                        </p>
                        <p class="mb-5">
                            Don’t forget to follow us on our social media so that you can see me every day! 
                        </p>
                        <p class="mb-5">
                            Big Hug from your lovely and cute Mascot, Eca
                        </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute z-20 xl:right-24 2xl:right-64 top-6 h-full pointer-events-none">
                <img class="h-full" src="{{ asset('images/aboutus-2.png') }}" />
            </div>
        </div>
        <x-footer></x-footer>
    </div>
</x-front-layout>