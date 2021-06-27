<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $header }} | {{ config('app.name', 'Laravel') }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ admin_asset('modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ admin_asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('css/components.css') }}">

    <script src="{{ mix('js/app.js') }}" defer></script>

    @livewireStyles
</head>

<body>
<div id="app">
    <section class="section">
        {{ $slot }}
    </section>
</div>

<!-- General JS Scripts -->
<script src="{{ admin_asset('modules/jquery.min.js') }}"></script>
<script src="{{ admin_asset('modules/popper.js') }}"></script>
<script src="{{ admin_asset('modules/tooltip.js') }}"></script>
<script src="{{ admin_asset('modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ admin_asset('modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ admin_asset('modules/moment.min.js') }}"></script>
<script src="{{ admin_asset('js/stisla.js') }}"></script>

<!-- JS Libraies -->

<!-- Page Specific JS File -->

<!-- Template JS File -->
<script src="{{ admin_asset('js/scripts.js') }}"></script>
<script src="{{ admin_asset('js/custom.js') }}"></script>

@stack('modals')

@livewireScripts

@stack('scripts')
</body>
</html>
