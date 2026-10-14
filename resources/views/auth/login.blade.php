<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/css/pages/page-auth.css">
    @include('backend.layouts.partials.style')
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="{{ url('/') }}" class="app-brand-link">
                                <span class="app-brand-logo demo d-flex flex-column align-items-center">
                                    <span class="text-primary">
                                        <img src="{{ asset('backend/img/logo/unicorn_logo.png') }}" alt="Logo" height="70" class="app-brand-logo-default">
                                    </span>
                                </span>
                                <span class="app-brand-text demo text-heading fw-bold">Unicorn Group</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Welcome to Unicorn Group!</h4>
                        <p class="mb-6">Please sign-in to your account and start the adventure</p>

                        <form id="formAuthentication" class="mb-4 fv-plugins-bootstrap5 fv-plugins-framework"
                            action="{{ route('login') }}" method="POST" novalidate="novalidate">
                            @csrf
                            @method('POST')
                            <div class="mb-6 form-control-validation fv-plugins-icon-container">
                                <label for="login" class="form-label">Email or Phone Number<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="login" name="login"
                                    placeholder="Enter your email or phone number" autofocus="">
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="mb-6 form-password-toggle form-control-validation fv-plugins-icon-container">
                                <label class="form-label" for="password">Password<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge has-validation">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="············" aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base ti tabler-eye-off"></i></span>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <div class="my-8">
                                <div class="d-flex justify-content-between">
                                    <div class="form-check mb-0 ms-2">
                                        <input class="form-check-input" type="checkbox" id="remember-me" name="remember">
                                        <label class="form-check-label" for="remember-me"> Remember Me </label>
                                    </div>
                                    <a href="{{ route('password.request')}}">
                                        <p class="mb-0">Forgot Password?</p>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100 waves-effect waves-light"
                                    type="submit">Login</button>
                            </div>
                        </form>

                        {{-- <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="{{ route('register') }}">
                                <span>Create an account</span>
                            </a>
                        </p> --}}

                        {{-- <div class="divider my-6">
                            <div class="divider-text">or</div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <a href="javascript:;"
                                class="btn btn-icon rounded-circle btn-text-facebook me-1_5 waves-effect">
                                <i class="icon-base ti tabler-brand-facebook-filled icon-20px"></i>
                            </a>

                            <a href="javascript:;"
                                class="btn btn-icon rounded-circle btn-text-twitter me-1_5 waves-effect">
                                <i class="icon-base ti tabler-brand-twitter-filled icon-20px"></i>
                            </a>

                            <a href="javascript:;"
                                class="btn btn-icon rounded-circle btn-text-github me-1_5 waves-effect">
                                <i class="icon-base ti tabler-brand-github-filled icon-20px"></i>
                            </a>

                            <a href="javascript:;"
                                class="btn btn-icon rounded-circle btn-text-google-plus waves-effect">
                                <i class="icon-base ti tabler-brand-google-filled icon-20px"></i>
                            </a>
                        </div> --}}
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>
    @include('backend.layouts.partials.script')
</body>

</html>
