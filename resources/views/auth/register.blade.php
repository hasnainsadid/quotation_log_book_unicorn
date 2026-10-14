<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration | Vuexy</title>
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/css/pages/page-auth.css">
    @include('backend.layouts.partials.style')
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <!-- Register Card -->
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
                        <h4 class="mb-1">Adventure starts here </h4>
                        {{-- <p class="mb-6">Make your app management easy and fun!</p> --}}

                        <form id="formAuthentication" class="mb-6 fv-plugins-bootstrap5 fv-plugins-framework"
                            action="{{ route('register.store') }}" method="POST" novalidate="novalidate">
                            @csrf
                            @method('POST')
                            <div class="mb-6 form-control-validation fv-plugins-icon-container">
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="mb-6 form-control-validation fv-plugins-icon-container">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-6 form-control-validation fv-plugins-icon-container">
                                <label for="email" class="form-label">Phone Number<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                            </div>
                            <div class="mb-6 form-password-toggle form-control-validation fv-plugins-icon-container">
                                <label class="form-label" for="password">Password<span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge has-validation">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="············" aria-describedby="password" required>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base ti tabler-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-6 form-password-toggle form-control-validation fv-plugins-icon-container">
                                <label class="form-label" for="password">Confirm Password <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge has-validation">
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                                        placeholder="············" aria-describedby="password" required>
                                    <span class="input-group-text cursor-pointer"><i
                                            class="icon-base ti tabler-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="my-8 form-control-validation fv-plugins-icon-container">
                                <div class="form-check mb-0 ms-2">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions"
                                        name="terms" required>
                                    <label class="form-check-label" for="terms-conditions">
                                        I agree to
                                        <a href="javascript:void(0);">privacy policy &amp; terms</a>
                                    </label>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100 waves-effect waves-light">Sign up</button>
                            <input type="hidden">
                        </form>

                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="{{ route('login') }}">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>
    @include('backend.layouts.partials.script')
</body>

</html>
