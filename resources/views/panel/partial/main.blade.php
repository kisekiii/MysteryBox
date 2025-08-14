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
    <div class="flex flex-col xl:flex-row">
        @include('panel.partial.sidebar')
        <div class=" w-full h-screen">
            <div class="mx-auto mt-10">
                @yield('content')
            </div>
        </div>
    </div>
<script src="./node_modules/preline/dist/preline.js"></script>
</body>
</html>
