<!-- resources/views/components/tinymce-textarea.blade.php -->
<div class="form-group">
    @if($label)
        <label for="myeditorinstance" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif
    <textarea class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" id="myeditorinstance" name="{{ $name }}" placeholder="{{ $placeholder }}">{{ $value }}</textarea>
</div>
