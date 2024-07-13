<x-app-layout>
    <div class="sm:ml-64">
        <header class="bg-white light:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex gap-x-4">

                <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
                    {{ __('Edit Acara') }}
                </h2>
            </div>
        </header>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-lg shadow-md my-4">
                <h2 class="text-2xl font-semibold mb-4">Edit acara {{ $event->title }}</h2>

                @if ($errors->any())
                    <div class="bg-red-500 text-white p-2 mb-4 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('event.update', $event->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium mb-2">Judul Acara</label>
                        <input type="text" value="{{ $event->title }}" id="title" name="title" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Select Date -->
                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="start-date" class="block text-sm font-medium mb-2">Waktu Mulai</label>
                            <input type="date" id="start-date" value="{{ old('start_date', $event->start_date ?  \Carbon\Carbon::parse($event->start_date)->format('Y-m-d') : '') }}" name="start_date"
                                class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="end-date" class="block text-sm font-medium mb-2">Waktu Akhir</label>
                            <input type="date" id="end-date" value="{{ old('start_date', $event->end_date ?  \Carbon\Carbon::parse($event->end_date)->format('Y-m-d') : '') }}" name="end_date"
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
                                    <option value="{{ $category->id }}" @selected($category->id === $event->category_id)>{{ $category->name }}</option>
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
                                        <option value="{{ $user->id }}" @selected($user->id === $event->user_id)>{{ $user->name }} - {{ $user->role_id }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="user_id" value="{{ $event->user_id }}">
                        @endif
                    </div>

                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="reminder-type" class="block text-sm font-medium mb-2">Status</label>
                            <select id="reminder-type" name="status" 
                                class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">

                                <option value="">Pilih Status Event</option>

                                <option value="draft" @selected('draft' === $event->status)>Draft</option>
                                <option value="published" @selected('published' === $event->status)>Publised</option>
                                <option value="closed" @selected('closed' === $event->status)>Closed</option>
                            </select>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium mb-2">Tempat / Apps</label>
                            <input type="text" id="location" value="{{ $event->location }}" name="location" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- All day & Repeat -->
                    {{-- <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="all-day" class="mr-2">
                            <label for="all-day" class="text-sm font-medium">All day</label>
                        </div>
                        <div>
                            <label for="repeat" class="block text-sm font-medium mb-2">Does not repeat</label>
                            <select id="repeat"
                                class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                                <option>Does not repeat</option>
                            </select>
                        </div>
                    </div> --}}

                    <!-- Google Meet -->
                    {{-- <div class="mb-4">
                        <button type="button"
                            class="w-100 text-white p-2.5 bg-blue-600 rounded hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                            Add Google Meet video conference
                        </button>
                    </div> --}}

                    <!-- Tag Color -->
                    {{-- <div class="mb-4">
                        <label for="tag-color" class="block text-sm font-medium mb-2">Tag Color</label>
                        <div class="flex space-x-2">
                            <!-- Add more colors as needed -->
                            <div class="w-8 h-8 bg-red-500 rounded cursor-pointer"></div>
                            <div class="w-8 h-8 bg-blue-500 rounded cursor-pointer"></div>
                            <div class="w-8 h-8 bg-green-500 rounded cursor-pointer"></div>
                            <div class="w-8 h-8 bg-yellow-500 rounded cursor-pointer"></div>
                            <div class="w-8 h-8 bg-purple-500 rounded cursor-pointer"></div>
                            <div class="w-8 h-8 bg-orange-500 rounded cursor-pointer"></div>
                        </div>
                    </div> --}}

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium mb-2">Deskripsi</label>
                        <textarea id="description" rows="4"
                             name="description"
                            class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Buat deskripsi tentang acara mu...">{{ $event->description }}</textarea>
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

                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="terms_and_conditions" class="block text-sm font-medium mb-2">Peraturan dan Persyaratan</label>
                            <textarea id="terms_and_conditions" rows="4"
                            name="terms_and_conditions"
                           class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Peraturan dan persyaratan pada event mu...">{{ $event->terms_and_conditions }}</textarea>
                        </div>

                        <div>
                            <label for="agenda" class="block text-sm font-medium mb-2">Agenda</label>
                            <textarea id="agenda" rows="4"
                            name="agenda"
                           class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Jadwalkan event mu dengan rinci...">{{ $event->agenda }}</textarea>
                        </div>

                       
                    </div>

                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="speaker" class="block text-sm font-medium mb-2">Pembicara</label>
                            <input type="text" id="speaker" value="{{ $event->speaker }}" name="speaker" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            @php 
                            @endphp
                            <label for="link_registration" class="block text-sm font-medium mb-2">Link Registration</label>
                            <input type="text" value="{{ $event->link_registration}}" readonly id="link_registration" name="link_registration" class="w-full border-0 p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium mb-2">Harga</label>
                            <input type="number"  value="{{ $event->price}}" id="price" name="price" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="quota" class="block text-sm font-medium mb-2">Kuota Peserta</label>
                            <input type="number" value="{{ $event->quota}}" id="quota" name="quota" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>


                    <!-- Add Event Button -->
                    <div>
                        <button type="submit"
                            class="w-64 p-2.5 bg-blue-600 text-white rounded hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                            Perbarui Acara
                        </button>
                    </div>
                </form>
        </div>
    </div>
</x-app-layout>
