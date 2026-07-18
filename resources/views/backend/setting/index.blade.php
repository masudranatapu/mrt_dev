@extends('backend.layouts.app')

@section('title', __('Site Setting'))

@push('style')
    <link rel="stylesheet" href="{{ asset('backend/image_uploader/image-uploader.css') }}">
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/libs/tagify/tagify.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/select2/select2.css" />
@endpush

@section('content')
    <div class="container-xxl container-p-y">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card mb-6">
                        <div class="card-header header-elements">
                            <h5 class="mb-0 me-2">
                                {{ __('Basic Setting') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Site Title') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="site_title"
                                        placeholder="{{ __('Site Title') }}" value="{{ $setting->site_title }}">
                                    @error('site_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Site Email') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="site_email"
                                        placeholder="{{ __('Site Email') }}" value="{{ $setting->site_email }}">
                                    @error('site_email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Phone') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="phone"
                                        placeholder="{{ __('Phone') }}" value="{{ $setting->phone }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Address') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="address"
                                        placeholder="{{ __('Address') }}" value="{{ $setting->address }}">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Site Currency') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="site_currency"
                                        placeholder="{{ __('Site Currency') }}" value="{{ $setting->site_currency }}">
                                    @error('site_currency')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Copyright Text') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                        name="copyright_text"placeholder="{{ __('Copyright Text') }}"
                                        value="{{ $setting->copyright_text }}">
                                    @error('copyright_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Currency symbol') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="currency_symbol"
                                        placeholder="{{ __('Currency Symbol') }}" value="{{ $setting->currency_symbol }}">
                                    @error('currency_symbol')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Site Timezone') }}
                                </label>
                                <div class="col-sm-9">
                                    <select name="site_timezone" class="form-control select2">
                                        @foreach (timezones() as $timezone)
                                            <option value="{{ $timezone['name'] }}"
                                                @if ($timezone['name'] == $setting->site_timezone) selected @endif>
                                                {{ $timezone['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('site_timezone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Site Logo') }}
                                </label>
                                <div class="col-sm-9">
                                    <div class="siteLogo"></div>
                                    @error('site_logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Site Favicon') }}
                                </label>
                                <div class="col-sm-9">
                                    <div class="siteFavicon"></div>
                                    @error('site_favicon')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Support Email') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="support_email"
                                        placeholder="{{ __('Support Email') }}" value="{{ $setting->support_email }}">
                                    @error('support_email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Session Lifetime') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="session_lifetime"
                                        placeholder="{{ __('Session Lifetime') }}"
                                        value="{{ $setting->session_lifetime }}">
                                    @error('session_lifetime')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Session Expired') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="session_expired"
                                        placeholder="{{ __('Session Expired') }}"
                                        value="{{ $setting->session_expired }}">
                                    @error('session_expired')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Default Check In') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control" name="default_checkin"
                                        value="{{ $setting->default_checkin }}">
                                    @error('default_checkin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Default Check Out') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="time" class="form-control" name="default_checkout"
                                        value="{{ $setting->default_checkout }}">
                                    @error('default_checkout')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Site Default Language') }}
                                </label>
                                <div class="col-sm-9">
                                    <select name="default_lang" class="form-control select2">
                                        <option value="ar" @if ($setting->default_lang == 'ar') selected @endif>
                                            {{ __('Arabic') }}
                                        </option>
                                        <option value="bn" @if ($setting->default_lang == 'bn') selected @endif>
                                            {{ __('Bengali') }}
                                        </option>
                                        <option value="en" @if ($setting->default_lang == 'en') selected @endif>
                                            {{ __('English') }}
                                        </option>
                                    </select>
                                    @error('default_lang')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Google Drive Folder ID') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="google_drive_folder_id"
                                        placeholder="Google Drive Folder ID"
                                        value="{{ $setting->google_drive_folder_id }}">
                                    @error('google_drive_folder_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('DB Backup Email') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="backup_email"
                                        placeholder="{{ __('DB Backup Email') }}" value="{{ $setting->backup_email }}">
                                    @error('backup_email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Weekends') }}
                                </label>
                                <div class="col-sm-9">
                                    <select name="weekends[]" class="form-control select2" multiple>
                                        @foreach (weekDays() as $weekDay)
                                            <option value="{{ $weekDay }}"
                                                {{ in_array($weekDay, $setting->weekends ?? []) ? 'selected' : '' }}>
                                                {{ $weekDay }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('weekends')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Youtube Link') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="youtube_link"
                                        placeholder="{{ __('Youtube link') }}" value="{{ $setting->youtube_link }}">
                                    @error('youtube_link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Facebook Link') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="facebook_link"
                                        placeholder="{{ __('Facebook link') }}" value="{{ $setting->facebook_link }}">
                                    @error('facebook_link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('X Link') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="x_link"
                                        placeholder="{{ __('X link') }}" value="{{ $setting->x_link }}">
                                    @error('x_link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Linkedin Link') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="linkedin_link"
                                        placeholder="{{ __('Linkedin Link') }}" value="{{ $setting->linkedin_link }}">
                                    @error('linkedin_link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">
                                    {{ __('Instagram Link') }}
                                </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="instagram_link"
                                        placeholder="{{ __('Instagram link') }}" value="{{ $setting->instagram_link }}">
                                    @error('instagram_link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-8">
                <form action="{{ route('admin.setting.permission.update') }}" method="POST">
                    @csrf
                    <div class="card mb-6">
                        <div class="card-header header-elements">
                            <h5 class="mb-0 me-2">
                                {{ __('Permission Setting') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <label>{{ __('Email Verification') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="emailVerification1">
                                            <input @if ($setting->email_verification == 'Yes') checked @endif
                                                name="email_verification" class="form-check-input" type="radio"
                                                value="Yes" id="emailVerification1">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('Yes') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="emailVerification2">
                                            <input @if ($setting->email_verification == 'No') checked @endif
                                                name="email_verification" class="form-check-input" type="radio"
                                                value="No" id="emailVerification2">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('No') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <label>{{ __('Phone Verification') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="phoneVerification1">
                                            <input @if ($setting->phone_verification == 'Yes') checked @endif
                                                name="phone_verification" class="form-check-input" type="radio"
                                                value="Yes" id="phoneVerification1">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('Yes') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="phoneVerification2">
                                            <input @if ($setting->phone_verification == 'No') checked @endif
                                                name="phone_verification" class="form-check-input" type="radio"
                                                value="No" id="phoneVerification2">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('No') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <label>{{ __('OTP Verification') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="otpVerification1">
                                            <input @if ($setting->otp_verification == 'Yes') checked @endif name="otp_verification"
                                                class="form-check-input" type="radio" value="Yes"
                                                id="otpVerification1">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('Yes') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="otpVerification2">
                                            <input @if ($setting->otp_verification == 'No') checked @endif name="otp_verification"
                                                class="form-check-input" type="radio" value="No"
                                                id="otpVerification2">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('No') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <label>{{ __('Theme Mood') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="themeMood1">
                                            <input @if ($setting->theme_mood == 'light') checked @endif name="theme_mood"
                                                class="form-check-input" type="radio" value="light" id="themeMood1">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('Light') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="themeMood2">
                                            <input @if ($setting->theme_mood == 'dark') checked @endif name="theme_mood"
                                                class="form-check-input" type="radio" value="dark" id="themeMood2">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('Dark') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <label>{{ __('Mail Status') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="mailStatus1">
                                            <input @if ($setting->mail_status == 'Active') checked @endif name="mail_status"
                                                class="form-check-input" type="radio" value="Active" id="mailStatus1">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('Active') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="mailStatus2">
                                            <input @if ($setting->mail_status == 'Inactive') checked @endif name="mail_status"
                                                class="form-check-input" type="radio" value="Inactive"
                                                id="mailStatus2">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('Inactive') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <label>{{ __('Pusher Status') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="pusherStatus1">
                                            <input @if ($setting->pusher_status == 'Active') checked @endif name="pusher_status"
                                                class="form-check-input" type="radio" value="Active"
                                                id="pusherStatus1">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('Active') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="pusherStatus2">
                                            <input @if ($setting->pusher_status == 'Inactive') checked @endif name="pusher_status"
                                                class="form-check-input" type="radio" value="Inactive"
                                                id="pusherStatus2">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('Inactive') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <label>{{ __('SMS Status') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="smsStatus1">
                                            <input @if ($setting->sms_status == 'Active') checked @endif name="sms_status"
                                                class="form-check-input" type="radio" value="Active" id="smsStatus1">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('Active') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="smsStatus2">
                                            <input @if ($setting->sms_status == 'Inactive') checked @endif name="sms_status"
                                                class="form-check-input" type="radio" value="Inactive"
                                                id="smsStatus2">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('Inactive') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2 mb-3">
                                <div class="col-md-4">
                                    <label>{{ __('Debug Mode') }}</label>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="debugMode1">
                                            <input @if ($setting->debug_mode == 'Yes') checked @endif name="debug_mode"
                                                class="form-check-input" type="radio" value="Yes" id="debugMode1">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('Yes') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="debugMode2">
                                            <input @if ($setting->debug_mode == 'No') checked @endif name="debug_mode"
                                                class="form-check-input" type="radio" value="No" id="debugMode2">
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">{{ __('No') }}</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-8">
                <form action="{{ route('admin.setting.meta.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card mb-6">
                        <div class="card-header header-elements">
                            <h5 class="mb-0 me-2">
                                {{ __('Meta Setting') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-6">
                                <div class="col-md-12">
                                    <label class="form-label">
                                        {{ __('Meta Title') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="meta_title" value="{{ $setting->meta_title }}"
                                        placeholder="{{ __('Meta Title') }}" class="form-control">
                                    @error('meta_title')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">
                                        {{ __('Meta Image') }}
                                    </label>
                                    <div class="metaImage"></div>
                                    @error('meta_image')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">{{ __('Meta Keywords') }}</label>
                                    <input class="form-control" name="meta_keywords"
                                        value="{{ $setting->meta_keywords }}" placeholder="{{ __('Tags') }}" />
                                    @error('meta_keywords')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">
                                        {{ __('Meta Description') }}
                                    </label>
                                    <textarea class="form-control" name="meta_description" rows="4" placeholder="{{ __('Meta Description') }}">{{ $setting->meta_description }}</textarea>
                                    @error('meta_description')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/image_uploader/image-uploader.js') }}"></script>
    <script src="{{ asset('backend') }}/vendor/libs/tagify/tagify.js"></script>
    <script src="{{ asset('backend') }}/select2/select2.js"></script>
    <script src="{{ asset('backend') }}/js/forms-selects.js"></script>
    <script>
        var metaKeywords = document.querySelector('input[name=meta_keywords]');

        new Tagify(metaKeywords);
        // image uploader 1
        var siteLogoShowImage = @json(formatImagePath($setting->id, $setting->site_logo));
        $('.siteLogo').imageUploader({
            preloaded: siteLogoShowImage,
            imagesInputName: 'site_logo',
            maxFiles: 1,
            isMultiple: false,
        });
        // image uploader 2
        var siteFaviconShowImage = @json(formatImagePath($setting->id, $setting->site_favicon));
        $('.siteFavicon').imageUploader({
            preloaded: siteFaviconShowImage,
            imagesInputName: 'site_favicon',
            maxFiles: 1,
            isMultiple: false,
        });
        // image uploader 3
        var metaImageShowImage = @json(formatImagePath($setting->id, $setting->meta_image));
        $('.metaImage').imageUploader({
            preloaded: metaImageShowImage,
            imagesInputName: 'meta_image',
            maxFiles: 1,
            isMultiple: false,
        });
        // submit
        $('form').on('submit', function(event) {
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);
            submitButton.html(`<span class="spinner-border me-1" role="status"></span>`);
        });
    </script>
@endpush
