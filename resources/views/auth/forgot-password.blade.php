<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/css/pages/page-auth.css">
    @include('backend.layouts.partials.style')
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="{{url('/')}}" class="app-brand-link">
                                <span class="app-brand-logo demo">
                                    <span class="text-primary">
                                        <img src="{{ asset('backend/img/logo/unicorn_logo.png') }}" alt="Logo" height="70" class="app-brand-logo-default">
                                    </span>
                                </span>
                                <span class="app-brand-text demo text-heading fw-bold">Unicorn Group</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Forgot Password? 🔒</h4>
                        <p class="mb-6">Enter your email and we'll send you instructions to reset your password</p>
                        <form id="formAuthentication" class="mb-6 fv-plugins-bootstrap5 fv-plugins-framework"
                            action="{{ route('password.email') }}" method="POST" novalidate="novalidate">
                            @csrf
                            @method('POST')
                            <div class="mb-6 form-control-validation fv-plugins-icon-container">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" autofocus="">
                            </div>
                            <button class="btn btn-primary d-grid w-100 waves-effect waves-light">Send Reset
                                Link</button>
                        </form>
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="d-flex justify-content-center">
                                <i class="icon-base ti tabler-chevron-left scaleX-n1-rtl me-1_5"></i>
                                Back to login
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
    @include('backend.layouts.partials.script')
</body>

</html>
