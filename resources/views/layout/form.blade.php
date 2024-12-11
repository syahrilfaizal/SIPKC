<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Laporan')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/feather.css') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/emoji.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">
    @stack('styles')
</head>
<body class="color-theme-blue mont-font">

    <div class="preloader"></div>
    
    <div class="main-wrapper">
        <!-- Navigation Top -->
        @include('partials.nav-top')

        <!-- Navigation Left -->
        @include('partials.nav-left')

        <!-- Main Content -->
        <div class="main-content right-chat-active">
            @include('partials.formadd') <!-- Konten Utama -->
        </div>

        <!-- Right Chat -->
        @include('partials.right-chat')

        <!-- Footer -->
        @include('partials.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @stack('scripts')
</body>
</html>
