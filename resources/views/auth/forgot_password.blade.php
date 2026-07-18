@extends('auth.auth_layout')

@section('title', __('Forgot Password'))

@section('content')
    <div class="authentication-wrapper">
        <!-- Logo -->
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
                    <img src="{{ asset('backend/demoimages/password-reset.png') }}" class="img-fluid scaleX-n1-rtl"
                        alt="Login image" width="700" />
                </div>
            </div>
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
                <div class="w-px-400 mx-auto mt-sm-12 mt-8">
                    <h4 class="mb-1">
                        {{ __('Forgot Password!') }}
                    </h4>
                    <p class="mb-6">
                        {{ __('Enter your email and we will send you reset password link') }}
                    </p>
                    <form class="mb-6" action="" method="POST">
                        @csrf
                        <div class="mb-6 form-control-validation">
                            <label class="form-label">
                                {{ __('Email') }}
                            </label>
                            <input type="email" class="form-control" name="email" placeholder="{{ __('Email') }}"
                                required />
                            @error('email')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary d-grid w-100">
                            {{ __('Send Reset Link') }}
                        </button>
                    </form>
                    <div class="text-center">
                        <a href="{{ route('admin.login') }}" class="d-flex align-items-center justify-content-center">
                            <i class="bx bx-chevron-left icon-20px scaleX-n1-rtl me-1_5 align-top"></i>
                            {{ __('Back to login') }}
                        </a>
                    </div>
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
