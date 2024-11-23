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
    <!-- meta character set -->
    <meta charset="UTF-8" />
    <!-- Site Title -->
    <title>Reset Password in AgileSole</title>

    @vite('resources/js/userForm.js')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
</head>
<body>
       <section class="login_box_area section_gap">
        <div class="container">
            <div class="row justify-content-center"  >
                    <div class="login_form_inner customSx" >
                            <img src="/img/AgileSoleLogo.png" alt="" width="100px" class="pb-3">  
                        <h3>Reset Password</h3>
                        <form class="login_form row" action="{{ route('reset.password.post') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="email_address" name="email"
                                    placeholder="Email" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Email'"  required/>
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="d-flex col-md-12 form-group align-items-center">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Password'" required />
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="d-flex col-md-12 form-group align-items-center">
                                <input type="password" class="form-control" id="password-confirm" name="password_confirmation"
                                    placeholder="Confirm Password" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Confirm Password'" />

                                    @if ($errors->has('password_confirmation'))
                                    <span
                                        class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>

                            <div class="col-md-12 ">
                                <button type="submit" class="btn primary-btn rounded-0">
                                    Reset Password
                                </button>
                            </div>
                        </form>

                    </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }} "></script>
    <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
</body>

</html>
