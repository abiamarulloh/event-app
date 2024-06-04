<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h1 class="font-medium text-2xl mb-[19px]">{{ __('Masuk') }}</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="relative">
            <x-text-input id="email" class="w-full pl-10 pr-4 py-4 border border-gray-300 rounded-[12px]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.8287 8.30603L11.9187 11.4541C11.1788 12.0342 10.1415 12.0342 9.40156 11.4541L5.45801 8.30603" stroke="#807A7A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M6.3138 3.20837H14.9561C16.2022 3.22235 17.3882 3.74914 18.2379 4.66606C19.0877 5.58298 19.5269 6.80998 19.4534 8.06132V14.0452C19.5269 15.2965 19.0877 16.5235 18.2379 17.4405C17.3882 18.3574 16.2022 18.8842 14.9561 18.8981H6.3138C3.63722 18.8981 1.83325 16.7207 1.83325 14.0452V8.06132C1.83325 5.38587 3.63722 3.20837 6.3138 3.20837Z" stroke="#807A7A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <x-text-input id="password" class="block mt-1 w-full pl-10 pr-4 py-4 border border-gray-300 rounded-[12px]" type="password" name="password" required autocomplete="current-password" placeholder="Kata sandi" />
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.0548 8.6605V6.69242C15.0548 4.38884 13.1866 2.52067 10.883 2.52067C8.57943 2.51059 6.70393 4.36959 6.69385 6.67409V6.69242V8.6605" stroke="#807A7A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.3762 19.4788H7.372C5.4525 19.4788 3.896 17.9232 3.896 16.0028V12.0712C3.896 10.1508 5.4525 8.59521 7.372 8.59521H14.3762C16.2957 8.59521 17.8522 10.1508 17.8522 12.0712V16.0028C17.8522 17.9232 16.2957 19.4788 14.3762 19.4788Z" stroke="#807A7A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M10.8743 13.0192V15.0551" stroke="#807A7A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="toggle" class="flex items-center cursor-pointer">
                <!-- toggle -->
                <div class="relative">
                    <!-- input -->
                    <input id="toggle" type="checkbox" class="sr-only peer" />
                    <!-- line -->
                    <div class="w-10 h-4 bg-gray-400 rounded-full peer-checked:bg-green-500 transition-colors"></div>
                    <!-- dot -->
                    <div class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition-transform peer-checked:translate-x-full"></div>
                </div>
                <!-- label -->
                <div class="ml-3 text-gray-700 font-medium text-sm">{{ __('Ingat saya') }}</div>
            </label>

            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 light:text-gray-400 hover:text-gray-900 light:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 light:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                {{ __('Lupa Kata sandi?') }}
            </a>
            @endif
        </div>

        <div class="d-block mt-4 md:w-auto xs:w-[271px] mx-auto">
            <x-primary-button class="w-full px-4 bg-green-600 hover:bg-green-700 relative rounded-[15px]">
                <span class="text-center">
                    {{ __('Masuk') }}
                </span>

                <div class="absolute top-1/2 transform -translate-y-1/2 right-4">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="15" cy="15" r="15" fill="#0B872D" />
                        <path d="M8 14.5C8 14.0513 8.36377 13.6875 8.8125 13.6875H17.8718L13.9109 9.72666C13.5872 9.40293 13.5919 8.87665 13.9213 8.55868C14.2425 8.24855 14.7531 8.25305 15.0688 8.5688L20.9356 14.4356C20.9712 14.4712 20.9712 14.5288 20.9356 14.5644L15.07 20.43C14.7552 20.7448 14.2448 20.7448 13.93 20.43C13.6162 20.1162 13.6151 19.6078 13.9275 19.2926L17.8718 15.3125H8.8125C8.36377 15.3125 8 14.9487 8 14.5Z" fill="white" />
                    </svg>
                </div>
            </x-primary-button>
           
            <p class="text-center my-[24px] font-medium text-base text-[#9D9898]">Atau</p>

            <x-primary-button type="button" class="w-full flex items-center justify-center bg-white border border-[#EDE5E5] text-gray-700 py-2 rounded-lg hover:bg-white focus:bg-white active:bg-white h-[56px] rounded-[15px]">
                <img src="https://lh3.googleusercontent.com/COxitqgJr1sJnIDe8-jiKhxDx1FrYbtRHKJ9z_hELisAlapwE9LUPh6fcXIfb5vwpbMl4xl9H9TRFPc5NOO8Sb3VSgIBrfRYvW6cUA" alt="Google Logo" class="h-5 mr-2">
                <p class="text-[#120D26]">
                    {{ __('Masuk dengan Google') }} 
                </p>
            </x-primary-button>

            <p class="text-center mt-[93px] mb-[38px] font-regular text-base text-[#120D26]">Belum punya akun? <a class="text-green-700" href="{{ route('register') }}">Daftar Dulu Yuk</a></p>
        </div>
    </form>
</x-guest-layout>