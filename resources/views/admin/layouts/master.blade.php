<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>@yield('title')</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    {{-- <link href="{{ asset('assets / img / favicon . png') }}" rel="icon" /> --}}
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />


    @include('admin.layouts.style')

    @yield('css')
</head>

<body>
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
    <main id="main" class="main">
        @yield('content')
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    @include('admin.layouts.script')




    @if (session()->has('success'))
        <script>
            var success = @json(session()->get('success'));
            toastr.success(success);
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            var error = @json(session()->get('error'));
            toastr.error(error);
        </script>
    @endif
    @yield('script')
</body>

</html>
