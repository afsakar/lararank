<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{!! $header ? $header.' | '.config('app.name', 'Laravel') : config('app.name', 'Laravel') !!}</title>

    @include('admin.includes.style')

    @livewireStyles

    <style>
        .modal-backdrop {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 0!important;
            background-color: transparent!important;
        }
    </style>

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->

</head>

<body>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        @include('admin.includes.navbar')
        @include('admin.includes.sidebar')

        {{ $slot }}
    </div>
</div>

@livewireScripts

@stack('modals')

@stack('scripts')

@include('admin.includes.script')
@include('admin.includes.logout-modal')
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
<script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
@include('admin.includes.delete')
</body>
</html>
