@php
    use Laravel\Jetstream\Agent;

    $sessions = DB::table('sessions')
        ->where('user_id', auth()->user()->getAuthIdentifier())
        ->orderBy('last_activity', 'desc')
        ->get()
        ->map(function ($session) {
            $agent = new Agent();
            $agent->setUserAgent($session->user_agent);

            return (object) [
                'agent' => $agent, // now you can call browser() and platform()
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === session()->getId(),
                'last_active' => \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
@endphp
@extends('backend.layouts.app')
@section('title', 'Account Setting')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row fv-plugins-icon-container">
            <div class="col-md-12">
                <div class="nav-align-top nav-tabs-shadow">
                    <ul class="nav nav-tabs nav-fill flex-column flex-md-row mb-6 gap-md-0 gap-2" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link active waves-effect" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile"
                                aria-selected="true">
                                <span class="d-none d-sm-inline-flex align-items-center">
                                    <i class="icon-base ti tabler-users icon-sm me-1_5"></i>Account
                                </span>
                                <i class="icon-base ti tabler-users icon-sm d-sm-none"></i>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-security" aria-controls="navs-justified-security"
                                aria-selected="false">
                                <span class="d-none d-sm-inline-flex align-items-center">
                                    <i class="icon-base ti tabler-lock icon-sm me-1_5"></i>Security
                                </span>
                                <i class="icon-base ti tabler-lock icon-sm d-sm-none"></i>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-justified-profile" role="tabpanel">
                            <div class="card mb-6">
                                <!-- Account -->
                                <form method="post" action="{{ route('user-profile-information.update') }}"
                                    class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="d-flex align-items-start align-items-sm-center gap-6">
                                            <img src="{{ auth()->user()->profile_photo_path
                                                ? Storage::url(auth()->user()->profile_photo_path)
                                                : Storage::url('default.png') }}"
                                                alt="user-avatar" class="d-block w-px-100 h-px-100 rounded"
                                                id="uploadedAvatar">
                                            <div class="button-wrapper">
                                                <label for="upload"
                                                    class="btn btn-primary me-3 mb-4 waves-effect waves-light"
                                                    tabindex="0">
                                                    <span class="d-none d-sm-block">Upload new photo</span>
                                                    <i class="icon-base ti tabler-upload d-block d-sm-none"></i>
                                                    <input type="file" id="upload" name="photo"
                                                        class="account-file-input" hidden=""
                                                        accept="image/png, image/jpeg"
                                                        onchange="if(this.files[0]){var reader=new FileReader();reader.onload=function(e){document.getElementById('uploadedAvatar').src=e.target.result;};reader.readAsDataURL(this.files[0]);}">
                                                </label>
                                                <div>Allowed JPG, GIF or PNG. Max size of 2Mb</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-4">
                                        <div class="row gy-4 gx-6 mb-6">
                                            <div class="col-md-12 form-control-validation fv-plugins-icon-container">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" type="text" id="name" name="name"
                                                    value="{{ auth()->user()->name }}" placeholder="Enter Your Name" />
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input class="form-control" type="text" id="email" name="email"
                                                    value="{{ auth()->user()->email }}"
                                                    placeholder="your_email@example.com">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="phoneNumber">Phone Number</label>
                                                <input type="text" id="phoneNumber" name="phone" class="form-control"
                                                    value="{{ auth()->user()->phone }}" placeholder="Enter Phone Number">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="address" class="form-label">Address</label>
                                                <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter Your Address">{{ auth()->user()->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit"
                                                class="btn btn-primary me-3 waves-effect waves-light">Save
                                                changes</button>
                                            <button type="reset"
                                                class="btn btn-label-secondary waves-effect">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /Account -->
                            @if (!auth()->user()->hasVerifiedEmail())
                                <div class="card mb-6">
                                    <h5 class="card-header">Email Verification</h5>
                                    <div class="card-body">
                                        <form id="formAccountDeactivation" action="{{ route('verification.send') }}"
                                            method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework"
                                            novalidate="novalidate">
                                            @csrf
                                            @method('POST')
                                            <button type="submit"
                                                class="btn btn-danger deactivate-account waves-effect waves-light">Send
                                                Verification
                                                Email</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            {{-- <div class="card">
                                <h5 class="card-header">Delete Account</h5>
                                <div class="card-body">
                                    <div class="mb-6 col-12 mb-0">
                                        <div class="alert alert-warning">
                                            <h5 class="alert-heading mb-1">Are you sure you want to delete your account?
                                            </h5>
                                            <p class="mb-0">Once you delete your account, there is no going back. Please
                                                be
                                                certain.
                                            </p>
                                        </div>
                                    </div>
                                    <form id="formAccountDeactivation" onsubmit="return false"
                                        class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                                        <div class="form-check my-8">
                                            <input class="form-check-input" type="checkbox" name="accountActivation"
                                                id="accountActivation">
                                            <label class="form-check-label" for="accountActivation">I confirm my account
                                                deactivation</label>
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-danger deactivate-account waves-effect waves-light"
                                            disabled="">Deactivate Account</button>
                                        <input type="hidden">
                                    </form>
                                </div>
                            </div> --}}
                        </div>
                        <div class="tab-pane fade" id="navs-justified-security" role="tabpanel">
                            <div class="card mb-6">
                                <h5 class="card-header">Change Password</h5>
                                <div class="card-body pt-1">
                                    <form action="{{ route('user-password.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-sm-6 mb-2">
                                            <div
                                                class="col-md-12 form-password-toggle form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="currentPassword">Current Password</label>
                                                <div class="input-group input-group-merge has-validation">
                                                    <input class="form-control" type="password" name="current_password"
                                                        id="currentPassword" placeholder="************">
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="icon-base ti tabler-eye-off icon-xs"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gy-sm-6 gy-2 mb-sm-0 mb-2">
                                            <div
                                                class="mb-6 col-md-6 form-password-toggle form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="newPassword">New Password</label>
                                                <div class="input-group input-group-merge has-validation">
                                                    <input class="form-control" type="password" id="newPassword"
                                                        name="password" placeholder="************">
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="icon-base ti tabler-eye-off icon-xs"></i></span>
                                                </div>
                                            </div>

                                            <div
                                                class="mb-6 col-md-6 form-password-toggle form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="confirmPassword">Confirm New
                                                    Password</label>
                                                <div class="input-group input-group-merge has-validation">
                                                    <input class="form-control" type="password"
                                                        name="password_confirmation" id="confirmPassword"
                                                        placeholder="************">
                                                    <span class="input-group-text cursor-pointer"><i
                                                            class="icon-base ti tabler-eye-off icon-xs"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="text-body">Password Requirements:</h6>
                                        <ul class="ps-4 mb-0">
                                            <li class="mb-4">Minimum 8 characters long - the more, the better</li>
                                            <li class="mb-4">At least one lowercase character</li>
                                            <li>At least one number, symbol, or whitespace character</li>
                                        </ul>
                                        <div class="mt-6">
                                            <button type="submit"
                                                class="btn btn-primary me-3 waves-effect waves-light">Save changes</button>
                                            <button type="reset"
                                                class="btn btn-label-secondary waves-effect">Reset</button>
                                        </div>
                                        <input type="hidden">
                                    </form>
                                </div>
                            </div>
                            <!--/ Change Password -->

                            <!-- Two-steps verification -->
                            {{-- <div class="card mb-6">
                                <div class="card-body">
                                    <h5 class="mb-6">Two-steps verification</h5>
                                    <h5 class="mb-4 text-body">Two factor authentication is not enabled yet.</h5>
                                    <p class="w-75">
                                        Two-factor authentication adds an additional layer of security to your account by
                                        requiring more than just a password to log in.
                                        <a href="javascript:void(0);" class="text-nowrap">Learn more.</a>
                                    </p>
                                    <button class="btn btn-primary mt-2 waves-effect waves-light" data-bs-toggle="modal"
                                        data-bs-target="#enableOTP">Enable Two-Factor Authentication</button>
                                </div>
                            </div> --}}

                            <!-- Modal -->
                            <!-- Enable OTP Modal -->
                            {{-- <div class="modal fade" id="enableOTP" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-simple modal-enable-otp modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                            <div class="text-center mb-6">
                                                <h4 class="mb-2">Enable One Time Password</h4>
                                                <p>Verify Your Mobile Number for SMS</p>
                                            </div>
                                            <p>Enter your mobile phone number with country code and we will send you a
                                                verification code.</p>
                                            <form id="enableOTPForm"
                                                class="row g-5 fv-plugins-bootstrap5 fv-plugins-framework"
                                                onsubmit="return false" novalidate="novalidate">
                                                <div class="col-12 form-control-validation fv-plugins-icon-container">
                                                    <label class="form-label" for="modalEnableOTPPhone">Phone
                                                        Number</label>
                                                    <div class="input-group has-validation">
                                                        <span class="input-group-text">US (+1)</span>
                                                        <input type="text" id="modalEnableOTPPhone"
                                                            name="modalEnableOTPPhone"
                                                            class="form-control phone-number-otp-mask"
                                                            placeholder="202 555 0111">
                                                    </div>
                                                    <div
                                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit"
                                                        class="btn btn-primary me-3 waves-effect waves-light">Submit</button>
                                                    <button type="reset" class="btn btn-label-secondary waves-effect"
                                                        data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                </div>
                                                <input type="hidden">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="card mb-6">
                                <h5 class="card-header">Recent Devices</h5>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-truncate">Browser</th>
                                                <th class="text-truncate">Device</th>
                                                <th class="text-truncate">Recent Activities</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sessions as $session)
                                                <tr>
                                                    <td class="text-truncate text-heading fw-medium">
                                                        @if ($session->agent->isDesktop())
                                                            <i
                                                                class="icon-base ti tabler-device-laptop icon-md align-top text-info me-2"></i>
                                                        @else
                                                            <i
                                                                class="icon-base ti tabler-device-mobile icon-md align-top text-info me-2"></i>
                                                        @endif

                                                        {{ $session->agent->browser() }} on
                                                        {{ $session->agent->platform() }}
                                                    </td>

                                                    <td class="text-truncate">
                                                        {{ $session->is_current_device ? 'This device' : $session->ip_address }}
                                                    </td>

                                                    <td class="text-truncate">{{ $session->last_active }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
