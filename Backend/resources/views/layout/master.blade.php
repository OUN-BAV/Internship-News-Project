<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @stack('style')
</head>
<body>
    @yield('nav')

    <div class="container">
        @yield('ads')
        <div class="main d-flex">
            <div class="main col-sm-9 p-3">
                @yield('content')
            </div>
            <div class="sidebar col-sm-3">
                @yield('sidebar')
            </div>
        </div>
    </div>

    @yield('footer')
</body>
@stack('script')
</html>



