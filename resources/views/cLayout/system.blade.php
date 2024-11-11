<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Applications</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/bootstrap-4.0.0/dist/css/bootstrap.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        @yield('content')
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/bootstrap-4.0.0/dist/js/bootstrap.bundle.js') }}"></script>

    @yield("script")
</body>

</html>
