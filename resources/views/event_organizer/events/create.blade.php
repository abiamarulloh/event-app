<x-app-layout>
    <div class="sm:ml-64">
        <header class="bg-white light:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex gap-x-4">

                <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
                    {{ __('Buat Acara') }}
                </h2>
            </div>
        </header>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-lg shadow-md my-4">
                <h2 class="text-2xl font-semibold mb-4">Buat sebuah acara</h2>

                @if ($errors->any())
                    <div class="bg-red-500 text-white p-2 mb-4 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium mb-2">Judul Acara</label>
                        <input type="text" id="title" name="title" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Select Date -->
                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="start-date" class="block text-sm font-medium mb-2">Waktu Mulai</label>
                            <input type="datetime-local" id="start-date" name="start_date"
                                class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="end-date" class="block text-sm font-medium mb-2">Waktu Akhir</label>
                            <input type="datetime-local" id="end-date" name="end_date"
                                class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="reminder-type" class="block text-sm font-medium mb-2">Kategori</label>
                            <select id="reminder-type" name="category_id"
                                class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">

                                <option value="">Pilih Kategori</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if ($isAdmin)
                            <div>
                                <label for="reminder-type" class="block text-sm font-medium mb-2">User</label>
                                <select id="reminder-type" name="user_id" 
                                    class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">

                                    <option value="">Pilih User</option>

                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->role_id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="user_id" value="2">
                        @endif
                    </div>

                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="reminder-type" class="block text-sm font-medium mb-2">Status</label>
                            <select id="reminder-type" name="status" 
                                class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">

                                <option value="">Pilih Status Event</option>

                                <option value="draft">Draft</option>
                                <option value="published">Publised</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium mb-2">Tempat / Apps</label>
                            <input type="text" id="location" name="location" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium mb-2">Deskripsi</label>
                        <textarea id="description" rows="4"
                             name="description"
                            class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Buat deskripsi tentang acara mu..."></textarea>
                    </div>

                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="terms_and_conditions" class="block text-sm font-medium mb-2">Peraturan dan Persyaratan</label>
                            <textarea id="terms_and_conditions" rows="4"
                            name="terms_and_conditions"
                           class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Peraturan dan persyaratan pada event mu..."></textarea>
                        </div>

                        <div>
                            <label for="agenda" class="block text-sm font-medium mb-2">Agenda</label>
                            <textarea id="agenda" rows="4"
                            name="agenda"
                           class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Jadwalkan event mu dengan rinci..."></textarea>
                        </div>

                       
                    </div>

                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="speaker" class="block text-sm font-medium mb-2">Pembicara</label>
                            <input type="text" id="speaker" name="speaker" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            @php 
                                $unique_id = uniqid();
                                $link = 'https://event-app.test/event-register/' . $unique_id;
                            @endphp
                            <label for="link_registration" class="block text-sm font-medium mb-2">Link Registration</label>
                            <input type="text" value="{{$link}}" readonly id="link_registration" name="link_registration" class="w-full border-0 p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium mb-2">Harga</label>
                            <input type="number" id="price" name="price" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="quota" class="block text-sm font-medium mb-2">Kuota Peserta</label>
                            <input type="number" id="quota" name="quota" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Reminder -->
                    {{-- <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="reminder-type" class="block text-sm font-medium mb-2">Reminder</label>
                            <select id="reminder-type"
                                class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                                <option>Email</option>
                                <!-- Add other options here -->
                            </select>
                        </div>
                        <div>
                            <label for="reminder-time" class="block text-sm font-medium mb-2">Time</label>
                            <input type="number" id="reminder-time"
                                class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500"
                                value="1">
                        </div>
                    </div> --}}

                    <div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  name="poster_image" id="file_input" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG.</p>
                        </div>
                    </div>

                    <!-- Add Event Button -->
                    <div class="mt-5">
                        <button type="submit"
                            class="w-64 p-2.5 bg-blue-600 text-white rounded hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                            Buat Acara
                        </button>
                    </div>
                </form>
        </div>
    </div>
</x-app-layout>
