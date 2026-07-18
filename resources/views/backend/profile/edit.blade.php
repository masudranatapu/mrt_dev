@extends('backend.layouts.app')

@section('title', __('Admin Profile'))

@push('style')
    <link rel="stylesheet" href="{{ asset('backend/image_uploader/image-uploader.css') }}">
    <link rel="stylesheet" href="{{ asset('backend') }}/select2/select2.css" />
@endpush

@section('content')
    <div class="container-xxl container-p-y">
        @include('admin.profile.profile_head')
        <div class="row">
            <div class="col-md-12">
                <div class="card card-action mb-6">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">
                            {{ __('Profile Information') }}
                        </h5>
                    </div>
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('First Name') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="first_name" value="{{ authAdmin()->first_name }}"
                                        placeholder="{{ __('First Name') }}" class="form-control" required>
                                    @error('first_name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Last Name') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="last_name" value="{{ authAdmin()->last_name }}"
                                        placeholder="{{ __('Last Name') }}" class="form-control" required>
                                    @error('last_name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Username') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="username" value="{{ authAdmin()->username }}"
                                        placeholder="{{ __('Username') }}" class="form-control"
                                        onblur="checkAvailability('username', this.value, '#usernameCheck')" required>
                                    <span id="usernameCheck"></span>
                                    @error('username')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Email') }}
                                    </label>
                                    <input type="text" name="email" value="{{ authAdmin()->email }}" readonly disabled
                                        placeholder="{{ __('Email') }}" class="form-control"
                                        onblur="checkAvailability('email', this.value, '#emailCheck')">
                                    <span id="emailCheck"></span>
                                    @error('email')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Phone') }}
                                    </label>
                                    <input type="number" name="phone" value="{{ authAdmin()->phone }}" readonly disabled
                                        placeholder="{{ __('Phone') }}" class="form-control"
                                        onblur="checkAvailability('phone', this.value, '#phoneCheck')" required>
                                    <span id="phoneCheck"></span>
                                    @error('phone')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Country') }}
                                    </label>
                                    <input type="text" name="country" value="{{ authAdmin()->country }}"
                                        placeholder="{{ __('Country') }}" class="form-control">
                                    @error('country')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Present Address') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="present_address" placeholder="{{ __('Present Address') }}" class="form-control">{{ authAdmin()->present_address }}</textarea>
                                    @error('present_address')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Permanent Address') }}
                                    </label>
                                    <textarea name="permanent_address" placeholder="{{ __('Permanent Address') }}" class="form-control">{{ authAdmin()->permanent_address }}</textarea>
                                    @error('permanent_address')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Date of Birth') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="date_of_birth" value="{{ authAdmin()->date_of_birth }}"
                                        placeholder="{{ __('Date of Birth') }}" class="form-control" required>
                                    @error('date_of_birth')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Gender') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="gender" class="form-control select2" required>
                                        <option value="Male" @if (authAdmin()->gender == 'Male') selected @endif>
                                            {{ __('Male') }}
                                        </option>
                                        <option value="Female" @if (authAdmin()->gender == 'Female') selected @endif>
                                            {{ __('Female') }}
                                        </option>
                                        <option value="Other" @if (authAdmin()->gender == 'Other') selected @endif>
                                            {{ __('Other') }}
                                        </option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Designation') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="designation_id" class="form-control select2" required>
                                        <option value="" disabled>{{ __('Select Designation') }}</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->id }}"
                                                @if (authAdmin()->designation_id == $designation->id) selected @endif>
                                                {{ $designation->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('designation_id')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Department') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="department_id" class="form-control select2" required>
                                        <option value="" disabled>{{ __('Select Department') }}</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                @if (authAdmin()->department_id == $department->id) selected @endif>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Bio') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="bio" placeholder="{{ __('Bio') }}" class="form-control" required>{{ authAdmin()->bio }}</textarea>
                                    @error('bio')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Language') }}
                                    </label>
                                    <select name="language[]" id="department" class="form-control select2" multiple>
                                        <option value="">{{ __('Select Department') }}</option>
                                        @foreach (languageLists() as $language)
                                            <option value="{{ $language }}"
                                                @if (in_array($language, authAdmin()->language)) selected @endif>
                                                {{ $language }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('language')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Nid No') }}
                                    </label>
                                    <input type="number" name="nid_no" value="{{ authAdmin()->nid_no }}"
                                        placeholder="{{ __('NID No') }}" class="form-control">
                                    @error('nid_no')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        {{ __('Avatar') }}
                                    </label>
                                    <div class="adminAvatar"></div>
                                    @error('image')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">
                                        {{ __('NID') }}
                                    </label>
                                    <div class="adminNid"></div>
                                    @error('nid')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-header align-items-center">
                            <h5 class="card-action-title mb-0">
                                {{ __('Emergency Contact') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Person Name') }}
                                    </label>
                                    <input type="text" name="emergency_contact_person_name"
                                        value="{{ authAdmin()->emergency_contact_person_name }}"
                                        placeholder="{{ __('Person Name') }}" class="form-control">
                                    @error('emergency_contact_person_name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Person Address') }}
                                    </label>
                                    <input type="text" name="emergency_contact_person_address"
                                        value="{{ authAdmin()->emergency_contact_person_address }}"
                                        placeholder="{{ __('Person Address') }}" class="form-control">
                                    @error('emergency_contact_person_address')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Emergency Contact') }}
                                    </label>
                                    <input type="number" name="emergency_contact"
                                        value="{{ authAdmin()->emergency_contact }}"
                                        placeholder="{{ __('Emergency Contact') }}" class="form-control">
                                    @error('emergency_contact')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">
                                        {{ __('Signature') }}
                                    </label>
                                    <div class="adminSignature"></div>
                                    @error('signature')
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
    <script src="{{ asset('backend/image_uploader/image-uploader.js') }}"></script>
    <script src="{{ asset('backend') }}/select2/select2.js"></script>
    <script src="{{ asset('backend') }}/js/forms-selects.js"></script>
    <script>
        $('form').on('submit', function(event) {
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);
            submitButton.html(`<span class="spinner-border me-1" role="status"></span>`);
        });

        // image uploader 1
        var adminShowImage = @json(formatImagePath(authAdmin()->id, authAdmin()->avatar));
        $('.adminAvatar').imageUploader({
            preloaded: adminShowImage,
            imagesInputName: 'avatar',
            maxFiles: 1,
            isMultiple: false,
        });
        var adminNid = @json(formatImagePath(authAdmin()->id, authAdmin()->nid));
        $('.adminNid').imageUploader({
            preloaded: adminNid,
            imagesInputName: 'nid',
            maxFiles: 1,
            isMultiple: false,
        });

        var adminSignature = @json(formatImagePath(authAdmin()->id, authAdmin()->signature));
        $('.adminSignature').imageUploader({
            preloaded: adminSignature,
            imagesInputName: 'signature',
            maxFiles: 1,
            isMultiple: false,
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
@endpush
