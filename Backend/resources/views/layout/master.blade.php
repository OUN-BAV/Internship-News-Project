<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @stack('style')
    <style>
        body{
            font-family: serif;
        }
    </style>
</head>
<body>
    @yield('nav')
    @yield('sub_nav')
    <div class="container">
        @yield('ads')
        <div class="main d-flex">
            <div class="main col-sm-9 mt-3 p-4 shadow-sm bg-light">
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



