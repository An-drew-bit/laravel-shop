<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        @vite(['resources/css/app.css', 'resources/sass/main.sass', 'resources/js/app.js'])
    </head>
    <body class="antialiased">

        <h1>Home</h1>
        @guest
            <a href="{{ route('login') }}">Логин</a>
        @endguest
        @auth
            <h1>Ты зареган</h1>
            <a href="{{ route('logout') }}">Выйти</a>
        @endauth
    </body>
</html>
