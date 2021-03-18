<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

   <title>Login - TrueRator</title>


    <!-- Generics -->
    <link rel="icon" href="{{ asset('assets/images/favicon/favicon-32.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('assets/images/favicon/favicon-128.png') }}" sizes="128x128">
    <link rel="icon" href="{{ asset('assets/images/favicon/favicon-192.png') }}" sizes="192x192">

    <!-- Android -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon/favicon-196.png') }}" sizes="196x196">

    <!-- iOS -->
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon/favicon-152.png') }}" sizes="152x152">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon/favicon-167.png') }}" sizes="167x167">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon/favicon-180.png') }}" sizes="180x180">

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
</head>

<body>
    @include('sweetalert::alert')
    @yield('content')
    <style>
        .swal2-styled {
            border: unset !important;
            border-radius: 9999px !important;
            font-size: .8em !important;
        }
        .swal2-header{
            font-size:.7em !important;
        }
    </style>
    <script src="{{ asset('assets/js/vendor.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>
