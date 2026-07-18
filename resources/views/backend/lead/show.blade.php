@extends('backend.layouts.app')

@section('title', __('Lead Details'))

@push('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/select2/select2.css" />
@endpush

@section('content')
    <div class="container-xxl container-p-y">
        <div
            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
            <div class="d-flex flex-column justify-content-center">
                <div class="mb-1">
                    <span class="h5">
                        {{ __('Lead Details') }}
                    </span>
                    <span class="badge bg-primary">
                        {{ $lead->leadStatus?->name }}
                    </span>
                </div>
                <p class="mb-0">
                    {{ __('Contacted Date') }} {{ date('d M Y', strtotime($lead->contacted_date)) }}
                </p>
            </div>
            <div class="d-flex align-content-center flex-wrap gap-2">
                <a href="{{ route('admin.lead.index') }}" class="btn btn-primary btn-xs">
                    <i class="icon-base bx bx-list-ul"></i>
                    {{ __('List') }}
                </a>
                <button class="btn btn-xs btn-success" title="{{ __('Assign Lead') }}" type="button" data-bs-toggle="modal"
                    data-bs-target="#assignedLeadModal">
                    <i class="icon-base bx bx-message-alt-add me-1"></i>
                </button>

                <button class="btn btn-info btn-xs" title="{{ __('Convert To Customer') }}" type="button"
                    data-bs-toggle="modal" data-bs-target="#convertCustomerModal">
                    <i class="icon-base bx bx-customize me-1"></i>
                </button>
                <button class="btn btn-warning btn-xs" title="{{ __('Change Status') }}" type="button"
                    data-bs-toggle="modal" data-bs-target="#changeStatusModal">
                    <i class="icon-base bx bx-edit-alt me-1"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="card mb-6">
                    <div class="card-header">
                        <h5 class="card-title m-0">Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                {{ __('Full Name') }}
                            </span>
                            <span class="info-value">
                                {{ $lead->first_name . ' ' . $lead->last_name }}
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                {{ __('Email') }}
                            </span>
                            <span class="info-value">
                                <a href="mailto:{{ $lead->email }}">{{ $lead->email }}</a>
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                {{ __('Phone') }}
                            </span>
                            <span class="info-value">
                                <a href="tel:{{ $lead->phone }}">{{ $lead->phone }}</a>
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                {{ __('Address') }}
                            </span>
                            <span class="info-value">
                                {{ $lead->address }}
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                {{ __('Contacted Date') }}
                            </span>
                            <span class="info-value">
                                {{ $lead->contacted_date }}
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                {{ __('Followup Date') }}
                            </span>
                            <span class="info-value">
                                {{ $lead->followup_date }}
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                {{ __('Appointment Date') }}
                            </span>
                            <span class="info-value">
                                {{ $lead->appointment_date }}
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                {{ __('Is Customer') }}
                            </span>
                            <span class="info-value badge {{ statusActiveClass($lead->is_customer) }}">
                                {{ $lead->is_customer }}
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                {{ __('Source') }}
                            </span>
                            <span class="info-value">
                                {{ $lead->source?->name }}
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                {{ __('Created By') }}
                            </span>
                            <span class="info-value">
                                {{ $lead->createdBy?->first_name . ' ' . $lead->createdBy?->last_name }}
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                {{ __('Updated By') }}
                            </span>
                            <span class="info-value">
                                {{ $lead->updatedBy?->first_name . ' ' . $lead->updatedBy?->last_name }}
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                {{ __('Created At') }}
                            </span>
                            <span class="info-value">
                                {{ $lead->created_at }}
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">
                                {{ __('Updated At') }}
                            </span>
                            <span class="info-value">
                                {{ $lead->updated_at }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="card mb-6">
                    <div class="card-header">
                        <h5 class="card-title m-0">Additional Information</h5>
                    </div>
                    <div class="card-body">
                        {!! $lead->additional_information !!}
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="card mb-6">
                    <div class="card-header">
                        <h5 class="card-title m-0">
                            Assignee List
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($lead->leadAssignees as $leadAssigne)
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar me-4">
                                        <img src="{{ imageDemoUserPath($leadAssigne?->user->avatar) }}"
                                            alt="{{ $leadAssigne?->user?->first_name }}" class="rounded-circle">
                                    </div>
                                    <div>
                                        <div>
                                            <h6 class="mb-0 text-truncate">
                                                {{ $leadAssigne?->user?->first_name . ' ' . $leadAssigne?->user?->last_name }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if ($lead->other_fields_information)
                    <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title m-0">
                                Other Fields Information
                            </h5>
                        </div>
                        <div class="card-body pt-1" style="max-height: 400px; overflow-y: auto;">
                            <ul class="timeline pb-0 mb-0">
                                @foreach ($lead->other_fields_information as $filedInfo)
                                    @php
                                        $filedInfo = (object) $filedInfo;
                                    @endphp
                                    <li class="timeline-item timeline-item-transparent border-primary">
                                        <span class="timeline-point timeline-point-primary"></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header">
                                                <h6 class="mb-0 text-truncate">
                                                    {{ __('QNA:') }} {{ $filedInfo->question }}
                                                </h6>
                                            </div>
                                            <p class="mt-3 text-success">
                                                {{ __('Ans:') }} {{ $filedInfo->answer }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="card mb-6">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title m-0">Tags</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $tags = is_array($lead->tags) ? $lead->tags : json_decode($lead->tags, true);
                        @endphp
                        @foreach ($tags ?? [] as $tag)
                            <p class="mb-0">
                                {{ $tag['value'] ?? '' }}
                            </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="changeStatusModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('Change Lead Status') }}
                            <small class="ms-2">
                                Lead Status:
                                <span class="badge bg-primary">
                                    {{ $lead->leadStatus?->name }}
                                </span>
                            </small>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.lead.status.change') }}" method="POST">
                        @csrf
                        <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        Status
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
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                {{ __('Close') }}
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="convertCustomerModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('Convert To Customer') }}
                            <small class="ms-2">
                                {{ __('Is Customer') }}
                                <span class="badge {{ statusActiveClass($lead->is_customer) }}">
                                    {{ $lead->is_customer }}
                                </span>
                            </small>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @if ($lead->is_customer == 'No')
                        <form action="{{ route('admin.lead.convert.customer') }}" method="POST">
                            @csrf
                            <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                            <div class="modal-body">
                                <div class="row">
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                    {{ __('Close') }}
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Convert') }}
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="modal-body text-center">
                            <h5 class="card-title mb-1">
                                {{ __('Lead Customer Information') }}
                            </h5>
                            <button class="btn btn-sm btn-info">
                                {{ __('Already Convert To Customer') }}
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="modal fade" id="assignedLeadModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <h5 class="modal-title">
                            {{ __('Assigned Lead') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.lead.assign') }}" method="POST">
                        @csrf
                        <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        Status
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
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                {{ __('Close') }}
                            </button>
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
@endpush
