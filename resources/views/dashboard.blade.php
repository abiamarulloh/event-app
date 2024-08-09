<x-app-layout>
    <div class="sm:ml-64 pb-5">
        <header class="bg-white light:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex gap-x-4">
                
                    <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
                        {{ __('Dashboard') }}
                    </h2>
            </div>
        </header>

        <div class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-lg mt-6 flex items-center gap-4">
            <h1 class="text-[35px] font-semibold text-gray-900">Hi, {{ Auth::user()->name }}</h1>
        </div>

        @if (Auth::user()->role_id === 1)
            <div class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-lg mt-6 flex items-center gap-4">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-gray-900 {{ request()->routeIs('user.index') ? 'text-gray-400 text-white group-hover:text-white' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                    <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                </svg>
                <h1 class="text-[25px] font-semibold text-gray-900">Analitik User</h1>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-lg">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 py-8">
                        <div class="flex items-center justify-center gap-3">
                            <h2 class="text-gray-900 font-bold text-[30px]">{{ $usersQty }}</h2>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Total User</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Total user yang terdaftar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-lg mt-6 flex items-center gap-4">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-gray-900 {{ request()->routeIs('event.index') ? 'text-gray-400 text-white group-hover:text-white' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
             </svg>
            <h1 class="text-[25px] font-semibold text-gray-900">Analitik Acara</h1>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 py-8">
                    <div class="flex items-center justify-center gap-3">
                        <h2 class="text-gray-900 font-bold text-[30px]">{{ $eventDraftQty }}</h2>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Draft </h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total acara yang masih di draft</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 py-8">
                    <div class="flex items-center justify-center gap-3">
                        <h2 class="text-gray-900 font-bold text-[30px]">{{ $eventPublishedQty }}</h2>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">On-Going</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Acara yang masih on-going</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 py-8">
                    <div class="flex items-center justify-center gap-3">
                        <h2 class="text-gray-900 font-bold text-[30px]">{{ $eventClosedQty }}</h2>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Selesai</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Acara yang telah selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-lg mt-6 flex items-center gap-4">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-900 transition duration-75 group-hover:text-gray-900 {{ request()->routeIs('event.index') ? 'text-gray-400 text-white group-hover:text-white' : '' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
             </svg>
            <h1 class="text-[25px] font-semibold text-gray-900">Analitik Transaksi</h1>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 py-8">
                    <div class="flex items-center justify-center gap-3">
                        <h2 class="text-gray-900 font-bold text-[30px]">{{ $transactionQty }}</h2>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-white"> Transaksi </h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Transaksi Sukses</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

     </div>
</x-app-layout>
