<x-app-layout>
    <div class="sm:ml-64">
        <header class="bg-white light:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex gap-x-4">

                <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
                    {{ __('Detail') }}
                </h2>
            </div>
        </header>


        <div class="container mx-auto p-4">
            <h1 class="text-3xl font-bold mb-4">Withdrawal Details</h1>
    
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-100 px-6 py-3 border-b border-gray-200">
                    <h2 class="text-xl font-semibold">Withdrawal ID: {{ $withdrawal->id }}</h2>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Event Organizer</h3>
                        <p class="text-gray-700">Name: {{ $withdrawal->eventOrganizer->name }}</p>
                        <p class="text-gray-700">Email: {{ $withdrawal->eventOrganizer->email }}</p>
                    </div>
    
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Bank Account</h3>
                        <p class="text-gray-700">Bank Name: {{ $withdrawal->bankAccount->bank_name }}</p>
                        <p class="text-gray-700">Account Number: {{ $withdrawal->bankAccount->account_number }}</p>
                        <p class="text-gray-700">Account Holder: {{ $withdrawal->bankAccount->account_holder_name }}</p>
                    </div>
    
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold">Withdrawal Details</h3>
                        <p class="text-gray-700">Amount: @currency($withdrawal->amount)</p>
                        <p class="text-gray-700">Status: 
                            @if($withdrawal->status === 'pending')
                                <span class="text-yellow-600 font-semibold">{{ ucfirst($withdrawal->status) }}</span>
                            @elseif($withdrawal->status === 'approved')
                                <span class="text-green-600 font-semibold">{{ ucfirst($withdrawal->status) }}</span>
                            @elseif($withdrawal->status === 'rejected')
                                <span class="text-red-600 font-semibold">{{ ucfirst($withdrawal->status) }}</span>
                            @endif
                        </p>
                    </div>
    
                    @if($withdrawal->status === 'pending')
                        <div class="flex gap-4">
                            <form action="{{ route('withdrawals.update', $withdrawal) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">Approve</button>
                            </form>
    
                            <form action="{{ route('withdrawals.update', $withdrawal) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="text" name="reason" value="" required>
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Reject</button>
                            </form>
                        </div>
                    @endif
    
                    <a href="{{ route('withdrawals.index') }}" class="inline-block mt-4 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
