<Head>
    <title>EightyEight</title>
    <link rel="icon" type="image/x-icon" href="icon-01.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
</Head>
<body>
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
            <div class="flex w-3/4 items-center absolute z-10 top-5 bg-white rounded-full px-7">
                <div class="w-96">
                    <Link :href="route('homepage')">
                         <ApplicationLogo class="block h-16 w-full" />
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
                    <div @click="toggleUserDropdown" v-if="user" class="cursor-pointer">
                        <div class="bg-red flex flex-row gap-1 z-50 mx-4 text-center justify-center items-center uppercase">
                            <i data-feather="user"></i><span>{{user.name}}</span>
                        </div>
                        <DropdownMenu :isOpen="isUserDropdownOpen" @update:isOpen="isUserDropdownOpen = $event" @logout="handleLogout" />
                    </div>
                    <Link v-if="!user" :href="route('member.login')">
                        <div class="bg-red z-50 mx-4 text-center justify-center flex flex-row gap-1 items-center uppercase">
                            <i data-feather="user"></i><span>Login</span>
                        </div>
                    </Link>
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
        <div class="mt-24 flex flex-col justify-center w-3/4 container mx-auto relative">
            <carousel ref="carouselDiscount" :items-to-show="1" :wrap-around="true">
              <slide v-for="slide in 10" :key="slide">
                <img :src="`/images/discount.jpeg`" />
              </slide>
            </carousel>
            <div class="flex absolute items-center justify-between w-full h-full">
                <div class="relative">
                    <div class="absolute -left-5">
                        <button @click="prevDiscount" class="w-full h-full bg-slate-800 text-white rounded-full">
                            <i class="w-10 h-10" data-feather="chevron-left"></i>
                        </button>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -left-5">
                        <button @click="nextDiscount" class="w-full h-full bg-slate-800 text-white rounded-full">
                            <i class="w-10 h-10" data-feather="chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-center w-3/4 container mx-auto mt-14 h-96">
            <h1 class="uppercase text-3xl mb-6">Popular YCH Comission</h1>
            <div class="flex justify-between">
                <div class="flex flex-col text-center">
                    <Link :href="route('ych-comission')">
                        <div class="w-48 h-48 flex items-center content-center justify-center relative">
                            <div class="w-48 h-48 rounded-full bg-88-cream flex items-center justify-center content-center absolute z-0">
                            </div>
                            <div class="w-32 h-32 flex">
                                <carousel class="h-full" :autoplay="3000" :wrap-around="true" :transition="1000" :items-to-show="1">
                                    <slide v-for="(item, index) in stringArrayImage" :key="index">
                                        <img class="" :src="`/images/comission/static-emote/${item}`" />
                                    </slide>
                                </carousel>
                            </div>
                        </div>
                    </Link>
                    <span class="uppercase mt-3">Static emote</span>
                </div>  
                <div class="flex flex-col text-center">
                    <a href="#">
                        <div class="w-48 h-48 flex items-center content-center justify-center relative">
                            <div class="w-48 h-48 rounded-full bg-88-cream flex items-center justify-center content-center absolute z-0">
                            </div>
                            <div class="w-32 h-32 flex">
                                <carousel class="h-full" :autoplay="3000" :wrap-around="true" :transition="1000" :items-to-show="1">
                                    <slide v-for="(item, index) in stringArrayImageAnimated" :key="index">
                                        <img class="" :src="`/images/comission/animated-emote/${item}`" />
                                    </slide>
                                </carousel>
                            </div>
                        </div>
                    </a>
                    <span class="uppercase mt-3">animated emote</span>
                </div>
                <div class="flex flex-col text-center">
                    <a href="#">
                        <div class="w-48 h-48 flex items-center content-center justify-center relative">
                            <div class="w-48 h-48 rounded-full bg-88-cream flex items-center justify-center content-center absolute z-0">
                            </div>
                            <div class="w-32 h-32 flex">
                                <carousel class="h-full" :autoplay="3000" :wrap-around="true" :transition="1000" :items-to-show="1">
                                    <slide v-for="(item, index) in stringArrayImageDance" :key="index">
                                        <img class="" :src="`/images/comission/dance-collection/${item}`" />
                                    </slide>
                                </carousel>
                            </div>
                        </div>
                    </a>
                    <span class="uppercase mt-3">dance collection</span>
                </div>
                <div class="flex flex-col text-center">
                    <a href="#">
                        <div class="w-48 h-48 flex items-center content-center justify-center relative">
                            <div class="w-48 h-48 rounded-full bg-88-cream flex items-center justify-center content-center absolute z-0">
                            </div>
                            <div class="w-32 h-32 flex">
                                <carousel class="h-full" :autoplay="3000" :wrap-around="true" :transition="1000" :items-to-show="1">
                                    <slide v-for="(item, index) in stringArrayImageLick" :key="index">
                                        <img class="" :src="`/images/comission/lick-collection/${item}`" />
                                    </slide>
                                </carousel>
                            </div>
                        </div>
                    </a>
                    <span class="uppercase mt-3">lick collection</span>
                </div>
                <div class="flex flex-col text-center">
                    <a href="#">
                        <div class="w-48 h-48 flex items-center content-center justify-center relative">
                            <div class="w-48 h-48 rounded-full bg-88-cream flex items-center justify-center content-center absolute z-0">
                            </div>
                            <div class="w-32 h-32 flex">
                                <carousel class="h-full" :autoplay="3000" :wrap-around="true" :transition="1000" :items-to-show="1">
                                    <slide v-for="(item, index) in stringArrayImageRave" :key="index">
                                        <img class="" :src="`/images/comission/rave/${item}`" />
                                    </slide>
                                </carousel>
                            </div>
                        </div>
                    </a>
                    <span class="uppercase mt-3">rave collection</span>
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
                    <ApplicationLogo />
                </div>
                <div class="flex flex-row">

                </div>
            </div>
        </div>
    </div>
</body>