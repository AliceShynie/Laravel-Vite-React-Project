<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @viteReactRefresh
    @vite('resources/js/app.jsx')
    <title>Document</title>
</head>
<body>
    <h1> This is a test </h1>
    <h1 id="app"></h1>
</body>
</html>