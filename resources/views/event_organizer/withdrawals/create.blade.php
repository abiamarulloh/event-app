<x-app-layout>
    <div class="sm:ml-64">
        <header class="bg-white light:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex gap-x-4">

                <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
                    {{ __('Buat Penarikan Dana') }}
                </h2>
            </div>
        </header>

        <div class="py-6 max-w-7xl w-[500px] sm:px-6 lg:px-8 rounded-lg shadow-md my-4">
            <h2 class="text-2xl font-semibold mb-4">Buat penarikan dana</h2>

            @if ($errors->any())
                <div class="bg-red-500 text-white p-2 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-4 text-red-600">
                    {{ session('error') }}
                </div>
            @endif
            

            <form action="{{ route('withdrawals.store') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" id="amount" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="bank_account_id" class="form-label">Bank Account</label>
                    <select name="bank_account_id" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" id="bank_account_id" required>
                        @foreach($bankAccounts as $bankAccount)
                            <option value="{{ $bankAccount->id }}">{{ $bankAccount->account_holder_name }} - {{ $bankAccount->bank_name }} ({{ $bankAccount->account_number }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-700">Buat permintaan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
