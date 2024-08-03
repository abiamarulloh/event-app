const mix = require('laravel-mix');


// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css')
//    .copy('node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js', 'public/js/ckeditor.js');

mix.copyDirectory('vendor/tinymce/tinymce', 'public/js/tinymce');