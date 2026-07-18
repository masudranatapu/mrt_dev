@extends('backend.layouts.app')

@section('title', __('Credentials Setting'))

@push('style')
@endpush

@section('content')
    <div class="container-xxl container-p-y">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="row">
                    @if ($settingInfo->mail_status == 'Active')
                        <div class="col-md-12">
                            <div class="card mb-6">
                                <div class="card-header">
                                    <div class="row  justify-content-between">
                                        <div class="col-md-5">
                                            <h5 class="card-title m-0 me-2">
                                                {{ __('Mail Configuration') }}
                                            </h5>
                                        </div>
                                        <div class="col-md-7">
                                            <form action="{{ route('admin.setting.send.test.mail') }}" method="POST">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="email" class="form-control" name="email" required
                                                        value="{{ old('email') }}" placeholder="{{ __('Email') }}">
                                                    <button class="btn btn-outline-primary" type="submit">
                                                        {{ __('Send Test Mail') }}
                                                    </button>
                                                </div>
                                                @error('email')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('admin.setting.mail.update') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row g-6">
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    {{ __('Email From Name') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="email_from_name"
                                                    value="{{ $setting->email_from_name }}" class="form-control">
                                                @error('email_from_name')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    {{ __('Email From Address') }}
                                                </label>
                                                <input type="text" name="email_from_address"
                                                    value="{{ $setting->email_from_address }}" class="form-control">
                                                @error('email_from_address')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    {{ __('Mailing Driver') }}
                                                </label>
                                                <div class="form-check">
                                                    <input name="mailing_driver"
                                                        @if ($setting->mailing_driver == 'smtp') checked @endif
                                                        class="form-check-input" type="radio" id="smtp_label"
                                                        value="smtp">
                                                    <label class="form-check-label" for="smtp_label">
                                                        {{ __('SMTP') }}
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input name="mailing_driver"
                                                        @if ($setting->mailing_driver == 'sendmail') checked @endif
                                                        class="form-check-input" type="radio" id="sendmail_label"
                                                        value="sendmail">
                                                    <label class="form-check-label" for="sendmail_label">
                                                        {{ __('Send Mail') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    {{ __('Mail Username') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="mail_username"
                                                    value="{{ $setting->mail_username }}" class="form-control">
                                                @error('mail_username')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    {{ __('Mail Password') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="mail_password"
                                                    value="{{ $setting->mail_password }}" class="form-control">
                                                @error('mail_password')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">
                                                    {{ __('SMTP Host') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="mail_host" value="{{ $setting->mail_host }}"
                                                    class="form-control">
                                                @error('mail_host')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">
                                                    {{ __('SMTP Port') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="mail_port" value="{{ $setting->mail_port }}"
                                                    class="form-control">
                                                @error('mail_port')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">
                                                    {{ __('Status') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select name="mail_secure" class="form-control">
                                                    <option value="tls"
                                                        @if ($setting->mail_secure == 'tls') selected @endif>
                                                        {{ __('tls') }}
                                                    </option>
                                                    <option value="ssl"
                                                        @if ($setting->mail_secure == 'ssl') selected @endif>
                                                        {{ __('ssl') }}
                                                    </option>
                                                </select>
                                                @error('mail_secure')
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
                                </form>
                            </div>
                        </div>
                    @endif
                    @if ($settingInfo->sms_status == 'Active')
                        <div class="col-md-12">
                            <div class="card mb-6">
                                <div class="card-header">
                                    <div class="row justify-content-between">
                                        <div class="col-md-5">
                                            <h5 class="card-title m-0 me-2">
                                                {{ __('SMS Credential') }}
                                            </h5>
                                        </div>
                                        <div class="col-md-7">
                                            <form action="{{ route('admin.setting.send.test.sms') }}" method="POST">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="phone_numbers"
                                                        required placeholder="{{ __('Phone Numbers') }}">
                                                    <button class="btn btn-outline-primary" type="submit">
                                                        {{ __('Send Test SMS') }}
                                                    </button>
                                                </div>
                                                <small>{{ __("Use ', ' for multiple phone numbers") }}</small>
                                                @error('phone_numbers')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('admin.setting.sms.update') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row g-6">
                                            <div class="col-md-6">
                                                <label class="form-label">
                                                    {{ __('SMS Username') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="sms_username"
                                                    value="{{ $setting->sms_username }}" class="form-control"
                                                    placeholder="{{ __('SMS Username') }}">
                                                @error('sms_username')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">
                                                    {{ __('SMS Password') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="sms_password"
                                                    value="{{ $setting->sms_password }}" class="form-control"
                                                    placeholder="{{ __('SMS Password') }}">
                                                @error('sms_password')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    {{ __('SMS Sender ID') }}
                                                </label>
                                                <input type="text" name="sms_sender_id"
                                                    value="{{ $setting->sms_sender_id }}" class="form-control"
                                                    placeholder="{{ __('SMS Sender ID') }}">
                                                @error('sms_sender_id')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    {{ __('SMS Api Key') }}
                                                </label>
                                                <input type="text" name="sms_api_key"
                                                    value="{{ $setting->sms_api_key }}" class="form-control"
                                                    placeholder="{{ __('SMS Api Key') }}">
                                                @error('sms_api_key')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    {{ __('SMS Base URL') }}
                                                </label>
                                                <input type="text" name="sms_base_url"
                                                    value="{{ $setting->sms_base_url }}" class="form-control"
                                                    placeholder="{{ __('SMS Base URL') }}">
                                                @error('sms_base_url')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    {{ __('SMS Type') }}
                                                </label>
                                                <input type="text" name="sms_type" value="{{ $setting->sms_type }}"
                                                    class="form-control" placeholder="{{ __('SMS Type') }}">
                                                @error('sms_type')
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
                                </form>
                            </div>
                        </div>
                    @endif
                    @if ($settingInfo->pusher_status == 'Active')
                        <div class="col-md-12">
                            <form action="{{ route('admin.setting.pusher.update') }}" method="POST">
                                @csrf
                                <div class="card mb-6">
                                    <div class="card-header header-elements">
                                        <h5 class="mb-0 me-2">
                                            {{ __('Pusher Credential') }}
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-6">
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    {{ __('Pusher App ID') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="pusher_app_id"
                                                    value="{{ $setting->pusher_app_id }}" class="form-control"
                                                    placeholder="{{ __('Pusher App ID') }}">
                                                @error('pusher_app_id')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    {{ __('Pusher Key') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="pusher_key"
                                                    value="{{ $setting->pusher_key }}" class="form-control"
                                                    placeholder="{{ __('Pusher Key') }}">
                                                @error('pusher_key')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    {{ __('Pusher Secret') }}
                                                </label>
                                                <input type="text" name="pusher_secret"
                                                    value="{{ $setting->pusher_secret }}" class="form-control"
                                                    placeholder="{{ __('Pusher Secret') }}">
                                                @error('pusher_secret')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">
                                                    {{ __('Pusher Cluster') }}
                                                </label>
                                                <input type="text" name="pusher_cluster"
                                                    value="{{ $setting->pusher_cluster }}" class="form-control"
                                                    placeholder="{{ __('Pusher Cluster') }}">
                                                @error('pusher_cluster')
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
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // submit
        $('form').on('submit', function(event) {
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);
            submitButton.html(`<span class="spinner-border me-1" role="status"></span>`);
        });
    </script>
@endpush
