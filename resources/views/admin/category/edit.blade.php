<x-app-layout>
    <div class="sm:ml-64">
        <header class="bg-white light:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex gap-x-4">

                <h2 class="font-semibold text-xl text-gray-800 light:text-gray-200 leading-tight">
                    {{ __('Buat Kategori') }}
                </h2>
            </div>
        </header>

        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 rounded-lg my-4">
            <h2 class="text-2xl font-semibold mb-4">Buat sebuah kategori</h2>
            @if ($errors->any())
                <div class="bg-red-500 text-white p-2 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('category.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')


                <!-- Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium mb-2">Title</label>
                    <input type="text" name="name" value="{{ $category->name }}" id="title"
                        class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Tag Color -->
                <div class="mb-4">
                    <label for="tag-color" class="block text-sm font-medium mb-2">Tag Color</label>
                    <input type="color" id="tag-color-picker" name="color" value="{{ $category->color }}" class="w-20 h-10 border-0 rounded cursor-pointer mt-[-3px]" onchange="selectColor(this.value)">
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium mb-2">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full p-2.5 border border-gray-600 rounded focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Write a description here">{{ $category->description }}</textarea>
                </div>

                <!-- Add Event Button -->
                <div>
                    <button type="submit"
                        class="w-64 p-2.5 bg-blue-600 text-white rounded hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                        Perbarui Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function selectColor(color) {
            document.getElementById('tag-color-hidden').value = color;
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.cursor-pointer').forEach(div => {
                div.addEventListener('click', function() {
                    const color = window.getComputedStyle(this).backgroundColor;
                    const hexColor = rgbToHex(color);
                    selectColor(hexColor);
                });
            });

            function rgbToHex(rgb) {
                const result = rgb.match(/\d+/g).map(function(x) {
                    return parseInt(x).toString(16).padStart(2, '0');
                });
                return `#${result.join('')}`;
            }
        });
    </script>
</x-app-layout>
