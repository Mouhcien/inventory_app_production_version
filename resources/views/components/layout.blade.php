<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> Gestion des resources </title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    @vite(['resources/css/bootstrap.css', 'resources/js/app.js', 'resources/sass/app.scss'])


</head>
<body class="d-flex flex-column min-vh-100">
<!-- Responsive navbar-->
<x-nav-link />
<!-- Page content-->
<div class="container-fluid p-5 mt-5">

    @if(session('success'))
        <x-notification type="success" message="{{session('success')}}" />
    @endif
    @if(session('error'))
        <x-notification type="danger" message="{{session('error')}}" />
    @endif

        {{ $slot  }}

</div>
<x-footer />
<!-- Bootstrap core JS-->
@vite(['resources/js/jquery-3.7.1.js', 'resources/js/app.js', 'resources/js/script.js', 'resources/js/mycharts.js'])
</body>
</html>
