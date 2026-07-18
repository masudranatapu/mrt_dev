@extends('auth.auth_layout')

@section('title', __('Reset Password'))

@section('content')
    <div class="authentication-wrapper">
        <a href="{{ route('frontend.index') }}" class="app-brand auth-cover-brand gap-2">
            <span class="app-brand-logo">
                <span class="text-primary">
                    {{ $settingInfo->site_title }}
                </span>
            </span>
        </a>
        <div class="authentication-inner row m-0">
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center p-5">
                <div class="w-100 d-flex justify-content-center">
                    <img src="{{ asset('backend/demoimages/password-reset.png') }}" class="img-fluid" alt="Login image"
                        width="700" />
                </div>
            </div>
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
                <div class="w-px-400 mx-auto mt-sm-12 mt-8">
                    <h4 class="mb-1">
                        {{ $settingInfo->site_title . ' ' . __('Reset Password') }}
                    </h4>
                    <p class="mb-6">
                        {{ __('Please reset your password for access your dashboard') }}
                    </p>
                    <form class="mb-6" method="POST" action="{{ route('admin.reset.password') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->get('token') }}">
                        <div class="form-password-toggle form-control-validation passwordToggle">
                            <label class="form-label">
                                {{ __('Password') }}
                            </label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" name="password"
                                    placeholder="{{ __('Password') }}" />
                                <span class="input-group-text cursor-pointer">
                                    <i class="icon-base bx bx-hide"></i>
                                </span>
                            </div>
                            @error('password')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-password-toggle form-control-validation passwordToggle">
                            <label class="form-label">
                                {{ __('Confirm Password') }}
                            </label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" name="password_confirmation"
                                    placeholder="{{ __('Confirm Password') }}" />
                                <span class="input-group-text cursor-pointer">
                                    <i class="icon-base bx bx-hide"></i>
                                </span>
                            </div>
                            @error('password_confirmation')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="my-3"></div>
                        <button class="btn btn-primary d-grid w-100" type="submit">
                            Reset Password
                        </button>
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
@endpush
