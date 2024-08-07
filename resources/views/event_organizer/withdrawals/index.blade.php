<x-app-layout>
    <div class="sm:ml-64">
        <header class="bg-white light:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex gap-x-4">

                <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
                    {{ __('Daftar Penarikan Dana') }}
                </h2>
            </div>
        </header>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-2">
                <div class="bg-white light:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex justify-between">
                    <div class="p-6 text-gray-900 light:text-gray-100">
                        {{ __('Daftar Penarikan dana/List') }}
                    </div>

                    @if ( Auth::user()->role_id == 2)
                        <div class="p-6 text-gray-900 light:text-gray-100">
                            <a href="{{ route('withdrawals.create') }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buat pengajuan</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-4 bg-white px-2">
                    {{-- <h3 class="text-xl font-semibold">Total Balance: {{ number_format($totalBalance, 2) }}</h3>
                    <h3 class="text-xl font-semibold">Balance After Disbursements: {{ number_format($balanceAfterDisbursements, 2) }}</h3> --}}
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alasan</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bank</th>

                                @if ( Auth::user()->role_id == 1)
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($withdrawals as $withdrawal)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $withdrawal->id }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">@currency($withdrawal->amount)</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @php
                                            $currentColorByStatus = 'yellow';
                                            if ($withdrawal->status === 'approved') {
                                                $currentColorByStatus = 'green';
                                            } else if ($withdrawal->status === 'rejected') {
                                                $currentColorByStatus = 'red';
                                            }
                                        @endphp

                                        <span class="bg-{{$currentColorByStatus}}-100 text-{{$currentColorByStatus}}-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-{{$currentColorByStatus}}-900 dark:text-{{$currentColorByStatus}}-300">
                                            {{ $withdrawal->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $withdrawal->reason }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $withdrawal->bankAccount->bank_name }}</td>
                                    @if(Auth::user()->role_id == 1)
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a href="{{ route('withdrawals.show', $withdrawal) }}" class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 m-2">View</a>

                                            <form action="{{ route('withdrawals.update', $withdrawal) }}" method="POST" class="d-inline m-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Approve</button>
                                            </form>
                                            <form action="{{ route('withdrawals.update', $withdrawal) }}" method="POST" class="d-inline m-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Reject</button>
                                            </form>
                                            <form action="{{ route('withdrawals.update', $withdrawal) }}" method="POST" class="d-inline m-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="pending">
                                                <button type="submit" class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Pending</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                            @if ($withdrawals->isEmpty())
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <td colspan="7" class="px-6 py-4 text-center">
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
