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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-2">
                <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex justify-between">
                    <div class="p-6 text-gray-900 light:text-gray-100">
                        {{ __('Daftar Hadir/List') }}
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
                                    Unique Code
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
                                        {{-- {{  $eventReq->unique_code }} --}}
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
                                    <td colspan="3" class="px-6 py-4 text-center">
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
