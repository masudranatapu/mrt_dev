@extends('backend.layouts.app')

@section('title', __('Admin Profile'))

@push('style')
@endpush

@section('content')
    <div class="container-xxl container-p-y">
        @include('admin.profile.profile_head')
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card card-action mb-6">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">
                            {{ __('Change Password') }}
                        </h5>
                    </div>
                    <form action="{{ route('admin.profile.change.password') }}" method="POST">
                        @csrf
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="passwordToggle">
                                        <label class="form-label">
                                            {{ __('Old Password') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="old_password"
                                                placeholder="{{ __('Old Password') }}" />
                                            <span class="input-group-text cursor-pointer">
                                                <i class="icon-base bx bx-hide"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('old_password')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="passwordToggle">
                                        <label class="form-label">
                                            {{ __('New Password') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password"
                                                placeholder="{{ __('New Password') }}" />
                                            <span class="input-group-text cursor-pointer">
                                                <i class="icon-base bx bx-hide"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="passwordToggle">
                                        <label class="form-label">
                                            {{ __('Confirmed Password') }}
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password_confirmation"
                                                placeholder="{{ __('Confirmed Password') }}" />
                                            <span class="input-group-text cursor-pointer">
                                                <i class="icon-base bx bx-hide"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card card-action mb-6">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">
                            {{ __('Verify User') }}
                        </h5>
                        @if (authAdmin()->is_email_verified == 'Yes')
                            <div class="alert alert-success">
                                <i class='menu-icon icon-base bx bx-check-shield'></i>
                                {{ __('Verified') }}
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <i class='menu-icon icon-base bx bxs-user-x'></i>
                                {{ __('Unverified') }}
                            </div>
                        @endif
                    </div>
                    <form action="{{ route('admin.profile.verify.user') }}" method="POST">
                        @csrf
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Select Type For Verify') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <select name="type" class="form-control">
                                            <option value="email">{{ __('Email') }}</option>
                                            <option value="phone">{{ __('Phone') }}</option>
                                        </select>
                                        <button class="btn btn-outline-success" type="button"
                                            onclick="getVerifyUserOtpCode(this, this.closest('.input-group').querySelector('select[name=type]').value, '#otpMessage')">
                                            {{ __('Get OTP Code') }}
                                        </button>
                                    </div>
                                    <span id="otpMessage"></span>
                                    @error('email')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">
                                        {{ __('OTP Code') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="otp_code" placeholder="{{ __('OTP Code') }}"
                                        class="form-control">
                                    @error('otp_code')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card card-action mb-6">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">
                            {{ __('Change Email') }}
                        </h5>
                    </div>
                    <form action="{{ route('admin.profile.change.email') }}" method="POST">
                        @csrf
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Email') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="email" class="form-control otp-value" name="email"
                                            placeholder="{{ __('Email address') }}"
                                            onblur="checkAvailability('email', this.value, '#emailMessage')">
                                        <button class="btn btn-outline-success" type="button"
                                            onclick="getOtpCode(this, 'email', '#emailMessage')">
                                            {{ __('Get OTP Code') }}
                                        </button>
                                    </div>
                                    <span id="emailMessage"></span>
                                    @error('email')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">
                                        {{ __('OTP Code') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="otp_code" placeholder="{{ __('OTP Code') }}"
                                        class="form-control">
                                    @error('otp_code')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card card-action mb-6">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">
                            {{ __('Change Phone') }}
                        </h5>
                    </div>
                    <form action="{{ route('admin.profile.change.phone') }}" method="POST">
                        @csrf
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Phone') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control otp-value" name="phone"
                                            placeholder="{{ __('Phone number') }}"
                                            onblur="checkAvailability('phone', this.value, '#phoneMessage')" />
                                        <button class="btn btn-outline-success" type="button"
                                            onclick="getOtpCode(this, 'phone', '#phoneMessage')">
                                            Get OTP Code
                                        </button>
                                    </div>
                                    <span id="phoneMessage"></span>
                                    @error('phone')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">
                                        {{ __('OTP Code') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="otp_code" value=""
                                        placeholder="{{ __('OTP Code') }}" class="form-control">
                                    @error('otp_code')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('form').on('submit', function(event) {
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);
            submitButton.html(`<span class="spinner-border me-1" role="status"></span>`);
        });
    </script>

    <script>
        function checkAvailability(type, value, resultDiv) {

            if (!value) {
                $(resultDiv).html('');
                return;
            }

            $.ajax({
                url: "{{ route('admin.profile.check.user') }}",
                type: "GET",
                data: {
                    type: type,
                    value: value
                },
                success: function(response) {
                    if (response.status) {
                        $(resultDiv).html(
                            `<span class="text-success">${response.message}</span>`
                        );
                    } else {
                        $(resultDiv).html(
                            `<span class="text-danger">${response.message}</span>`
                        );
                    }
                }
            });
        }
    </script>
    <script>
        function getOtpCode(button, type, messageSelector) {

            let value = $(`input[name="${type}"]`).val();

            if (!value && messageSelector != '#otpMessage') {
                $(messageSelector).html(`<span class="text-danger">Please enter ${type}</span>`);
                return;
            }

            $(button).prop('disabled', true).html('Sending OTP...');

            $.ajax({
                url: "{{ route('admin.profile.send.otp') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: type,
                    email: type === 'email' ? value : null,
                    phone: type === 'phone' ? value : null
                },
                success: function(response) {

                    $(button).prop('disabled', false).html('Get OTP Code');

                    if (response.status) {
                        $(messageSelector).html(
                            `<span class="text-success">${response.message}</span>`
                        );
                    } else {
                        $(messageSelector).html(
                            `<span class="text-danger">${response.message}</span>`
                        );
                    }

                },
                error: function(xhr) {

                    $(button).prop('disabled', false).html('Get OTP Code');

                    if (xhr.status === 422) {

                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '';

                        $.each(errors, function(key, value) {
                            errorHtml += `<div class="text-danger">${value[0]}</div>`;
                        });

                        $(messageSelector).html(errorHtml);

                    } else {
                        $(messageSelector).html(
                            `<span class="text-danger">Something went wrong. Please try again.</span>`
                        );
                    }
                }
            });
        }
    </script>
    <script>
        function getVerifyUserOtpCode(button, type, messageSelector) {

            $(button).prop('disabled', true).html('Sending OTP...');

            $.ajax({
                url: "{{ route('admin.profile.get.otp') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    type: type,
                },
                success: function(response) {

                    $(button).prop('disabled', false).html('Get OTP Code');

                    if (response.status) {
                        $(messageSelector).html(
                            `<span class="text-success">${response.message}</span>`
                        );
                    } else {
                        $(messageSelector).html(
                            `<span class="text-danger">${response.message}</span>`
                        );
                    }

                },
                error: function(xhr) {

                    $(button).prop('disabled', false).html('Get OTP Code');

                    if (xhr.status === 422) {

                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '';

                        $.each(errors, function(key, value) {
                            errorHtml += `<div class="text-danger">${value[0]}</div>`;
                        });

                        $(messageSelector).html(errorHtml);

                    } else {
                        $(messageSelector).html(
                            `<span class="text-danger">Something went wrong. Please try again.</span>`
                        );
                    }
                }
            });
        }
    </script>
@endpush
