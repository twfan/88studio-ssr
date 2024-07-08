<x-front-layout>
    <div class="flex flex-col">
        <x-sign-up-disc></x-sign-up-disc>
        <div class="flex flex-col relative items-center justify-center">
            <x-front-menu :user="$user ?? null"></x-front-menu>
            <div class="w-full h-screen bg-tos bg-no-repeat bg-center bg-cover flex flex-col justify-center content-center items-center">
                <div class="container relative w-full h-full mt-32">
                    <div class="absolute top-[22rem] left-64 w-[30%] max-h-[20rem] min-h-[20rem] h-[20rem] bg-white border-8 border-88-orange rounded-lg pb-3 pt-3 relative">
                        <button id="expandTos" class="absolute p-3 -top-4 -right-3 bg-gray-300 rounded-full hover:animate-pulse">
                            <i class="w-4 h-4" data-feather="maximize-2"></i>
                        </button>
                        <div class="content w-full h-full px-7 overflow-auto font-['Open_Sans']">
                            @if(!empty($tos->contents))
                                {!! $tos->contents !!}
                            @endif
                        </div>
                    </div>
                    <div class="absolute w-[75rem] left-52 top-0 pointer-events-none">
                        <img class="h-full" src="{{ asset('images/tos-assets-1.png') }}" />
                    </div>
                </div>
            </div>
        </div>
        <x-footer></x-footer>
    </div>

    <div id="modalOverlay" class="z-50 fixed top-0 left-0 right-0 bottom-0 hidden" style="background-color:rgba(0,0,0,0.5)">
        <div id="modal" class="rounded bg-gray-100 top-5 left-5 pb-5 mx-auto w-1/3 h-2/3 my-32 transition-all ease-in-out duration-300 translate-y-6 relative">
            <button id="closeBtn" class="p-3 absolute -top-3 -right-3 bg-gray-300 rounded-full shadow-sm hover:brightness-90 ease-in-out duration-300 transition-all">
                <i class="w-4 h-4" data-feather="x"></i>
            </button>
            <div class="flex flex-col overflow-auto">
                <div class="content p-7">
                    @if(!empty($tos->contents))
                        {!! $tos->contents !!}
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-front-layout>

<script>
    $('#expandTos').on('click', function () {
            $('#modalOverlay').show();
        })
        $('#closeBtn').on('click', function () {
            $('#modalOverlay').hide();
        })
</script>