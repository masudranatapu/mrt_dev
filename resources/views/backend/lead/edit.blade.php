@extends('backend.layouts.app')

@section('title', __('Edit Lead'))

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
                            {{ __('Edit Lead') }}
                        </h5>
                        <div class="card-header-elements ms-auto">
                            <a href="{{ route('admin.lead.index') }}" class="btn btn-primary btn-xs  rounded-pill">
                                <i class="icon-base bx bx-list-ul"></i>
                                {{ __('List') }}
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('admin.lead.update', $lead->id) }}" method="POST">
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
                                                @if ($lead->lead_status_id == $leadStatue->id) selected @endif>
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
                                                @if ($lead->source_id == $source->id) selected @endif>
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
                                                {{ in_array($user->id, json_decode($lead->leadAssignees->pluck('user_id'))) ? 'selected' : '' }}>
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
                                    <input type="text" class="form-control" value="{{ $lead->first_name }}" required
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
                                    <input type="text" class="form-control" value="{{ $lead->last_name }}" required
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
                                    <input type="date" class="form-control" value="{{ $lead->contacted_date }}" required
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
                                    <input type="email" class="form-control" value="{{ $lead->email }}" name="email"
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
                                    <input type="number" class="form-control" value="{{ $lead->phone }}" name="phone"
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
                                    <input type="text" class="form-control" value="{{ $lead->address }}" name="address"
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
                                    <input type="text" class="form-control" value="{{ $lead->city }}" name="city"
                                        required placeholder="{{ __('City') }}">
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Zip Code') }}
                                    </label>
                                    <input type="text" class="form-control" value="{{ $lead->zip_code }}"
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
                                    <input type="text" class="form-control" value="{{ $lead->country }}" required
                                        name="country" placeholder="{{ __('Country') }}">
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Additional Information') }}
                                    </label>
                                    <textarea name="additional_information" class="form-control" cols="30" rows="4"
                                        placeholder="{{ __('Additional Information') }}">{{ $lead->additional_information }}</textarea>
                                    @error('additional_information')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">
                                        {{ __('Tags') }}
                                    </label>
                                    <input type="text" name="tags" value="{{ $lead->tags }}"
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
                                        <option value="Active" @if ($lead->status == 'Active') selected @endif>
                                            {{ __('Active') }}
                                        </option>
                                        <option value="Inactive" @if ($lead->status == 'Inactive') selected @endif>
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
