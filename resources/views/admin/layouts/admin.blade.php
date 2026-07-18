<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My Web')</title>

    {{-- CDN Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    
    {{-- Summernote CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    
    {{-- Sử dụng CSS và JavaScript thông qua Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="admin-wrapper d-flex">
    {{-- SIDEBAR --}}
    @include('admin._partials.sidebar')

    {{-- RIGHT CONTENT --}}
    <div class="admin-content flex-grow-1 d-flex flex-column" style="min-width: 0;">
        {{-- HEADER --}}
        @include('admin._partials.header')

        {{-- MAIN CONTENT --}}
        <main class="flex-grow-1 p-4 bg-admin">
            @yield('content')
        </main>

        {{-- FOOTER --}}
        @include('admin._partials.footer')
    </div>
</div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
<script src="{{ asset('js/preview-image.js') }}"></script>
<script>
    $(document).ready(function() {
        if ($('.summernote').length > 0) {
            $('.summernote').summernote({
                height: 300,
                placeholder: 'Nhập nội dung chi tiết tại đây...',
                tabsize: 2
            });
        }
    });
</script>
</body>
</html>