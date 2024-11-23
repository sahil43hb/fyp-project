<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/FavLogo.png" />
    <!-- Author Meta -->
    <meta name="author" content="CodePixar" />
    <!-- Meta Description -->
    <meta name="description" content="" />
    <!-- Meta Keyword -->
    <meta name="keywords" content="" />
    <!-- meta character set -->
    <meta charset="UTF-8" />
    <!-- Site Title -->
    <title>Forget Password in AgileSole</title>

    @vite('resources/js/userForm.js')


    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
</head>
<body>
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="row justify-content-center"  >
                    <div class="login_form_inner customSx" >
                        <a  href="{{ url('/') }}">
                            <img src="img/AgileSoleLogo.png" alt="" width="100px" class="pb-3">
                        </a>                       
                        <h3>Reset Password</h3>
                        <form action="{{ route('forget.password.post') }}"  class="row login_form"  method="POST">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="email_address" name="email"
                                    placeholder="Email" autofocus required
                                     />
                                     @if ($errors->has('email'))
                                     <span class="text-danger pt-2">{{ $errors->first('email') }}</span>
                                 @endif
                            </div>
                            <div class="col-md-12 form-group pt-3">
                                <button type="submit"  class="btn primary-btn">
                                    Send Password Reset Link
                                </button>
                                <hr class="hr-text" data-content="OR">
                                <div class="hover pt-2">
                            <h4>Sign in</h4>
                            <a class="primary-btn text-white" href="{{ url('login') }}">Sign in</a>
                        </div>
                        </form>
                        @if (Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
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
