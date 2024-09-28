<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="{{ asset('img/FavLogo.png') }}" />
    <meta name="author" content="CodePixar" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @include('layouts.style')
    @yield('css')
</head>

<body class="">
    @include('layouts.header')
    @yield('content')

    @include('layouts.footer')
    @include('layouts.script')
    @yield('script')
</body>
