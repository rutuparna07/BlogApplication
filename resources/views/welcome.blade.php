<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('/css/slide.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/background.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="area" style="position: relative; z-index:1;">
            <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>
        </div >
        <div class="flex-center position-ref full-height" style="position: absolute; z-index:2;">
            <div class="content">
                {{-- Sliding form --}}
                <div class="container" id="container">
                    <div class="form-container sign-up-container">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <h1>Create Account</h1><br>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            <button type="submit">Sign Up</button>
                        </form>
                    </div>
                    <div class="form-container sign-in-container">
                        <form method="POST" action="{{ route('login') }}"> 
                            @csrf
                            <h1>Sign in</h1><br>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" required autocomplete="current-password"/>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           {{--  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label> --}}
                            
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                            <button type="submit">Sign In</button>
                        </form>
                    </div>
                    <div class="overlay-container">
                        <div class="overlay">
                            <img src="images\bloss.png" style="z-index: -1; opacity:0.4; object-fit:cover;">
                            <div class="overlay-panel overlay-left">
                                    <h1>Welcome Back!</h1>
                                    <p>To keep connected with us please login with your personal info</p>
                                    <button class="ghost" id="signIn">Sign In</button>
                            </div>
                            <div class="overlay-panel overlay-right">
                                
                                    <h1>Hello, Friend!</h1>
                                    <p>Enter your personal details and start journey with us</p>
                                    <button class="ghost" id="signUp">Sign Up</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </body>

    <script type="text/javascript" src="{{ URL::asset('js/slide.js') }}"></script>

    </html>
