<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title> <!--dynamic title-->

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}" rel="preload" as="style">

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
            <div class="main-wrapper main-wrapper-1">
                <div class="navbar-bg"></div>

                {{-- navbar section start --}}
                @include('partials.navbar')
                {{-- navbar section end --}}

                {{-- sidebar section start --}}
                @include('partials.sidebar')
                {{-- sidebar section end --}}

                <!-- Main Content -->
                <div class="main-content">

                    {{-- Success message box --}}
                    @if (session('success'))
                        <div class="alert alert-success custom-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Error message box --}}
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
                <footer class="main-footer">
                    <div class="footer-left">
                        Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                            Nauval Azhar</a>
                    </div>
                    <div class="footer-right">

                    </div>
                </footer>
            </div>
        @endguest
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}" ></script>
    <script src="{{ asset('assets/modules/popper.js') }}" defer></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}" defer></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}" defer></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/stisla.js') }}" defer></script>

    <!-- JS Libraries -->
    <script src="{{ asset('assets/modules/jquery.sparkline.min.js') }}" defer></script>
    <script src="{{ asset('assets/modules/chart.min.js') }}" defer></script>
    <script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}" defer></script>
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}" defer></script>
    <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}" defer></script>

    <!-- Page Specific JS File -->
    <script async src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script> <!--cdn link-->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @yield('scripts')
</body>

</html>
