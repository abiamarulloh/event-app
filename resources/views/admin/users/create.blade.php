<x-app-layout>
    <div class="sm:ml-64">
        <header class="bg-white light:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex gap-x-4">

                <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
                    {{ __('Buat Anggota') }}
                </h2>
            </div>
        </header>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-lg my-4">
            <h2 class="text-2xl font-semibold mb-4">Buat sebuah Anggota</h2>
            @if ($errors->any())
                <div class="bg-red-500 text-white p-2 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium mb-2">Nama Lengkap</label>
                    <input type="text" name="name" id="title"
                        class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-2">Email</label>
                    <input type="text" name="email" id="email"
                        class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium mb-2">Password</label>
                    <input type="text" name="password" id="password"
                        class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium mb-2">Confirm password</label>
                    <input type="text" name="password_confirmation" id="password_confirmation"
                        class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium mb-2">Role</label>
                    <select id="role" name="role_id"
                        class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Role</option>

                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>


                <!-- Add Event Button -->
                <div>
                    <button type="submit"
                        class="w-64 p-2.5 bg-blue-600 text-white rounded hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                        Buat Anggota
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
