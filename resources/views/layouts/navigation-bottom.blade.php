<!-- Navigation Menu -->
<nav class="fixed bottom-0 left-0 right-0 bg-white border-t-2 border-grey-50 max-w-md mx-auto">
    <div class="flex justify-around items-end py-2">
        <!-- Jelajahi -->
        <a href="{{ route('explore') }}"
            class="{{ request()->is('/') ? 'text-green-500' : 'text-gray-300' }} flex flex-col items-center  gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" 
                class="{{ request()->is('/') ? 'text-green-500' : 'text-gray-300' }}" 
                fill="currentColor">
                <path d="m260-260 300-140 140-300-300 140-140 300Zm220-180q-17 0-28.5-11.5T440-480q0-17 11.5-28.5T480-520q17 0 28.5 11.5T520-480q0 17-11.5 28.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
            </svg>
        
            <span class="text-xs">Jelajahi</span>
        </a>
        <!-- Acara -->
        <a href="{{ route('cart.index') }}"
            class="{{ request()->is('cart') ? 'text-green-500' : 'text-gray-300' }} flex flex-col items-center  gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"  class="{{ request()->is('cart') ? 'text-green-500' : 'text-gray-300' }}" 
                fill="currentColor"><path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>
            <span class="text-xs">Keranjang</span>
        </a>
        <!-- History -->
        <a href="{{ route('history') }}"
            class="{{ request()->is('history') || request()->routeIs('history.detail') ? 'text-green-500' : 'text-gray-300' }} flex flex-col items-center  gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" class="{{ request()->is('history') || request()->routeIs('history.detail') ? 'text-green-500' : 'text-gray-300' }}" 
                fill="currentColor"><path d="M240-80q-50 0-85-35t-35-85v-120h120v-560l60 60 60-60 60 60 60-60 60 60 60-60 60 60 60-60 60 60 60-60v680q0 50-35 85t-85 35H240Zm480-80q17 0 28.5-11.5T760-200v-560H320v440h360v120q0 17 11.5 28.5T720-160ZM360-600v-80h240v80H360Zm0 120v-80h240v80H360Zm320-120q-17 0-28.5-11.5T640-640q0-17 11.5-28.5T680-680q17 0 28.5 11.5T720-640q0 17-11.5 28.5T680-600Zm0 120q-17 0-28.5-11.5T640-520q0-17 11.5-28.5T680-560q17 0 28.5 11.5T720-520q0 17-11.5 28.5T680-480ZM240-160h360v-80H200v40q0 17 11.5 28.5T240-160Zm-40 0v-80 80Z"/></svg>
            <span class="text-xs">Histori</span>
        </a>
        <!-- Profil -->
        <a href="{{ route('profile.edit') }}"
            class="{{ request()->is('profile') ? 'text-green-500' : 'text-gray-300' }} flex flex-col items-center  gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" fill="currentColor" viewBox="0 -960 960 960" width="24px" class="{{ request()->is('profile') ? 'text-green-500' : 'text-gray-300' }}" ><path d="M400-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM80-160v-112q0-33 17-62t47-44q51-26 115-44t141-18h14q6 0 12 2-8 18-13.5 37.5T404-360h-4q-71 0-127.5 18T180-306q-9 5-14.5 14t-5.5 20v32h252q6 21 16 41.5t22 38.5H80Zm560 40-12-60q-12-5-22.5-10.5T584-204l-58 18-40-68 46-40q-2-14-2-26t2-26l-46-40 40-68 58 18q11-8 21.5-13.5T628-460l12-60h80l12 60q12 5 22.5 11t21.5 15l58-20 40 70-46 40q2 12 2 25t-2 25l46 40-40 68-58-18q-11 8-21.5 13.5T732-180l-12 60h-80Zm40-120q33 0 56.5-23.5T760-320q0-33-23.5-56.5T680-400q-33 0-56.5 23.5T600-320q0 33 23.5 56.5T680-240ZM400-560q33 0 56.5-23.5T480-640q0-33-23.5-56.5T400-720q-33 0-56.5 23.5T320-640q0 33 23.5 56.5T400-560Zm0-80Zm12 400Z"/></svg>
            <span class="text-xs">Profil</span>
        </a>
    </div>
</nav>
