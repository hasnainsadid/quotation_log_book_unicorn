<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/css/pages/page-auth.css">
    @include('backend.layouts.partials.style')
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <!-- Reset Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="{{ url('/') }}" class="app-brand-link">
                                <span class="app-brand-logo demo">
                                    <span class="text-primary">
                                        <img src="{{ asset('backend/img/logo/unicorn_logo.png') }}" alt="Logo" height="70" class="app-brand-logo-default">
                                    </span>
                                </span>
                                <span class="app-brand-text demo text-heading fw-bold">Unicorn Group</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Reset Password 🔒</h4>
                        <p class="mb-6"><span class="fw-medium">Your new password must be different from previously
                                used passwords</span></p>
                        <form action="{{ route('password.update') }}" method="POST"
                            class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="mb-6 form-password-toggle form-control-validation fv-plugins-icon-container">
                                <label class="form-label" for="password">Email <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge has-validation">
                                    <input type="email" id="email" class="form-control" name="email"
                                        placeholder="Enter your email" required>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base ti tabler-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-6 form-password-toggle form-control-validation fv-plugins-icon-container">
                                <label class="form-label" for="password">New Password <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge has-validation">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="············" required aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base ti tabler-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-6 form-password-toggle form-control-validation fv-plugins-icon-container">
                                <label class="form-label" for="confirm-password">Confirm Password <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge has-validation">
                                    <input type="password" id="confirm-password" class="form-control"
                                        name="password_confirmation" placeholder="············" aria-describedby="password">
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base ti tabler-eye-off"></i></span>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100 mb-6 waves-effect waves-light">Set new
                                password</button>
                            <div class="text-center">
                                <a href="auth-login-basic.html" class="d-flex justify-content-center">
                                    <i class="icon-base ti tabler-chevron-left scaleX-n1-rtl me-1_5"></i>
                                    Back to login
                                </a>
                            </div>
                            <input type="hidden">
                        </form>
                    </div>
                </div>
                <!-- /Reset Password -->
            </div>
        </div>
    </div>
    @include('backend.layouts.partials.script')
</body>

</html>
