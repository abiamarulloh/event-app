<!-- Navigation Menu -->
<nav class="fixed bottom-0 left-0 right-0 bg-white shadow-md">
    <div class="flex justify-around items-end py-2">
        <!-- Jelajahi -->
        <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'text-green-500' : 'text-gray-300' }} flex flex-col items-center  gap-1">
            <span class="material-symbols-outlined">
                explore
            </span>
            <span class="text-xs">Jelajahi</span>
        </a>
        <!-- Acara -->
        <a href="{{ route('schedule') }}" class="{{ request()->is('schedule') ? 'text-green-500' : 'text-gray-300' }} flex flex-col items-center  gap-1">
            <span class="material-symbols-outlined">
                calendar_today
            </span>
            <span class="text-xs">Acara</span>
        </a>
        <!-- History -->
        <a href="{{ route('history') }}" class="{{ request()->is('history') ? 'text-green-500' : 'text-gray-300' }} flex flex-col items-center  gap-1">
            <span class="material-symbols-outlined">
                receipt_long
            </span>
            <span class="text-xs">Histori</span>
        </a>
        <!-- Profil -->
        <a href="{{ route('profile.edit') }}" class="{{ request()->is('profile') ? 'text-green-500' : 'text-gray-300' }} flex flex-col items-center  gap-1">
            <span class="material-symbols-outlined">
                manage_accounts
            </span>
            <span class="text-xs">Profil</span>
        </a>
    </div>
</nav>