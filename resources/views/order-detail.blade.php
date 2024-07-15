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
                <span>Order Detail</span>      
            </h2>
        </div>

        <div class="container mx-auto py-8 px-3">
            <div class="flex flex-col gap-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-2">Invoice: {{ $order->id }}</h2>
                    <p class="text-gray-700 mb-2">Total Amount: @currency($order->total_price)</p>
                    <p class="text-gray-700 mb-4">Ordered At: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
