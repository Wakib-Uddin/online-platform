<!DOCTYPE html>
<html lang="en">
    <head>

    @include('website.includes.head')
    </head>
    <body>
        <!-- Responsive navbar-->
        @include('website.includes.nav')
        <!-- Page Content-->
        @yield('content')
        <!-- Footer-->
        @include('website.includes.footer')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('assets/website/js/scripts.js') }}"></script>
    </body>
</html>
