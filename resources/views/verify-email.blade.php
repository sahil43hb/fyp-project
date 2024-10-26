<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('img/FavLogo.png') }}" />
    <!-- Author Meta -->
    <meta name="author" content="CodePixar" />
    <!-- Meta Description -->
    <meta name="description" content="" />
    <!-- Meta Keyword -->
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- meta character set -->
    <meta charset="UTF-8" />
    <!-- Site Title -->
    <title>Verify Email in AgileSole</title>

    @vite('resources/js/userForm.js')

    <!-- CSS============================================= -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
</head>

<body>
    {{-- <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verify Your Email Address</div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif
                    Before proceeding, please check your email for a verification link. If you did not receive the
                    email,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline" style="color: #44D62C">click here to request
                            another</button>.
                    </form>
                </div>
            </div>
        </div>
    </div> --}}


    <section class="login_box_area section_gap">
        <div class="container">
            <div class="row justify-content-center" >
                    <div class="login_form_inner customSx px-3" >
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif
                            <img src="/img/AgileSoleLogo.png" alt="" width="100px" class="pb-3">                        
                        <h3>Verify Your Email Address</h3>
                        Before proceeding, please check your email for a verification link. If you did not receive the
                    email,
                        <form class="row login_form" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <div class="w-100 pt-5">
                            <button type="submit" class="btn primary-btn rounded-0" >click here to request
                                another</button>
                        </div>                        
                        </form>
                    </div>
            </div>
        </div>
    </section>


</body>

</html>
