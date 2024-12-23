<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title> <!--dynamic title-->

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css"> <!--cdn link-->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        @guest
            @yield('content')
        @else
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            @endguest
        </div>

        <!-- General JS Scripts -->
        <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/modules/popper.js') }}"></script>
        <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
        <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
        <script src="{{ asset('assets/js/stisla.js') }}"></script>

        <!-- JS Libraries -->
        <script src="{{ asset('assets/modules/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
        <script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
        <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

        <!-- Page Specific JS File -->
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script> <!--cdn link-->

        <!-- Template JS File -->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>

        @yield('scripts')
</body>

</html>
