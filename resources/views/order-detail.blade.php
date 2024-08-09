<x-app-layout>
    <x-slot name="header">
        <svg data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
            class="w-6 h-6 text-white dark:text-white cursor-pointer" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="black" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10" />
        </svg>
        <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
            {{ __('Order Detail') }}
        </h2>
    </x-slot>

    <div class="pb-12 max-w-md mx-auto shadow-md h-screen">
        <div class="flex justify-between items-center p-4 bg-white rounded-lg px-6">
            <h2 class="text-lg font-semibold flex gap-2 py-2">
                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-6 4h6m-6 4h6M6 3v18l2-2 2 2 2-2 2 2 2-2 2 2V3l-2 2-2-2-2 2-2-2-2 2-2-2Z"/>
                  </svg>
                <span>Detail Order</span>      
            </h2>
        </div>

        <div class="container mx-auto px-3 h-full overflow-auto pb-12">
            <div class="flex flex-col gap-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4"><b>ID Order</b> : {{ $order->unique_order_id }}</h2>
                    <p class="text-gray-700 mb-2"><b>Status Pembayaran</b> : <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ $order->latestTransaction->status }}</span></p>
                    <p class="text-gray-700 mb-2"><b>Status Kehadiran</b> :
                        {{ $order->status_attend === 'approved' ? 'Hadir' : 'Belum Hadir' }}
                    </p>
                    <p class="text-gray-700 mb-2"><b>Waktu Order</b> : {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                    <p class="text-gray-700 mb-2"><b>Nama Lengkap</b> : {{ $order->user->name }}</p>
                    <p class="text-gray-700 mb-2"><b>Email</b> : {{ $order->user->email }}</p>
                    
                    <hr>

                    <div class="flex flex-col gap-4 mt-4 py-5">
                            <div class="flex justify-between items-center">
                                <div class="flex gap-4">
                                    @if ($order->event->poster_image)
                                        <img src="{{ Storage::url('events/' . $order->event->poster_image) }}" class="w-16 h-16 object-cover rounded-lg"  height="400px" />
                                    @endif

                                    <div>
                                        <h3 class="text-lg font-semibold">{{ $order->event->title }}</h3>
                                        <p class="text-gray-700">Harga: 
                                            @if ($order->event->sponsorship_title && $order->event->fundraising_target)
                                                <span style="text-decoration: line-through">@currency($order->event->price)</span>
                                                @currency($order->event->sponsorship_target - ($order->event->price * $order->event->quota))
                                            @else
                                                @currency($order->event->price) 
                                            @endif
                                        </p>
                                        <p class="text-gray-700">Banyak: {{ $order->quantity }}</p>
                                    </div>
                                </div>
                                <p class="text-gray-700">@currency($order->total_price)</p>
                            </div>

                            {{-- <div class="flex justify-between items-center">
                                <div class="flex gap-4">
                                    <div>
                                        <h3 class="text-lg font-semibold">Kode Akses</h3>
                                        <p class="text-gray-700">Code: <b>{{ $order->event->unique_code }}</b></p>
                                    </div>
                                </div>
                            </div> --}}

                            <hr class="h-[2px]" />


                            @if ($order->status_attend === 'waiting')
                            <div class="my-3 w-full">
                                <h3 class="font-medium text-center mb-2">Scan QR Atau Klik Tombol Ajukan Bergabung untuk bergabung</h3>
                                <div class="mx-auto text-center flex justify-center">
                                    {!! $qrCode !!}
                                </div>
                            </div>
                            <hr class="h-[2px]" />

                            @endif


                            <div class="flex justify-start">
                                @if (!empty($requestApproval) && $requestApproval->status === 'pending')
                                    <div class="w-full">
                                        <span class="text-yellow-500">Status Kehadiran: Menunggu Persetujuan EO</span>
                                        <div class="flex items-center p-4 mt-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                            </svg>
                                            <div>
                                                <p class="text-sm">Mohon tunggu sampai event organizer, menyetujui permintaan bergabung anda!</p>
                                            </div>
                                        </div>
                                    </div>
                                @elseif (!empty($requestApproval) && $requestApproval->status === 'approved' )
                                    <div class="w-full">
                                        {{-- <span class="text-green-500">Status Kehadiran: Disetujui</span> --}}
                                        <div class="flex items-center p-4 mt-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                            </svg>
                                            <div>
                                                <p class="text-sm">Selamat bergabung dievent!</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                   <div>
                                        <form action="{{ route('event.request.approval') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="event_id" value="{{  $order->event->id }}">
                                            <input type="hidden" name="event_organizer_id" value="{{  $order->event->user_id }}">
                                            <input type="hidden" name="order_id" value="{{  $order->id }}">
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">Ajukan Bergabung</button>
                                        </form>

                                        <div class="flex items-center p-4 mt-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                            </svg>
                                            <div>
                                                <p class="text-sm">Kirim permintaan bergabung ke event untuk mengikuti event yang telah kamu pesan!</p>
                                            </div>
                                        </div>
                                   </div>
                                @endif
                            </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
