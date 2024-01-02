<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="/app.css"> --}}
    @viteReactRefresh 
    @vite('resources/sass/app.scss')
    @vite('resources/js/app.tsx')

    <title>Document</title>
</head>
<body>
    <div id="app"></div>
    @yield('content_register')
    @yield('content_login')
    @yield('content_login_post')
    @yield('post')
    @yield('posts')
    @yield('user_post')
    @yield('user_post_edit')
    @yield('post_category')
</body>
</html>