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
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                            <label for="location" class="block text-sm font-medium mb-2">Tempat</label>
                            <input type="text" id="location" name="location" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium mb-2">Deskripsi</label>
                        <x-tinymce-textarea name="description" label="Deskripsi"  placeholder="Buat deskripsi tentang acara mu..." />
                    </div>

                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-tinymce-textarea name="terms_and_conditions" label="Peraturan dan Persyaratan" placeholder="Peraturan dan persyaratan pada event mu..." />
                        </div>

                        <div>
                            <x-tinymce-textarea name="agenda" label="Agenda" placeholder="Jadwalkan event mu dengan rinci..." />
                        </div>
                    </div>

                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="speaker" class="block text-sm font-medium mb-2">Pembicara</label>
                            <input type="text" id="speaker" name="speaker" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                            <span class="text-xs font-bold text-gray">Pisahkan dengan | jika lebih dari satu. contoh: Abi | Malih</span>
                        </div>

                        <div>
                            <label for="additional-fee" class="block text-sm font-medium mb-2">Biaya Tambahan</label>
                            <select id="additional-fee" name="additional_fee_id"
                                class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">

                                <option value="">Pilih Biaya</option>

                                @foreach ($additionalFees as $fee)
                                    <option value="{{ $fee->id }}">{{ $fee->name }}</option>
                                @endforeach
                            </select>
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

                    <div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Unggah Gambar</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  name="poster_image" id="file_input" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG.</p>
                        </div>
                    </div>

                     {{-- sponsorship Section --}}
                     <hr class="my-5" />
                   
                     <div>
                         <label for="is_sponsorship" class="block text sm font-medium mb-2">Apakah acara ini mendapat Sponsor ?</label>
                         <p>*isi hanya jika kamu ingin menambahkan sponsor!</p>
                     </div>
 
                     <div class="mb-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                         <div>
                             <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload Gambar</label>
                             <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  name="sponsorship_image" id="file_input" type="file">
                             <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG.</p>
                         </div>
 
                         <div>
                             <label for="sponsorship_title" class="block text-sm font-medium mb-2">Tujuan Sponsor</label>
                             <input type="text"  id="sponsorship_title" name="sponsorship_title" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                         </div>
 
                         <div>
                             <label for="sponsorship_target" class="block text-sm font-medium mb-2">Jumlah yang disponsori</label>
                             <input type="number"  id="sponsorship_target" name="sponsorship_target" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                         </div>
                     </div>
 
                     <div class="mb-4 grid grid-cols-1 gap-4">
                         <div>
                             <x-tinymce-textarea name="sponsorship_description" label="Deskripsi Sponsorship"  placeholder="Deskripsi sponsorship pada event mu..." />
                         </div>
                     </div>
                     {{-- sponsorship Section --}}

                    <hr class="my-5" />

                    {{-- Fundraising Section --}}
                    <div class="mt-5">
                        <label for="is_fundraising" class="block text sm font-medium mb-2">Apakah acara ini menggalang dana ?</label>
                        <p>*isi hanya jika kamu sedang menggalang dana!</p>
                    </div>

                    <div class="mb-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Unggah Gambar</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"  name="fundraising_image" id="file_input" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG.</p>
                        </div>

                        <div>
                            <label for="fundraising_title" class="block text-sm font-medium mb-2">Tujuan Penggalangan Dana</label>
                            <input type="text" value="" id="fundraising_title" name="fundraising_title" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="fundraising_target" class="block text-sm font-medium mb-2">Target Penggalangan Dana</label>
                            <input type="number" value="" id="fundraising_target" name="fundraising_target" class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="mb-4 grid grid-cols-1 gap-4">
                        <div>
                            <x-tinymce-textarea name="fundraising_description" label="Deskripsi Penggalangan Dana" placeholder="Deskripsi penggalangan dana pada event mu..." />
                        </div>
                    </div>
                    {{-- Fundraising Section --}}


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
