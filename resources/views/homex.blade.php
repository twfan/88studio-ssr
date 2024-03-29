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
        <div class="flex flex-col relative items-center justify-center mb-10">
            <x-front-menu :user="$user ?? null"></x-front-menu>
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
        <div class="container mx-auto relative" style="height: 350px;width:1000px;">
            <div class="my-slider">
                <img src="/images/discount.jpeg" class="w-full h-full"/>
                <img src="/images/discount.jpeg" class="w-full h-full"/>
                <img src="/images/discount.jpeg" class="w-full h-full"/>
                <img src="/images/discount.jpeg" class="w-full h-full"/>
            </div>
            <div class="absolute top-[50%] w-full">
                <div class="nav-slider flex justify-between w-full relative z-30">
                    <button class="prev px-3 py-3 bg-slate-800 text-white rounded-full bg-black absolute -left-5" type="button">
                        <i data-feather="chevron-left"></i>
                    </button>
                    <button class="next px-3 py-3 bg-slate-800 text-white rounded-full bg-black absolute -right-5" type="button">
                        <i data-feather="chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-center w-3/4 container mx-auto mt-14 h-96">
            <h1 class="uppercase text-3xl mb-6">Popular YCH Comission</h1>
            <div class="flex justify-between">
                <div class="flex flex-col text-center">
                    <div class="w-48 h-48 flex items-center content-center justify-center relative">
                        <div class="w-48 h-48 rounded-full bg-88-cream flex items-center justify-center content-center absolute z-0">
                        </div>
                        <div class="w-32 h-32 flex">
                            <div class="container mx-auto relative mb-20" style="height: 350px;width:1000px;">
                                <div class="my-slider-static-emote">
                                    <img src="/images/comission/static-emote/ych-static-01.png"/>
                                    <img src="/images/comission/static-emote/ych-static-02.png"/>
                                    <img src="/images/comission/static-emote/ych-static-03.png"/>
                                    <img src="/images/comission/static-emote/ych-static-04.png"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="uppercase mt-3">Static emote</span>
                </div>
                <div class="flex flex-col text-center">
                    <div class="w-48 h-48 flex items-center content-center justify-center relative">
                        <div class="w-48 h-48 rounded-full bg-88-cream flex items-center justify-center content-center absolute z-0">
                        </div>
                        <div class="w-32 h-32 flex">
                            <div class="container mx-auto relative mb-20" style="height: 350px;width:1000px;">
                                <div class="my-slider-animated-emote">
                                    <img src="/images/comission/animated-emote/AN16.webp"/>
                                    <img src="/images/comission/animated-emote/AN17.webp"/>
                                    <img src="/images/comission/animated-emote/AN18.webp"/>
                                    <img src="/images/comission/animated-emote/AN19.webp"/>
                                    <img src="/images/comission/animated-emote/AN20.webp"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="uppercase mt-3">Animated emote</span>
                </div>
                <div class="flex flex-col text-center">
                    <div class="w-48 h-48 flex items-center content-center justify-center relative">
                        <div class="w-48 h-48 rounded-full bg-88-cream flex items-center justify-center content-center absolute z-0">
                        </div>
                        <div class="w-32 h-32 flex">
                            <div class="container mx-auto relative mb-20" style="height: 350px;width:1000px;">
                                <div class="my-slider-dance-collection">
                                    <img src="/images/comission/dance-collection/dance-01.png"/>
                                    <img src="/images/comission/dance-collection/dance-02.png"/>
                                    <img src="/images/comission/dance-collection/dance-03.png"/>
                                    <img src="/images/comission/dance-collection/dance-04.png"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="uppercase mt-3">Dance collection</span>
                </div>
                <div class="flex flex-col text-center">
                    <div class="w-48 h-48 flex items-center content-center justify-center relative">
                        <div class="w-48 h-48 rounded-full bg-88-cream flex items-center justify-center content-center absolute z-0">
                        </div>
                        <div class="w-32 h-32 flex">
                            <div class="container mx-auto relative mb-20" style="height: 350px;width:1000px;">
                                <div class="my-slider-lick-collection">
                                    <img src="/images/comission/lick-collection/lick-01.png"/>
                                    <img src="/images/comission/lick-collection/lick-02.png"/>
                                    <img src="/images/comission/lick-collection/lick-03.png"/>
                                    <img src="/images/comission/lick-collection/lick-04.png"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="uppercase mt-3">Lick colelction</span>
                </div>
                
                <div class="flex flex-col text-center">
                    <div class="w-48 h-48 flex items-center content-center justify-center relative">
                        <div class="w-48 h-48 rounded-full bg-88-cream flex items-center justify-center content-center absolute z-0">
                        </div>
                        <div class="w-32 h-32 flex">
                            <div class="container mx-auto relative mb-20" style="height: 350px;width:1000px;">
                                <div class="my-slider-rave">
                                    <img src="/images/comission/rave/rave-01.png"/>
                                    <img src="/images/comission/rave/rave-02.png"/>
                                    <img src="/images/comission/rave/rave-03.png"/>
                                    <img src="/images/comission/rave/rave-04.png"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="uppercase mt-3">Rave collection</span>
                </div>
                <div class="flex flex-col text-center">
                    <a href="#">
                        <div class="w-48">
                            <img class="w-full" src="/images/comission/rave/rave-01.png" />
                        </div>
                    </a>
                    <span class="uppercase mt-3">Panel</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-center w-3/4 container mx-auto mt-16  ">
            <h1 class="uppercase text-3xl mb-6">Ready to Adopt Vtuber</h1>
        </div>
        <div class="flex flex-col justify-center relative">
            <div class="grid divide-x-4 grid-cols-3 text-center h-[55rem]">
                <div class="h-full w-full bg-88-orange bg-trans-vtuber relative bg-no-repeat bg-top bg-cover flex flex-col gap-3">
                    <div class="h-[80%] w-full mt-20 absolute z-20 flex flex-col">
                        <div class="h-full w-full relative">
                            <div class="mx-auto h-full w-3/5 rounded-t-full flex flex-col border-black border-x-4 border-t-4 px-3 pt-3">
                                <div class="bg-black w-full h-full rounded-t-full">
                                    <div class="flex flex-col text-center text-white pt-10">
                                        <span>Nama</span>
                                    </div>
                                </div>
                            </div>
                            <div class="grow w-full absolute bottom-0">
                                <img class="w-full object-scale-down" src='images/vtuber.png' />
                            </div>
                        </div>
                        <div class="border-black border-x-4 border-b-4 rounded-b-2xl p-3 mx-auto w-3/5">
                            <div class="bg-black text-white text-center rounded-full">
                                <span class="uppercase text-2xl">Show Detail</span>
                            </div>
                        </div>
                    </div>
                    <div class="h-full w-full absolute top-0 z-10 bg-gradient-to-b from-transparent to-88-orange ...">
                    </div>
                </div>
                <div class="h-full w-full bg-88-orange bg-trans-vtuber relative bg-no-repeat bg-top bg-cover flex flex-col gap-3">
                    <div class="h-[80%] w-full mt-20 absolute z-20 flex flex-col">
                        <div class="h-full w-full relative">
                            <div class="mx-auto h-full w-3/5 rounded-t-full flex flex-col border-black border-x-4 border-t-4 px-3 pt-3">
                                <div class="bg-black w-full h-full rounded-t-full">
                                    <div class="flex flex-col text-center text-white pt-10">
                                        <span>Nama</span>
                                    </div>
                                </div>
                            </div>
                            <div class="grow w-full absolute bottom-0">
                                <img class="w-full object-scale-down" src='images/vtuber.png' />
                            </div>
                        </div>
                        <div class="border-black border-x-4 border-b-4 rounded-b-2xl p-3 mx-auto w-3/5">
                            <div class="bg-black text-white text-center rounded-full">
                                <span class="uppercase text-2xl">Show Detail</span>
                            </div>
                        </div>
                    </div>
                    <div class="h-full w-full absolute top-0 z-10 bg-gradient-to-b from-transparent to-88-orange ...">
                    </div>
                </div>
                <div class="h-full w-full bg-88-orange bg-trans-vtuber relative bg-no-repeat bg-top bg-cover flex flex-col gap-3">
                    <div class="h-[80%] w-full mt-20 absolute z-20 flex flex-col">
                        <div class="h-full w-full relative">
                            <div class="mx-auto h-full w-3/5 rounded-t-full flex flex-col border-black border-x-4 border-t-4 px-3 pt-3">
                                <div class="bg-black w-full h-full rounded-t-full">
                                    <div class="flex flex-col text-center text-white pt-10">
                                        <span>Nama</span>
                                    </div>
                                </div>
                            </div>
                            <div class="grow w-full absolute bottom-0">
                                <img class="w-full object-scale-down" src='images/vtuber.png' />
                            </div>
                        </div>
                        <div class="border-black border-x-4 border-b-4 rounded-b-2xl p-3 mx-auto w-3/5">
                            <div class="bg-black text-white text-center rounded-full">
                                <span class="uppercase text-2xl">Show Detail</span>
                            </div>
                        </div>
                    </div>
                    <div class="h-full w-full absolute top-0 z-10 bg-gradient-to-b from-transparent to-88-orange ...">
                    </div>
                </div>
            </div>
            <div class="w-full absolute z-30 -bottom-24">
                <img src='images/asset-03.png' />
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
    </div>
</x-front-layout>