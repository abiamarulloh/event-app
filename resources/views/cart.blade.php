<x-app-layout>
    

    <x-slot name="header">
        <svg data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
            class="w-6 h-6 text-white dark:text-white cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="black" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10" />
        </svg>
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="max-w-md mx-auto shadow-md relative h-screen overflow-auto">
        {{-- Buat Flex --}}
        <div class="flex justify-between items-center p-4 bg-white shadow-md rounded-lg px-6">
            <a href="{{ route('explore') }}" class="text-green-500">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/>
                  </svg>
            </a>
            <h2 class="text-lg font-semibold flex gap-2">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                  </svg>
                <span>Keranjang</span>      
            </h2>
        </div>

        <div class="container mx-auto p-6 pb-20">
                <!-- Cart Item -->
                <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <ul>
                        <li>1. Hanya satu event per-transaksi. Hapus yang sudah ada untuk mendaftar yang lain.</li>
                        <li><hr></li>
                        <li>2. Tunggu event yang sudah didaftar selesai sebelum mendaftar yang sama.</li>
                    </ul>
                </div>

                @if($cartItems->isEmpty())
                    <div class="max-w-md flex flex-col items-center justify-center h-[400px]">
                        <p class="text-gray-600 text-center">Keranjang kosong.</p>
                    </div>
                @else

                @foreach($cartItems as $cartItem)
                    <a href="{{ route('event-register', $cartItem->event->slug) }}">
                        <div class="bg-white shadow-md rounded-lg p-4 mb-4 h-200">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div>
                                        <h2 class="text-lg font-semibold">{{ $cartItem->event->title }}</h2>
                                        <p class="text-sm text-gray-600 price">
                                            @if ($cartItem->event->sponsorship_title && $cartItem->event->fundraising_target)
                                                <span style="text-decoration: line-through">@currency($cartItem->event->price)</span>
                                                @currency($cartItem->event->sponsorship_target - ($cartItem->event->price * $cartItem->event->quota))
                                            @else
                                                @currency($cartItem->event->price) 
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778"/>
                                    </svg>

                                    <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-none border-none">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                    
                                {{-- <div class="flex items-center">
                                    <button class="text-gray-700 bg-gray-200 hover:bg-gray-300 p-2 rounded-l" onclick="decreaseQty(this, {{ $cartItem->id }}, {{ $cartItem->event->price }})">-</button>
                                    <input type="number" class="w-12 text-center border-0 qty" value="{{ $cartItem->quantity }}" readonly>
                                    <button class="text-gray-700 bg-gray-200 hover:bg-gray-300 p-2 rounded-r" onclick="increaseQty(this, {{ $cartItem->id }}, {{ $cartItem->event->price }})">+</button>
                                </div> --}}
                            </div>
                        </div>
                    </a>
                @endforeach
            
                <!-- Additional Fees -->
                @if ($additionalFee)
                <div class="bg-white shadow-md rounded-lg p-4 mb-6">
                    <h2 class="text-lg font-semibold mb-4">Biaya Tambahan</h2>
                    <div class="flex justify-between items-center mb-2">
                        <span>Tax</span>
                        <span id="tax">{{ $additionalFee->fee }}%</span>
                    </div>
                    {{-- <div class="flex justify-between items-center mb-2">
                        <span>Biaya Layanan</span>
                        <span id="service-charge">Rp6.000</span>
                    </div> --}}
                </div>
                @endif

                @if($cartItems->first()->event->fundraising_title && $cartItems->first()->event->fundraising_target)
                    <div class="bg-white shadow-md rounded-lg p-4 mb-6">
                        <h2 class="text-lg font-semibold mb-4">Donasi</h2>

                        @if ($cartItems->first()->event->fundraising_image)
                            <div class="mt-5">
                                <img src="{{  Storage::url('fundraising/' . $cartItems->first()->event->fundraising_image) }}" alt="{{ $cartItems->first()->event->fundraising_image }}" class="w-full h-60 object-cover rounded-lg" />
                            </div>
                        @endif

                        @if($cartItems->first()->event->fundraising_target)
                            <div class="flex justify-between items-center mt-2">
                                <span class="font-medium">Target Donasi</span>
                                <span id="fundraising-target">@currency($cartItems->first()->event->fundraising_target)</span>
                            </div>
                        @endif

                        <div class="flex flex-col justify-between items-center mt-4 gap-3">
                            <span class="font-medium">
                                {{ $cartItems->first()->event->fundraising_title }}
                            </span>
                            <input type="number" id="donation" class="w-full text-center border-gray-400" value="0" placeholder="1000">
                        </div>
                    </div>
                @endif
                
            @endif
        </div>
    
        @if($cartItems->isEmpty() === false)
            <!-- Total dan Bayar (Fixed Bottom) -->
            <div class="fixed bottom-0 left-0 right-0 bg-white border shadow-md p-4 flex justify-between items-center max-w-md mx-auto">
                <div class="flex flex-col">
                    <p class="text-md font-semibold">Total</p>
                    <p id="total-price">@currency($total)</p>
                </div>
                
                @if ($total == 0) 
                    <form action="{{ route('orders.store_zero_amount') }}" method="POST">
                        @csrf
                        <input type="hidden" id="event_id_payload" name="event_id" value="{{ $cartItems->first()->event->id }}">
                        <input type="hidden" id="total_price_payload" name="total_price" value="{{ $total }}">
                        
                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex gap-2" type="submit">
                            <p>Bayar</p>
                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 12A2.5 2.5 0 0 1 21 9.5V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v2.5a2.5 2.5 0 0 1 0 5V17a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2.5a2.5 2.5 0 0 1-2.5-2.5Z"/>
                            </svg>
                        </button>
                    </form>
                @else
                    {{-- Data --}}
                    <input type="hidden" id="event_id_payload"  value="{{ $cartItems->first()->event->id }}">
                    <input type="hidden" id="total_price_payload"  value="{{ $total }}">
                    
                    <button  id="pay-button" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 flex gap-2">
                        <p>Bayar</p>

                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 12A2.5 2.5 0 0 1 21 9.5V7a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v2.5a2.5 2.5 0 0 1 0 5V17a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2.5a2.5 2.5 0 0 1-2.5-2.5Z"/>
                        </svg>
                    </button>
                @endif
            </div>
        @endif
    
        <script>
            function updateTotalPrice() {
                let totalPrice = 0;
                const cartItems = document.querySelectorAll('.bg-white.shadow-md.rounded-lg.p-4.mb-4.h-200'); // Sesuaikan dengan selector yang benar untuk item keranjang

                cartItems.forEach(item => {
                    // const quantity = parseInt(item.querySelector('input[type="number"]')?.value);
                    const price = parseFloat(item.querySelector('.price').textContent.replace(/[^0-9-,]+/g,""));
                    totalPrice += 1 * price;
                });

                const tax = document.getElementById('tax')?.innerHTML; // Misalnya nilai pajak
                if (tax) {
                    totalPrice += Number(totalPrice * tax);
                }

                totalPrice = Number(totalPrice);

                const donation = parseInt(document.getElementById('donation').value);

                if (donation > 0) {
                    totalPrice += donation;
                }

                document.getElementById('total-price').innerText = `Rp${totalPrice.toLocaleString()}`;
                document.getElementById('total_price_payload').value = totalPrice;
            }

            document.getElementById('donation')?.addEventListener('keyup', function() {
                console.log('Donation changed', this.value);

                updateTotalPrice();
            });
        </script>

   
        @auth 
            @if (Auth::user()->role_id == 3)
                <form id="submit_form" method="post" action="/transactions/notification">
                    @csrf
                    <input type="hidden" name="json" id="json_callback">
                </form>
        
                <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

                <script>
                    document.getElementById('pay-button')?.addEventListener('click', function () {
                        // Ambil data dari form atau cart

                        const eventId = parseInt(document.getElementById('event_id_payload').value)
                        const totalPrice = parseInt(document.getElementById('total_price_payload').value)

                        const data = {
                            'event_id': parseInt(eventId),
                            'quantity': 1,
                            'total_price': parseInt(totalPrice)
                        };
                
                        fetch("{{ config('app.url') }}/orders", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.snap_token) {
                                snap.pay(data.snap_token, {
                                    onSuccess: function(result){
                                        send_response_to_form(result);
                                    },
                                    onPending: function(result){
                                        send_response_to_form(result);
                                    },
                                    onError: function(result){
                                        send_response_to_form(result);
                                    },
                                    onClose: function(){
                                        alert('You closed the popup without finishing the payment');
                                    }
                                });
                            } else {
                                alert('Pembayaran gagal');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    });

                    function send_response_to_form(result){
                        document.getElementById('json_callback').value = JSON.stringify(result);
                        document.getElementById('submit_form').submit();
                    }
                </script>
            @endif
        @endauth
    </div>
</x-app-layout>
