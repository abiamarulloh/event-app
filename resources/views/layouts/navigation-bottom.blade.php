<!-- Navigation Menu -->
<nav class="fixed bottom-0 left-0 right-0 bg-white border-t-2 border-grey-50 max-w-md mx-auto">
    <div class="flex justify-around items-end py-2">
        <!-- Jelajahi -->
        <a href="{{ route('explore') }}" class="{{ request()->is('/') ? 'text-green-500' : 'text-gray-300' }} flex flex-col items-center  gap-1">
            <span class="material-symbols-outlined">
                explore
            </span>
            <span class="text-xs">Jelajahi</span>
        </a>
        <!-- Acara -->
        <a href="{{ route('cart.index') }}" class="{{ request()->is('cart') ? 'text-green-500' : 'text-gray-300' }} flex flex-col items-center  gap-1">
            <span class="material-symbols-outlined">
                shopping_cart
            </span>
            <span class="text-xs">Keranjang</span>
        </a>
        <!-- History -->
        <a href="{{ route('history') }}" class="{{ request()->is('history') || request()->routeIs('history.detail') ? 'text-green-500' : 'text-gray-300' }} flex flex-col items-center  gap-1">
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