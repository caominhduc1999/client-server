
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="/assets_login/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="/assets_login/css/style.css">
    <base href="{{asset('')}}">
</head>
<body>

<div class="main">

    <!-- Sing in  Form -->

    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" class="register-form" id="register-form" action="{{route('register.post')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Your Name"/>
                            @if ($errors->has('name'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email"/>
                            @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-phone"></i></label>
                            <input type="text" name="phone" id="email" placeholder="Your Phone"/>
                            @if ($errors->has('phone'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="Password"/>
                            @if ($errors->has('password'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="password_confirm" id="re_pass" placeholder="Repeat your password"/>
                            @if ($errors->has('password_confirm'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('password_confirm') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="/assets_login/images/signup-image.jpg" alt="sing up image"></figure>
                    <a href="{{route('login')}}" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JS -->
<script src="/assets_login/vendor/jquery/jquery.min.js"></script>
<script src="/assets_login/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>