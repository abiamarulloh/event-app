<x-app-layout>
    <div class="overflow-x-hidden max-w-md mx-auto h-screen shadow-md relative">
        <div class="max-w-7xl mx-auto absolute left-0 right-0 top-0 w-full">
            <div class="bg-white opacity-40 absolute left-0 right-0 top-0 w-full h-20"></div>

            <div class="shadow-sm flex items-center px-4 absolute z-index-1">
                <a href="{{ route('explore') }}">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.6167 11H4.58337" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11 17.4167L4.58337 11L11 4.58334" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Detail Event') }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 dark:border-gray-700">
            <img src="{{ $event->poster_image ? Storage::url('events/' . $event->poster_image) : 'https://i.pinimg.com/564x/82/7b/02/827b0246f4a0094b6798afeb02a64f0e.jpg' }}" alt="{{ $event->poster_image }}" height="400px" />
            
            <div class="p-5 mb-20">
                <div class="flex justify-between items-center gap-2 relative">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $event->title }}</h5>
                    
                    @if ($event->status === 'published')
                        <span class="bg-green-100 text-green-800 text-md absolute top-[-70px] right-0 font-medium me-2 px-2 py-3 rounded dark:bg-green-900 dark:text-green-300">
                            @if ($event->price == 0)
                                Gratis
                            @else
                                @currency($event->price) 
                            @endif
                        </span>
                    @else
                        <span class="bg-yellow-100 text-yellow-800 text-md absolute top-[-70px] right-0 font-medium me-2 px-2 py-3 rounded dark:bg-yellow-900 dark:text-yellow-300">
                            Terjual habis

                            (
                                @if ($event->price == 0)
                                    Gratis
                                @else
                                    @currency($event->price) 
                                @endif
                            )
                        </span>
                    @endif
                </div>

                

                <div class="flex items-center gap-2 text-gray-500 mt-5">
                    <div>
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.1" width="48" height="48" rx="12" fill="#5669FF"/>
                            <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M20.1838 15.3519H27.8621V13.5642H20.1838V15.3519ZM18.4371 13.6376V13.6465C17.8377 13.701 17.2447 13.82 16.6679 13.9991V13.9925C16.6507 13.9997 16.6346 14.0052 16.6191 14.0105C16.5987 14.0175 16.5795 14.0241 16.5606 14.0336C16.5145 14.0447 16.4695 14.0614 16.4266 14.0826C16.3001 14.1237 16.1736 14.1727 16.0545 14.2227C16.0229 14.235 15.9913 14.2492 15.9596 14.2633C15.928 14.2775 15.8964 14.2917 15.8648 14.304C15.8213 14.3245 15.776 14.3471 15.7307 14.3696C15.6854 14.3921 15.6401 14.4146 15.5967 14.4352L15.3822 14.5587C15.3426 14.5789 15.3059 14.6027 15.2684 14.6269C15.2461 14.6413 15.2236 14.6558 15.2 14.67C14.8772 14.878 14.5781 15.1216 14.3079 15.3986L14.2918 15.4153C14.2563 15.4567 14.2209 15.4968 14.1861 15.5364C14.1272 15.6033 14.0697 15.6686 14.0151 15.7357L13.999 15.7513C13.122 16.9617 12.6823 18.4535 12.7585 19.9654V20.4449H14.4901V19.961C14.4901 17.8539 15.1614 16.5423 16.655 15.8703C17.2254 15.6289 17.828 15.4799 18.4414 15.4253H18.4574V13.6454L18.4371 13.6376ZM33.9975 15.7291L34.005 15.7446C34.881 16.9561 35.3185 18.4491 35.2413 19.961V20.4449H33.5107V19.9487C33.5471 19.0565 33.3681 18.1687 32.9885 17.3666C32.6239 16.6802 32.0406 16.1474 31.3362 15.8581C30.7754 15.6167 30.1814 15.4665 29.5755 15.4131V13.642C30.1749 13.6976 30.7679 13.8156 31.3458 13.9947V13.9858C31.3783 14.0005 31.4031 14.0093 31.4456 14.0243L31.453 14.0269C31.4728 14.0339 31.4912 14.0409 31.5094 14.0478C31.5347 14.0574 31.5596 14.0668 31.5871 14.0759C31.7056 14.1148 31.8165 14.1606 31.9306 14.2078L31.9506 14.2161C32.0032 14.2346 32.0528 14.2575 32.0975 14.2781C32.1119 14.2848 32.1259 14.2913 32.1393 14.2973C32.2336 14.3384 32.3301 14.3874 32.4073 14.4286C32.4588 14.4553 32.509 14.4839 32.556 14.5107C32.5814 14.5252 32.606 14.5392 32.6293 14.552C32.6677 14.5733 32.7011 14.596 32.7332 14.6178C32.7567 14.6337 32.7795 14.6492 32.803 14.6633C33.1268 14.8724 33.4292 15.1172 33.7026 15.392L33.7123 15.4087C33.813 15.5099 33.9085 15.6167 33.9975 15.7291Z" fill="#0CA035"/>
                            <path d="M29.625 12.3962V16.3356C29.625 16.832 29.2222 17.234 28.725 17.234C28.2277 17.234 27.825 16.832 27.825 16.3356V12.4052C27.8205 11.9088 28.221 11.5034 28.7182 11.5C29.2155 11.4967 29.6216 11.8953 29.625 12.3917V12.3962Z" fill="#0CA035"/>
                            <path d="M20.175 12.4105V16.3401C20.175 16.8386 19.7718 17.2428 19.2744 17.2428C18.7771 17.2428 18.375 16.8386 18.375 16.3401V12.4105C18.375 11.9119 18.7771 11.5089 19.2744 11.5089C19.7718 11.5089 20.175 11.9119 20.175 12.4105Z" fill="#0CA035"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.75 30.1377V20.4449H35.25V30.1377C35.25 34.3645 32.8895 36.5 28.2114 36.5H19.7779C15.1105 36.5 12.75 34.3645 12.75 30.1377ZM17.8251 25.8335C17.8251 26.4199 18.2865 26.8957 18.8552 26.8957C19.4346 26.8957 19.8959 26.4088 19.8852 25.8224C19.8852 25.236 19.4238 24.7602 18.8659 24.7602H18.8552C18.2865 24.7602 17.8251 25.247 17.8251 25.8335ZM22.9646 25.8335C22.9646 26.4199 23.4367 26.8957 24.0054 26.8957C24.574 26.8957 25.0354 26.4199 25.0354 25.8224C25.0354 25.247 24.574 24.7712 24.0054 24.7602H23.9946C23.426 24.7712 22.9646 25.247 22.9646 25.8335ZM29.1449 26.8957C28.5762 26.8957 28.1148 26.4199 28.1148 25.8335C28.1148 25.247 28.5655 24.7713 29.1449 24.7713C29.7135 24.7713 30.1749 25.247 30.1749 25.8335C30.1749 26.4199 29.7135 26.8957 29.1449 26.8957ZM29.1449 31.4323C28.5762 31.4323 28.1148 30.9565 28.1041 30.3701C28.1041 29.7836 28.5655 29.3078 29.1341 29.3078H29.1449C29.7135 29.3078 30.1749 29.7836 30.1749 30.3701C30.1749 30.9565 29.7135 31.4323 29.1449 31.4323ZM24.0054 31.4323C23.4367 31.4323 22.9646 30.9565 22.9646 30.3701C22.9646 29.7836 23.426 29.3078 23.9946 29.2968H24.0054C24.574 29.3078 25.0247 29.7836 25.0354 30.359C25.0354 30.9565 24.574 31.4323 24.0054 31.4323ZM18.8552 31.4323C18.2865 31.4323 17.8251 30.9565 17.8251 30.3701C17.8144 29.7836 18.2758 29.2968 18.8552 29.2968C19.4238 29.2968 19.8852 29.7726 19.8852 30.359C19.8852 30.9454 19.4238 31.4323 18.8552 31.4323Z" fill="#0CA035"/>
                        </svg>
                    </div>

                    <div>
                        <p>{{ \Carbon\Carbon::parse($event->start_date)->format('l, d F Y') }}</p>
                        <p>{{ \Carbon\Carbon::parse($event->end_date)->format('l, d F Y')  }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 text-gray-500 mt-5">
                    <div>
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.12" width="48" height="48" rx="12" fill="#5669FF"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.6645 12.671C22.3956 11.0841 25.7525 11.1118 28.458 12.7436C31.1368 14.4086 32.765 17.3802 32.7498 20.5768C32.6874 23.7524 30.9416 26.7375 28.7593 29.0451C27.4998 30.383 26.0908 31.566 24.5611 32.57C24.4035 32.6611 24.2309 32.7221 24.0519 32.75C23.8795 32.7427 23.7116 32.6917 23.5634 32.6018C21.228 31.0932 19.1792 29.1675 17.5154 26.9175C16.1232 25.0392 15.3323 22.77 15.25 20.418C15.2482 17.2153 16.9335 14.2578 19.6645 12.671ZM21.2427 21.7434C21.7021 22.876 22.7865 23.6147 23.9895 23.6147C24.7776 23.6204 25.5352 23.3047 26.0935 22.738C26.6518 22.1713 26.9644 21.4007 26.9616 20.5979C26.9658 19.3725 26.2443 18.2653 25.1341 17.7934C24.0238 17.3215 22.7438 17.5779 21.8916 18.4429C21.0395 19.3079 20.7833 20.6108 21.2427 21.7434Z" fill="#0CA035"/>
                            <path opacity="0.4" d="M24 36.5C27.4518 36.5 30.25 35.9404 30.25 35.25C30.25 34.5596 27.4518 34 24 34C20.5482 34 17.75 34.5596 17.75 35.25C17.75 35.9404 20.5482 36.5 24 36.5Z" fill="#0CA035"/>
                        </svg>
                    </div>

                    <div>
                        <p>{{ $event->location  }}</p>
                    </div>
                </div>

                <div class="flex items-start gap-2 text-gray-500 mt-5">
                    <div class="bg-[#eeefff] p-3 rounded-lg">
                        <svg class="w-6 h-6 text-[#0CA035]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                        </svg>
                    </div>

                    <div>
                        <p class="font-bold">Pembicara</p>

                        @php
                            $speakers = explode('|', $event->speaker);
                        @endphp

                        @foreach ($speakers as $speaker)
                            <div class="flex gap-2 items-start">
                                <div>
                                    <svg class="w-6 h-6 text-[#0CA035]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                                      </svg>
                                </div>
                                <div>
                                    <p> {{ $speaker }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center gap-2 text-gray-500 mt-5">
                    <div class="bg-[#eeefff] p-3 rounded-lg">
                        <svg class="w-6 h-6 text-[#0CA035]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                          </svg>
                    </div>

                    <div>
                        <p>{{ $event->user->name  }}</p>
                        <p class="font-bold">Penyelenggara</p>
                    </div>
                </div>

                <h3 class="text-gray-800 font-bold mt-5">Tentang Acara </h3>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 text-justify">{{ $event->description }}</p>
            
                @if ($event->fundraising_title && $event->fundraising_target)
                    <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <div>
                         {{ $event->fundraising_title }} 
                         <br> 
                       
                         <div class="flex items-center gap-2">
                           <div>
                            Target: 
                           </div>
                           <p class="flex items-center gap-2">
                                <svg class="w-6 h-6 text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12 14a3 3 0 0 1 3-3h4a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-4a3 3 0 0 1-3-3Zm3-1a1 1 0 1 0 0 2h4v-2h-4Z" clip-rule="evenodd"/>
                                    <path fill-rule="evenodd" d="M12.293 3.293a1 1 0 0 1 1.414 0L16.414 6h-2.828l-1.293-1.293a1 1 0 0 1 0-1.414ZM12.414 6 9.707 3.293a1 1 0 0 0-1.414 0L5.586 6h6.828ZM4.586 7l-.056.055A2 2 0 0 0 3 9v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2h-4a5 5 0 0 1 0-10h4a2 2 0 0 0-1.53-1.945L17.414 7H4.586Z" clip-rule="evenodd"/>
                                </svg>
                                <b> @currency($event->fundraising_target) </b>
                            </p>
                         </div>
                      
                        </div>
                    </div>
                @endif
                
                @if ($event->fundraising_image)
                    <div class="mt-5">
                        <img src="{{  Storage::url('fundraising/' . $event->fundraising_image) }}" alt="{{ $event->fundraising_image }}" class="w-full h-60 object-cover rounded-lg" />
                    </div>
                @endif

                @auth 
                    @if (Auth::user()->role_id == 3 && $event->status === 'published'  && !$alreadyMakeTransaction)
                        <div tabindex="-1" class="fixed bottom-0 start-0 z-50 flex justify-between w-full p-6 border-b border-gray-200">
                            <div class="max-w-md w-full px-0 sm:px-8 mx-auto">
                                @if ($alreadyAddedCart) 
                                    <form action="{{ route('cart.index') }}" method="GET">

                                        <button class="flex justify-center  gap-3 h-py-6 items-center text-white bg-[#9CA3AF] hover:bg-[#9CA3AF] focus:ring-4 focus:outline-none focus:ring-[#9CA3AF] font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">
                                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4"/>
                                            </svg>
                                            
                                            Buka Keranjang
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('cart.add', $event->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex justify-center  gap-3 h-py-6 items-center text-white bg-[#0CA035] hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">
                                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4"/>
                                            </svg>
                                            
                                            Tambah ke keranjang
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>

</x-app-layout>
