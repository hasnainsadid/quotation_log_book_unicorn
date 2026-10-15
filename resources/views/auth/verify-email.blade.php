<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Email | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/css/pages/page-auth.css">
    @include('backend.layouts.partials.style')
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <!-- Verify Email -->
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

                        <h4 class="mb-1">Verify your email ✉️</h4>
                        <p class="text-start mb-4">
                            Thanks for signing up! Before getting started, please verify your email address by
                            clicking the link we just sent to
                            <span class="fw-medium text-heading">{{ auth()->user()->email ?? 'your email' }}</span>.
                            If you didn't receive the email, we will gladly send you another.
                        </p>

                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                                <i class="icon-base ti tabler-circle-check me-2"></i>
                                <div>A new verification link has been sent to your email address.</div>
                            </div>
                        @endif

                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary d-grid w-100 mb-4 waves-effect waves-light">
                                Resend verification email
                            </button>
                        </form>

                        <form action="{{ route('logout') }}" method="POST" class="text-center">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 d-inline-flex align-items-center">
                                <i class="icon-base ti tabler-chevron-left scaleX-n1-rtl me-1_5"></i>
                                Log out
                            </button>
                        </form>

                        <hr class="my-4">

                        <div class="text-muted small">
                            <span class="fw-medium text-heading">Can't find the email?</span>
                            <ul class="mb-0 ps-3 mt-1">
                                <li>Check your Spam or Junk folder.</li>
                                <li>Make sure your email address is correct.</li>
                                <li>Wait a minute or two, then try again.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Verify Email -->
            </div>
        </div>
    </div>
    @include('backend.layouts.partials.script')
</body>

</html>