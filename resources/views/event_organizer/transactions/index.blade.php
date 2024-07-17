<x-app-layout>
    <div class="sm:ml-64">
        <header class="bg-white light:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex gap-x-4">

                <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
                    {{ __('Daftar Transaksi') }}
                </h2>
            </div>
        </header>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-2">
                <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex justify-between">
                    <div class="p-6 text-gray-900 light:text-gray-100">
                        {{ __('Daftar Transaksi/List') }}
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Order ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nama Lengkap
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Judul Acara
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Total Harga
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                       <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                            {{ $transaction->order_id }}
                                        </span>
                                    </th>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $transaction->order->user->name  }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $transaction->order->user->email  }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $transaction->order->event->title  }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @currency($transaction->order->total_price)
                                    </td>
                                </tr>
                           @endforeach

                           @if ($transactions->isEmpty())
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
