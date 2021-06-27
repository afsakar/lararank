
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{!! '403 | '.config('app.name', 'Laravel') !!}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ admin_asset('modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ admin_asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ admin_asset('css/components.css') }}">

</head>

<body>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="page-error">
                <div class="page-inner">
                    <h1>403</h1>
                    <div class="page-description">
                        You don't have a permission this action!
                    </div>
                    <div class="page-search">
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-primary btn-lg">
                            Go Back
                        </a>
                    </div>
                </div>
            </div>
            <div class="simple-footer mt-5">
                Copyright &copy; {{ config('app.name', 'Laravel') }} {{ date('Y') }}
            </div>
        </div>
    </section>
</div>

<!-- General JS Scripts -->
<script src="{{ admin_asset('modules/jquery.min.js')}}"></script>
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
</body>
</html>
