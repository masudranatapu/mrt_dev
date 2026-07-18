@extends('backend.layouts.app')

@section('title', __('Admin Profile'))

@push('style')
@endpush

@section('content')
    <div class="container-xxl container-p-y">
        @include('admin.profile.profile_head')
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <div class="card mb-6">
                    <div class="card-body">
                        <small class="card-text text-uppercase text-body-secondary small">
                            Basic Information
                        </small>
                        <ul class="list-unstyled my-3 py-1">
                            <li class="d-flex justify-content-between mb-4">
                                <span>First Name</span>
                                <span>
                                    {{ $admin->first_name }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <span>Last Name</span>
                                <span>
                                    {{ $admin->last_name }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <span>Username</span>
                                <span>
                                    {{ $admin->username }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <span>Role</span>
                                <span>
                                    {{ $admin?->role?->name }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <span>Department</span>
                                <span>
                                    {{ $admin?->department?->name }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-2">
                                <span>Designation</span>
                                <span>
                                    {{ $admin?->designation?->name }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <span>Gender</span>
                                <span>
                                    {{ $admin->gender }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <span>Date of Birth</span>
                                <span>
                                    {{ $admin->date_of_birth }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-2">
                                <span>Status</span>
                                <span class="badge {{ statusActiveClass($admin->status) }}">
                                    {{ $admin->status }}
                                </span>
                            </li>
                        </ul>
                        <small class="card-text text-uppercase text-body-secondary small">
                            Contacts
                        </small>
                        <ul class="list-unstyled my-3 py-1">
                            <li class="d-flex justify-content-between mb-4">
                                <span>Email</span>
                                <span>
                                    <a href="mailto:{{ $admin->email }}">
                                        {{ $admin->email }}
                                    </a>
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <span>Phone</span>
                                <span>
                                    <a href="tel:{{ $admin->phone }}">
                                        {{ $admin->phone }}
                                    </a>
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <span title="Current Address">
                                    C. Address
                                </span>
                                <span>
                                    {{ $admin->present_address }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <span title="Permanent Address">
                                    P. Address
                                </span>
                                <span>
                                    {{ $admin->permanent_address }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <span>Country</span>
                                <span>
                                    {{ $admin->country }}
                                </span>
                            </li>
                        </ul>
                        <small class="card-text text-uppercase text-body-secondary small">
                            Emergency Contact
                        </small>
                        <ul class="list-unstyled mb-0 mt-3 pt-1">
                            <li class="d-flex justify-content-between mb-4">
                                <span class="fw-medium me-2">
                                    Name
                                </span>
                                <span>
                                    {{ $admin->emergency_contact_person_name }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <span class="fw-medium me-2">
                                    Address
                                </span>
                                <span>
                                    {{ $admin->emergency_contact_person_address }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span class="fw-medium me-2">
                                    Contact Info
                                </span>
                                <span>
                                    {{ $admin->emergency_contact }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card mb-6">
                    <div class="card-body">
                        <small class="card-text text-uppercase text-body-secondary small">
                            Other Stats
                        </small>
                        <ul class="list-unstyled mb-0 mt-3 pt-1">
                            <li class="d-flex justify-content-between mb-4">
                                <span>Is Email Verified</span>
                                <span class="badge {{ statusActiveClass($admin->is_email_verified ? 'Yes' : 'No') }}">
                                    {{ $admin->is_email_verified ? 'Yes' : 'No' }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <span>Is Phone Verified</span>
                                <span class="badge {{ statusActiveClass($admin->is_phone_verified ? 'Yes' : 'No') }}">
                                    {{ $admin->is_phone_verified ? 'Yes' : 'No' }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-4">
                                <span>Language</span>
                                <span>
                                    @foreach ($admin->language as $lang)
                                        <span class="badge bg-success">
                                            {{ $lang }}
                                        </span>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mb-2">
                                <span>NID NO</span>
                                <span>
                                    {{ $admin->nid_no }}
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mt-3">
                                <span>NID</span>
                                <span>
                                    <div class="avatar avatar me-2 me-sm-4 rounded-2 bg-label-secondary">
                                        <a href="{{ asset($admin->nid) }}" target="__blank" title="Click for preview">
                                            <img src="{{ imageDemoUserPath($admin->nid) }}" alt="NID Image"
                                                class="rounded">
                                        </a>
                                    </div>
                                </span>
                            </li>
                            <li class="d-flex justify-content-between mt-3">
                                <span>Signature</span>
                                <span>
                                    <div class="avatar avatar me-2 me-sm-4 rounded-2 bg-label-secondary">
                                        <a href="{{ asset($admin->signature) }}" target="__blank"
                                            title="Click for preview">
                                            <img src="{{ imageDemoUserPath($admin->signature) }}" alt="Signature Image"
                                                class="rounded">
                                        </a>
                                    </div>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7">
                <div class="card mb-6">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">
                            Profile Statistics
                        </h5>
                    </div>
                    <div class="card-body pt-3">
                        <div class="row g-3">
                            <div class="col-lg-4 col-sm-6">
                                <div class="card card-border-shadow-primary h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="avatar me-4">
                                                <span class="avatar-initial rounded bg-label-primary">
                                                    <i class="icon-base bx bxs-truck icon-lg"></i>
                                                </span>
                                            </div>
                                            <h4 class="mb-0">
                                                {{ $admin?->projectAssignees?->count() }}
                                            </h4>
                                        </div>
                                        <p class="mb-0">
                                            {{ __('Project Assignees') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card card-border-shadow-warning h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="avatar me-4">
                                                <span class="avatar-initial rounded bg-label-warning">
                                                    <i class="icon-base bx bx-error icon-lg"></i>
                                                </span>
                                            </div>
                                            <h4 class="mb-0">
                                                {{ $admin?->customerAssignees->count() }}
                                            </h4>
                                        </div>
                                        <p class="mb-0">
                                            {{ __('Customer Assignees') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card card-border-shadow-danger h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="avatar me-4">
                                                <span class="avatar-initial rounded bg-label-danger">
                                                    <i class="icon-base bx bx-git-repo-forked icon-lg"></i>
                                                </span>
                                            </div>
                                            <h4 class="mb-0">
                                                {{ $admin?->supportTicketAssignees?->count() }}
                                            </h4>
                                        </div>
                                        <p class="mb-0">
                                            {{ __('Support Ticket Assignees') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card card-border-shadow-info h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="avatar me-4">
                                                <span class="avatar-initial rounded bg-label-info">
                                                    <i class="icon-base bx bx-time-five icon-lg"></i>
                                                </span>
                                            </div>
                                            <h4 class="mb-0">
                                                {{ $admin?->taskAssignees?->count() }}
                                            </h4>
                                        </div>
                                        <p class="mb-0">
                                            {{ __('Late vehicles') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card card-border-shadow-warning h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="avatar me-4">
                                                <span class="avatar-initial rounded bg-label-warning">
                                                    <i class="icon-base bx bx-error icon-lg"></i>
                                                </span>
                                            </div>
                                            <h4 class="mb-0">
                                                {{ $admin?->invoiceAssignees?->count() }}
                                            </h4>
                                        </div>
                                        <p class="mb-0">
                                            {{ __('Invoice Assignees') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card card-border-shadow-primary h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <div class="avatar me-4">
                                                <span class="avatar-initial rounded bg-label-primary">
                                                    <i class="icon-base bx bxs-truck icon-lg"></i>
                                                </span>
                                            </div>
                                            <h4 class="mb-0">
                                                {{ $admin?->todos->count() }}
                                            </h4>
                                        </div>
                                        <p class="mb-0">
                                            {{ __('My ToDo') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-6">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">
                            My Activity Timeline
                        </h5>
                    </div>
                    <div class="card-body pt-3" style="max-height: 300px; overflow-y: auto;">
                        <ul class="timeline mb-0">
                            @foreach ($admin->activityLogs as $activityLog)
                                <li class="timeline-item timeline-item-transparent">
                                    <span class="timeline-point timeline-point-primary"></span>
                                    <div class="timeline-event">
                                        <div class="timeline-header mb-3">
                                            <h6 class="mb-0">{{ $activityLog->title }}</h6>
                                            <small class="text-body-secondary">
                                                {{ $activityLog->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        <p class="mb-0">
                                            {{ $activityLog->description }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
