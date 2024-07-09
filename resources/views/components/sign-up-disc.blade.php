<div class="flex items-center w-full bg-black h-20 text-white text-2xl text-center justify-center">
    @if(auth()->check()) 
    <div class="flex font-['Lilita_One'] uppercase">
        <span>Hi {{auth()->user()->name}}, <span class="text-88-orange">How's your day</span></span>
    </div> 
    @else
        <a href="{{route('member.login')}}">
            <div class="flex font-['Lilita_One']">
                <span>sign up now</span>
                <button class="ml-2 border-2 border-solid border-yellow-400 rounded-full px-3">50% off</button>
            </div> 
        </a>
    @endif
</div>