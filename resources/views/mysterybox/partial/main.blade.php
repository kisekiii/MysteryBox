<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
        <div class="mx-auto w-full">
            <div>
                @yield('content')
            </div>
        </div>
<script src="./node_modules/preline/dist/preline.js"></script>
</body>
</html>
