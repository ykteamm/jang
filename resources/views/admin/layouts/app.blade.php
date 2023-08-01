<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Jang Novatio</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="manifest.json" />

    <!-- Favicons -->
    {{-- <link rel="apple-touch-icon" href="img/favicon180.png" sizes="180x180"> --}}
    {{-- <link rel="icon" href="img/favicon32.png" sizes="32x32" type="image/png"> --}}
    {{-- <link rel="icon" href="img/favicon16.png" sizes="16x16" type="image/png"> --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('mobile/favv.jpg') }}">

    @include('admin.partials.css')

</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="homepage">
    <!-- screen loader -->
    @include('components.loader')




    <!-- menu main -->
    @include('admin.components.sidebar')

    <div class="backdrop"></div>


    <!-- Begin page content -->
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
            @include('admin.components.header')


            @yield('admin')
    </main>

    <!-- footer-->
    @include('admin.components.footer')







    @include('admin.partials.js')

</body>

</html>
