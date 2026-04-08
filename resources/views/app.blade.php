<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white">

    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')

</body>
</html>