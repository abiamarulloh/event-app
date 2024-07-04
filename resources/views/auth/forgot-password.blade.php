<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 light:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button class="w-full px-4 bg-green-600 hover:bg-green-700 relative rounded-[15px] focus:bg-green-700 active:bg-green-900 light:active:bg-green-300">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>

    <p class="text-center mt-[20px] mb-[38px] font-regular text-base text-[#120D26]"><a class="text-green-700" href="{{ route('login') }}">Kembali</a></p>
</x-guest-layout>
