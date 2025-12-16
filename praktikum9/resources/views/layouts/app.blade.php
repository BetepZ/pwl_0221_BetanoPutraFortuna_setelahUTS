<html>

<head>
    <title>Aplikasi Saya - @yield('title')</title>
</head>

<body>
    @include('partials.navbar') <div
        class="container">
        @yield('content')
    </div>
    <footer>Copyright 2024</footer>
</body>

</html>