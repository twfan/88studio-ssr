<x-front-layout>
    <div class="bg-88-orange w-screen h-screen bg-logo bg-no-repeat bg-center bg-cover">
        <div class="flex flex-col h-full justify-center content-center items-center">
            <!-- Session Status -->
           <x-auth-session-status class="mb-4 bg-white px-3 py-2 rounded text-sm" :status="session('status')" />
           <form method="POST" action="{{ route('login') }}" class="flex flex-col w-1/3 relative">
            <div class="w-[45rem] absolute z-0 -top-52 left-96">
                <img class="w-full h-full" src="{{ asset('images/login-assets-2.png') }}" alt="">
            </div>
            <div class="w-52 absolute z-20 -top-24 -left-[9.5rem]">
                <img class="w-full h-full" src="{{ asset('images/login-assets-4.png') }}" alt="">
            </div>
            <div class="w-[41rem] absolute z-20 -top-[14.5rem] left-[28rem]">
                <img class="w-full h-full" src="{{ asset('images/login-assets-3.png') }}" alt="">
            </div>
            <div class="w-40 absolute z-20 -top-14 left-[22rem]">
                <img class="w-full h-full" src="{{ asset('images/login-assets-5.png') }}" alt="">
            </div>
            <div class="w-full z-10">
                <img class="w-full h-full" src="{{ asset('images/login-assets-1.webp') }}" alt="">
            </div>
               @csrf
            <div class="z-10 flex flex-col rounded-b-xl bg-white px-32 py-5 border-b-4 border-x-4 border-88-orange ">
                @if (!empty(session('backLink')))
                    <input type="hidden" name="backLink" value="{{ session('backLink') }}">
                @endif
               <!-- Email Address -->
               <div class="w-80">
                   <x-input-label for="email" :value="__('Email')" />
                   <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                   <x-input-error :messages="$errors->get('email')" class="mt-2" />
               </div>
   
               <!-- Password -->
               <div class="mt-4 w-80">
                   <x-input-label for="password" :value="__('Password')" />
   
                   <x-text-input id="password" class="block mt-1 w-full"
                                   type="password"
                                   name="password"
                                   required autocomplete="current-password" />
   
                   <x-input-error :messages="$errors->get('password')" class="mt-2" />
               </div>
               @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
              
   
               <div class="flex items-center justify-between mt-4 w-80">
                    <!-- Remember Me -->
                    <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
   
                   {{-- <x-primary-button class="ms-3">
                       {{ __('Log in') }}
                   </x-primary-button> --}}
                   <button type="submit" class="py-2 rounded bg-red-600 px-3 font-['Lilita_One'] text-white uppercase">Login</button>
               </div>
            </div>
           </form>

           <span class="text-2xl mt-2 font-['Lilita_One']">Or</span>
            <a class="text-2xl underline font-['Lilita_One']" href="{{ route('member.register') }}">
                Register your account
            </a>
        </div>
    </div>
</x-front-layout>



