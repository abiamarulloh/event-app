<x-app-layout>
    <div class="sm:ml-64">
        <header class="bg-white light:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex gap-x-4">

                <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
                    {{ __('Edit Biaya Tambahan') }}
                </h2>
            </div>
        </header>

        <div class="py-6 w-[400px] sm:px-6 lg:px-8 rounded-lg shadow-md my-4">
            <h2 class="text-2xl font-semibold mb-4">Edit Biaya Tambahan</h2>

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

            <form action="{{ route('additional-fees.update', $additionalFee->id) }}" method="POST">
                @csrf
                @method('PUT')
        
                <div class="mb-3">
                    <label for="type" class="form-label">Tipe</label>
                    <select name="type" id="type" class="form-select w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                        <option value="">Pilih tipe</option>
                        <option value="tax" {{ $additionalFee->type == 'tax' ? 'selected' : '' }}>Tax</option>
                        {{-- <option value="charge" {{ $additionalFee->type == 'charge' ? 'selected' : '' }}>Charge</option> --}}
                    </select>
                </div>
        
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $additionalFee->name) }}" id="name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('name') }}" required>
                </div>
        
                <div class="mb-3">
                    <label for="fee" class="form-label">Jumlah</label>
                    <input type="number" step="0.01" name="fee" id="fee" value="{{ old('fee', $additionalFee->fee) }}"  class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('fee') }}" required>
                </div>
        
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-700">Perbarui</button>
            </form>
        </div>
    </div>
</x-app-layout>
