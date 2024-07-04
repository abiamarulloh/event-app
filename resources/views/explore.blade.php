<x-app-layout>
     <div class="bg-[#0CA035] min-h-44 rounded-b-[33px] relative">
        <div class="flex flex-col">
            <div class="w-full rounded-lg overflow-hidden flex items-center justify-between px-6 pt-4">
                <svg data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" class="w-6 h-6 text-white dark:text-white cursor-pointer" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10" />
                </svg>

                <div class="px-4 py-2 text-white text-center mx-auto cursor-pointer">
                    <div class="flex items-center justify-center">
                        <h3 class="text-xs font-regular">
                            Current Location
                        </h3>
                        <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m8 10 4 4 4-4" />
                        </svg>
                    </div>

                    <p class="text-sm font-medium">{{ $currentUserInfo->cityName }}, {{ $currentUserInfo->regionName }}</p>
                </div>

                <button type="button"
                    class="relative inline-flex items-center p-3 text-sm font-medium text-center text-white bg-green-200 rounded-full bg-opacity-50 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5.365V3m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175 0 .593 0 1.292-.538 1.292H5.538C5 18 5 17.301 5 16.708c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 12 5.365ZM8.733 18c.094.852.306 1.54.944 2.112a3.48 3.48 0 0 0 4.646 0c.638-.572 1.236-1.26 1.33-2.112h-6.92Z" />
                    </svg>

                    <span class="sr-only">Notifications</span>
                    <div
                        class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                        20</div>
                </button>
            </div>

            <form class="w-full mx-auto px-6 mt-3">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-white border placeholder:text-white border-0 rounded-lg focus:ring-green-500 focus:border-green-500  bg-[#0CA035]"
                        placeholder="Search Event..." required />
                </div>
            </form>

            <div class="mt-4 w-full flex space-x-3  overflow-x-auto  absolute bottom-[-15px]">
                <button
                    class="px-4 py-2 bg-blue-500 text-white font-medium rounded-full shadow-sm hover:bg-blue-700 flex items-center gap-x-1.5">
                    <span class="material-symbols-outlined">
                    sports_soccer
                    </span>
                    Olahraga
                </button>
                <button
                    class="px-4 py-2 bg-green-300 text-white font-medium rounded-full shadow-sm hover:bg-green-400 flex items-center gap-x-1.5">
                    <span class="material-symbols-outlined">
                        music_note
                        </span>
                    Konser
                </button>
                <button
                    class="px-4 py-2 bg-purple-500 text-white font-medium rounded-full shadow-sm hover:bg-purple-700 flex items-center gap-x-1.5">
                    <span class="material-symbols-outlined">
                    restaurant
                    </span>
                    Makanan
                </button>
                <button
                    class="px-4 py-2 bg-indigo-500 text-white font-medium rounded-full shadow-sm hover:bg-indigo-700 flex items-center gap-x-1.5">
                    <span class="material-symbols-outlined">
                        festival
                        </span>
                    Festival
                </button>
                <button
                    class="px-4 py-2 bg-pink-500 text-white font-medium rounded-full shadow-sm hover:bg-pink-700 flex items-center gap-x-1.5">
                    <span class="material-symbols-outlined">
                        groups
                    </span>

                    Webinar
                </button>
            </div>
        </div>
    </div>
    
    <div class="my-[46px] px-4 ">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Acara Mendatang</h2>
            <a href="#" class="text-sm font-medium text-green-500 dark:text-green-300">Lihat Semua</a>
        </div>

        <div class="overflow-x-auto w-full py-2 mb-4">
            <div class="flex gap-4">
                <div class="bg-white min-w-[237px] dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1527269534026-c86f4009eace?q=80&w=1925&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Event Image"
                        class="w-full h-44 object-cover object-center p-2 rounded-3xl" />

                    <div class="flex flex-col pb-3 pl-3.5 pr-3.5 items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            TechXpo: Jelajahi Dunia Teknologi Masa Depan
                        </h3>
                        

                        <div class="w-full flex items-center justify-start gap-2 mt-4">
                            <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z" clip-rule="evenodd"/>
                                </svg>
                                    
                            <p class="text-sm font-medium text-gray-400 dark:text-white ml-2">
                                Cibadak, Lebak banten
                            </p> 
                        </div>
                    </div>
                </div>

                <div class="bg-white min-w-[237px] dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1527269534026-c86f4009eace?q=80&w=1925&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Event Image"
                        class="w-full h-44 object-cover object-center p-2 rounded-3xl" />
                        
                    <div class="flex flex-col pb-3 pl-3.5 pr-3.5 items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            TechXpo: Jelajahi Dunia Teknologi Masa Depan
                        </h3>
                        

                        <div class="w-full flex items-center justify-start gap-2 mt-4">
                            <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z" clip-rule="evenodd"/>
                                </svg>
                                    
                            <p class="text-sm font-medium text-gray-400 dark:text-white ml-2">
                                Cibadak, Lebak banten
                            </p> 
                        </div>
                    </div>
                </div>

                <div class="bg-white min-w-[237px] dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1527269534026-c86f4009eace?q=80&w=1925&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Event Image"
                        class="w-full h-44 object-cover object-center p-2 rounded-3xl" />
                        
                    <div class="flex flex-col pb-3 pl-3.5 pr-3.5 items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            TechXpo: Jelajahi Dunia Teknologi Masa Depan
                        </h3>
                        

                        <div class="w-full flex items-center justify-start gap-2 mt-4">
                            <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z" clip-rule="evenodd"/>
                                </svg>
                                    
                            <p class="text-sm font-medium text-gray-400 dark:text-white ml-2">
                                Cibadak, Lebak banten
                            </p> 
                        </div>
                    </div>
                </div>

                <div class="bg-white min-w-[237px] dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1527269534026-c86f4009eace?q=80&w=1925&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Event Image"
                        class="w-full h-44 object-cover object-center p-2 rounded-3xl" />
                        
                    <div class="flex flex-col pb-3 pl-3.5 pr-3.5 items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            TechXpo: Jelajahi Dunia Teknologi Masa Depan
                        </h3>
                        

                        <div class="w-full flex items-center justify-start gap-2 mt-4">
                            <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z" clip-rule="evenodd"/>
                                </svg>
                                    
                            <p class="text-sm font-medium text-gray-400 dark:text-white ml-2">
                                Cibadak, Lebak banten
                            </p> 
                        </div>
                    </div>
                </div>

                <div class="bg-white min-w-[237px] dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1527269534026-c86f4009eace?q=80&w=1925&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Event Image"
                        class="w-full h-44 object-cover object-center p-2 rounded-3xl" />
                        
                    <div class="flex flex-col pb-3 pl-3.5 pr-3.5 items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            TechXpo: Jelajahi Dunia Teknologi Masa Depan
                        </h3>
                        

                        <div class="w-full flex items-center justify-start gap-2 mt-4">
                            <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z" clip-rule="evenodd"/>
                                </svg>
                                    
                            <p class="text-sm font-medium text-gray-400 dark:text-white ml-2">
                                Cibadak, Lebak banten
                            </p> 
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</x-app-layout>

