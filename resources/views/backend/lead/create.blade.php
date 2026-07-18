@extends('backend.layouts.app')

@section('title', __('Create New Lead'))

@push('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/select2/select2.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/libs/tagify/tagify.css" />
@endpush
@section('content')
    <div class="container-xxl container-p-y">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header header-elements">
                        <h5 class="mb-0 me-2">
                            {{ __('Create New Lead') }}
                        </h5>
                        <div class="card-header-elements ms-auto">
                            <a href="{{ route('admin.lead.index') }}" class="btn btn-primary btn-xs  rounded-pill">
                                <i class="icon-base bx bx-list-ul"></i>
                                {{ __('List') }}
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('admin.lead.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Lead Status') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="lead_status_id" class="form-control select2" required>
                                        @foreach ($leadStatues as $leadStatue)
                                            <option value="{{ $leadStatue->id }}"
                                                @if (old('lead_status_id') == $leadStatue->id) selected @endif>
                                                {{ $leadStatue->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('lead_status_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Source') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="source_id" class="form-control select2" required>
                                        @foreach ($sources as $source)
                                            <option value="{{ $source->id }}"
                                                @if (old('source_id') == $source->id) selected @endif>
                                                {{ $source->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('source_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Assignee') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="assignee_ids[]" class="form-control select2" required multiple>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ in_array($user->id, old('assignee_ids', [])) ? 'selected' : '' }}>
                                                {{ $user->first_name . ' ' . $user->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('assignee_ids')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('First Name') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ old('first_name') }}" required
                                        name="first_name" placeholder="{{ __('First Name') }}">
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Last Name') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ old('last_name') }}" required
                                        name="last_name" placeholder="{{ __('Last Name') }}">
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Contacted Date') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control" value="{{ old('contacted_date') }}" required
                                        name="contacted_date">
                                    @error('contacted_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Email') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control" value="{{ old('email') }}" name="email"
                                        required placeholder="{{ __('Email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Phone') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" value="{{ old('phone') }}" name="phone"
                                        required placeholder="{{ __('Phone') }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Address') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ old('address') }}" name="address"
                                        required placeholder="{{ __('Address') }}">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('City') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ old('city') }}" name="city"
                                        required placeholder="{{ __('City') }}">
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Zip Code') }}
                                    </label>
                                    <input type="text" class="form-control" value="{{ old('zip_code') }}"
                                        name="zip_code" placeholder="{{ __('Zip Code') }}">
                                    @error('zip_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Country') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ old('country') }}" required
                                        name="country" placeholder="{{ __('Country') }}">
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Is Customer') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="is_customer" class="form-control select2" required>
                                        <option value="No" @if (old('is_customer') == 'No') selected @endif>
                                            {{ __('No') }}
                                        </option>
                                        <option value="Yes" @if (old('is_customer') == 'Yes') selected @endif>
                                            {{ __('Yes') }}
                                        </option>
                                    </select>
                                    @error('is_customer')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Followup Date') }}
                                    </label>
                                    <input type="date" class="form-control" value="{{ old('followup_date') }}"
                                        name="followup_date">
                                    @error('followup_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Appointment Date') }}
                                    </label>
                                    <input type="date" class="form-control" value="{{ old('appointment_date') }}"
                                        required name="appointment_date">
                                    @error('appointment_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Additional Information') }}
                                    </label>
                                    <textarea name="additional_information" class="form-control" cols="30" rows="4"
                                        placeholder="{{ __('Additional Information') }}">{{ old('additional_information') }}</textarea>
                                    @error('additional_information')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">
                                        {{ __('Tags') }}
                                    </label>
                                    <input type="text" name="tags" value="{{ old('tags') }}"
                                        class="form-control" placeholder="{{ __('Tags') }}">
                                    @error('tags')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Status') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="status" class="form-control select2" required>
                                        <option value="Active" @if (old('status') == 'Active') selected @endif>
                                            {{ __('Active') }}
                                        </option>
                                        <option value="Inactive" @if (old('status') == 'Inactive') selected @endif>
                                            {{ __('Inactive') }}
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
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
    <script src="{{ asset('backend') }}/select2/select2.js"></script>
    <script src="{{ asset('backend') }}/js/forms-selects.js"></script>
    <script src="{{ asset('backend') }}/vendor/libs/tagify/tagify.js"></script>
    <script>
        $('form').on('submit', function(event) {
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);
            submitButton.html(`<span class="spinner-border me-1" role="status"></span>`);
        });
        // tagify
        var metaKeywords = document.querySelector('input[name=tags]');
        new Tagify(metaKeywords);
    </script>
@endpush
