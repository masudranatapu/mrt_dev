@extends('backend.layouts.app')

@section('title', __('Project Details'))

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
                        {{ $project->name }}
                    </span>
                    @if ($project->projectStatus)
                        <span class="badge" style="background-color: {{ $project->projectStatus->color }}">
                            {{ $project->projectStatus->name }}
                        </span>
                    @endif
                </div>
                <p class="mb-0">
                    {{ __('Code') }}: {{ $project->unique_code }}
                </p>
            </div>
            <div class="d-flex align-content-center flex-wrap gap-2">
                <a href="{{ route('admin.project.index') }}" class="btn btn-primary btn-xs">
                    <i class="icon-base bx bx-list-ul"></i>
                    {{ __('List') }}
                </a>
                <a href="{{ route('admin.project.edit', $project->id) }}" class="btn btn-info btn-xs">
                    <i class="icon-base bx bx-edit-alt me-1"></i>
                    {{ __('Edit') }}
                </a>
                <button class="btn btn-warning btn-xs" title="{{ __('Change Status') }}" type="button"
                    data-bs-toggle="modal" data-bs-target="#changeStatusModal">
                    <i class="icon-base bx bx-refresh me-1"></i>
                </button>
                <button class="btn btn-success btn-xs" title="{{ __('Update Followup Date') }}" type="button"
                    data-bs-toggle="modal" data-bs-target="#followupDateModal">
                    <i class="icon-base bx bx-calendar me-1"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="card mb-6">
                    <img src="{{ imageDemoPath($project->project_thumbnail) }}" class="card-img-top"
                        alt="{{ $project->name }}">
                    <div class="card-header">
                        <h5 class="card-title m-0">{{ __('Basic Information') }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">{{ __('Client') }}</span>
                            <span class="info-value">{{ $project->client?->name ?? '-' }}</span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">{{ __('Start Date') }}</span>
                            <span class="info-value">{{ $project->start_date?->format('d M Y') }}</span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">{{ __('End Date') }}</span>
                            <span class="info-value">{{ $project->end_date?->format('d M Y') }}</span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">{{ __('Followup Date') }}</span>
                            <span class="info-value">{{ $project->followup_date?->format('d M Y') ?? '-' }}</span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">{{ __('Status') }}</span>
                            <span class="info-value badge {{ statusActiveClass($project->status) }}">
                                {{ $project->status }}
                            </span>
                        </p>
                        @if ($project->project_document)
                            <p class="d-flex justify-content-between align-items-center">
                                <span class="info-label">{{ __('Document') }}</span>
                                <span class="info-value">
                                    <a href="{{ asset($project->project_document) }}" target="_blank">
                                        {{ __('View PDF') }}
                                    </a>
                                </span>
                            </p>
                        @endif
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">{{ __('Created By') }}</span>
                            <span class="info-value">
                                {{ $project->createdBy?->first_name . ' ' . $project->createdBy?->last_name }}
                            </span>
                        </p>
                        <p class="d-flex justify-content-between align-items-center">
                            <span class="info-label">{{ __('Updated By') }}</span>
                            <span class="info-value">
                                {{ $project->updatedBy?->first_name . ' ' . $project->updatedBy?->last_name }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="card mb-6">
                    <div class="card-header">
                        <h5 class="card-title m-0">{{ __('Description') }}</h5>
                    </div>
                    <div class="card-body">
                        {!! $project->description !!}
                    </div>
                </div>
                @if ($project->galleries->count())
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-title m-0">{{ __('Gallery') }}</h5>
                        </div>
                        <div class="card-body d-flex flex-wrap gap-2">
                            @foreach ($project->galleries as $gallery)
                                <a href="{{ asset($gallery->image) }}" target="_blank">
                                    <img src="{{ asset($gallery->image) }}" width="120" height="90"
                                        class="rounded border" alt="gallery">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-12 col-lg-5">
                <div class="card mb-6">
                    <div class="card-header">
                        <h5 class="card-title m-0">{{ __('Assignee List') }}</h5>
                    </div>
                    <div class="card-body">
                        @forelse ($project->assignees as $assignee)
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar me-4">
                                        <img src="{{ imageDemoUserPath($assignee->avatar) }}"
                                            alt="{{ $assignee->first_name }}" class="rounded-circle">
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-truncate">
                                            {{ $assignee->first_name . ' ' . $assignee->last_name }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="mb-0 text-muted">{{ __('No assignees yet.') }}</p>
                        @endforelse
                    </div>
                </div>
                @if (!empty($project->technology))
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-title m-0">{{ __('Technology') }}</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($project->technology as $tech)
                                <span class="badge bg-label-primary me-1 mb-1">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (!empty($project->key_features))
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-title m-0">{{ __('Key Features') }}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="mb-0">
                                @foreach ($project->key_features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                @if (!empty($project->tags))
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-title m-0">{{ __('Tags') }}</h5>
                        </div>
                        <div class="card-body">
                            @foreach ($project->tags as $tag)
                                <span class="badge bg-label-secondary me-1 mb-1">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="modal fade" id="changeStatusModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('Change Project Status') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.project.status.change') }}" method="POST">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Status') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="project_status_id" class="form-control select2" required>
                                        @foreach ($projectStatuses as $projectStatus)
                                            <option value="{{ $projectStatus->id }}"
                                                @if ($project->project_status_id == $projectStatus->id) selected @endif>
                                                {{ $projectStatus->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('project_status_id')
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
        <div class="modal fade" id="followupDateModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ __('Update Followup Date') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.project.followup.date') }}" method="POST">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Followup Date') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control" name="followup_date"
                                        value="{{ $project->followup_date?->format('Y-m-d') }}" required>
                                    @error('followup_date')
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
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend') }}/select2/select2.js"></script>
    <script src="{{ asset('backend') }}/js/forms-selects.js"></script>
    <script>
        $('form').on('submit', function(event) {
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);
            submitButton.html(`<span class="spinner-border me-1" role="status"></span>`);
        });
    </script>
@endpush
