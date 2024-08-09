<x-app-layout>
    <div class="sm:ml-64">
        <header class="bg-white light:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex gap-x-4">

                <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
                    {{ __('Daftar Hadir Peserta') }}
                </h2>
            </div>
        </header>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-2 flex justify-between items-start">
                <div class="bg-white sm:block light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg md:flex justify-between flex-start w-full">
                    <div class="p-6 text-gray-900 light:text-gray-100">
                        {{ __('Daftar Hadir/List') }}
                    </div>

                    <div>
                        <div class="flex gap-2 justify-center">
                            <!-- Button to show scanner -->
                            <button id="toggleScannerBtn" class="xs:w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Show QR Code Scanner
                            </button>

                            <!-- Button to toggle full-screen mode -->
                            <button id="toggleFullscreenBtn" class="xs:w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 lg:ml-4 hidden">
                                Go Full Screen
                            </button>
                        </div>
     
                         <style>
                             /* Animasi garis pemindai */
                             .scanner-line {
                                 position: absolute;
                                 top: 0;
                                 left: 0;
                                 width: 100%;
                                 height: 4px;
                                 background: rgba(255, 0, 0, 0.7);
                                 border-radius: 2px;
                                 animation: moveLine 1.5s linear infinite;
                             }
                     
                             @keyframes moveLine {
                                 0% {
                                     top: 0;
                                 }
                                 50% {
                                     top: calc(100% - 4px);
                                 }
                                 100% {
                                     top: 0;
                                 }
                             }
                         </style>
     
                         <!-- Section for QR Code scanner, initially hidden -->
                        <div id="scannerSection" class="mt-4 relative mx-auto flex justify-center hidden">
                            <div id="reader" class="w-[400px] h-[300px] bg-gray-200 rounded-lg relative overflow-hidden">
                            </div>
                            <div class="scanner-line"></div> <!-- Animated line -->
                            <form id="qrForm" action="{{ route('qr.scan') }}" method="POST" style="display: none;">
                                @csrf
                                <input type="hidden" name="qr_code" id="qrCodeInput">
                                <input type="hidden" value="{{$eventId}}" name="event_id" id="eventId">
                            </form>
                        </div>
                         <script src="https://unpkg.com/html5-qrcode" type="text/javascript"> </script>
                         <script>
                             document.addEventListener("DOMContentLoaded", function () {
                                 var html5QrCode = new Html5Qrcode("reader");
                                 var scannerSection = document.getElementById("scannerSection");
                                 var toggleScannerBtn = document.getElementById("toggleScannerBtn");
                                 var toggleFullscreenBtn = document.getElementById("toggleFullscreenBtn");
                                 var scannerVisible = false;

                                 console.log(html5QrCode)

                                // Check if BarcodeDetector is supported
                                if ('BarcodeDetector' in window) {

                                    // Show the scanner section if a fragment is set
                                    if (window.location.search.includes('fragment=scannerSection')) {
                                        scannerSection.classList.remove("hidden");
                                        html5QrCode.start({ facingMode: "environment" }, { fps: 10 }, onScanSuccess, onScanError)
                                            .catch(err => {
                                                console.error(`Start failed: ${err}`);
                                            });
                                    }
                        
                                // Toggle scanner visibility
                                    toggleScannerBtn.addEventListener("click", function() {
                                        scannerVisible = !scannerVisible;

                                        if (scannerVisible) {
                                            scannerSection.classList.remove("hidden");
                                            toggleScannerBtn.textContent = "Hide QR Code Scanner";
                                            toggleFullscreenBtn.classList.remove("hidden");

                                            // Start the QR code scanner
                                            html5QrCode.start({ facingMode: "environment" }, { fps: 10 }, onScanSuccess, onScanError)
                                                .catch(err => {
                                                    console.error(`Start failed: ${err}`);
                                                });

                                        } else {
                                            scannerSection.classList.add("hidden");
                                            toggleScannerBtn.textContent = "Show QR Code Scanner";
                                            toggleFullscreenBtn.classList.add("hidden");

                                            // Stop the QR code scanner
                                            html5QrCode.stop().catch(err => {
                                                console.error(`Stop failed: ${err}`);
                                            });
                                        }
                                    });

                                    // Toggle full-screen mode
                                    toggleFullscreenBtn.addEventListener("click", function() {
                                        if (!document.fullscreenElement) {
                                            scannerSection.requestFullscreen();
                                            toggleFullscreenBtn.textContent = "Go Full Screen";
                                        } else {
                                            document.exitFullscreen();
                                            toggleFullscreenBtn.textContent = "Exit Full Screen";
                                        }
                                    });
                                }

                     
                                 function onScanSuccess(decodedText, decodedResult) {
                                     // Handle the result here
                                     console.log(`Code matched = ${decodedText}`);
                     
                                     // Set the QR code value to the hidden input field and submit the form
                                     document.getElementById('qrCodeInput').value = decodedText;
                                     document.getElementById('qrForm').submit();

                                     
                                     // Stop scanning
                                     html5QrCode.stop().catch(err => {
                                         console.log(`Stop failed: ${err}`);
                                     });
                                 }
                     
                                 function onScanError(errorMessage) {
                                     // Handle scan error here
                                     console.warn(`QR Code scan error: ${errorMessage}`);
                                 }
                             });
                         </script>
                    </div>
                </div>

            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Lengkap
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Order Unique ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eventRequest as $eventReq)
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $eventReq->customer->name }}
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $eventReq->customer->email }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{  $eventReq->order->unique_order_id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($eventReq->status === 'pending')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                                {{  $eventReq->status }}
                                            </span>
                                        @elseif ($eventReq->status === 'approved')
                                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                {{  $eventReq->status }}
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                {{  $eventReq->status }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($eventReq->status !== 'approved')
                                            <form action="{{ route('event.request.approve', $eventReq->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                    Terima
                                                </button>
                                            </form>
                                        @elseif($eventReq->status !== 'rejected')
                                            <form action="{{ route('event.request.reject', $eventReq->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="text-white bg-gradient-to-br from-red-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                    Tolak
                                                </button>
                                            </form>
                                        @elseif($eventReq->status !== 'pending')
                                            <form action="{{ route('event.request.pending', $eventReq->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="text-white bg-gradient-to-br from-yellow-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                                    Pending
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                           @endforeach

                           @if ($eventRequest->isEmpty())
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td colspan="5" class="px-6 py-4 text-center">
                                        No data available
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
