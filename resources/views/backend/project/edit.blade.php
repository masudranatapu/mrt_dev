@extends('backend.layouts.app')

@section('title', __('Edit Project'))

@push('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/select2/select2.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/vendor/libs/tagify/tagify.css" />
    <link rel="stylesheet" href="{{ asset('backend/image_uploader/image-uploader.css') }}">
    <link href="{{ asset('backend/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-xxl container-p-y">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header header-elements">
                        <h5 class="mb-0 me-2">
                            {{ __('Edit Project') }}
                            <small class="ms-2 text-muted">{{ $project->unique_code }}</small>
                        </h5>
                        <div class="card-header-elements ms-auto">
                            <a href="{{ route('admin.project.index') }}" class="btn btn-primary btn-xs rounded-pill">
                                <i class="icon-base bx bx-list-ul"></i>
                                {{ __('List') }}
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('admin.project.update', $project->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Project Status') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="project_status_id" class="form-control select2" required>
                                        @foreach ($projectStatuses as $projectStatus)
                                            <option value="{{ $projectStatus->id }}"
                                                @if (old('project_status_id', $project->project_status_id) == $projectStatus->id) selected @endif>
                                                {{ $projectStatus->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('project_status_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Client') }}
                                    </label>
                                    <select name="client_id" class="form-control select2">
                                        <option value="">{{ __('Select Client') }}</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}"
                                                @if (old('client_id', $project->client_id) == $client->id) selected @endif>
                                                {{ $client->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Status') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="status" class="form-control select2" required>
                                        <option value="Active" @if (old('status', $project->status) == 'Active') selected @endif>
                                            {{ __('Active') }}
                                        </option>
                                        <option value="Inactive" @if (old('status', $project->status) == 'Inactive') selected @endif>
                                            {{ __('Inactive') }}
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">
                                        {{ __('Project Name') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ old('name', $project->name) }}"
                                        name="name" placeholder="{{ __('Project Name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Assignee') }}
                                    </label>
                                    <select name="assignee_ids[]" class="form-control select2" multiple>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ in_array($user->id, old('assignee_ids', $project->team_ids ?? [])) ? 'selected' : '' }}>
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
                                        {{ __('Start Date') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control"
                                        value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}"
                                        required name="start_date">
                                    @error('start_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('End Date') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control"
                                        value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}" required
                                        name="end_date">
                                    @error('end_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Followup Date') }}
                                    </label>
                                    <input type="date" class="form-control"
                                        value="{{ old('followup_date', $project->followup_date?->format('Y-m-d')) }}"
                                        name="followup_date">
                                    @error('followup_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Project Thumbnail') }}
                                    </label>
                                    <div class="projectThumbnail"></div>
                                    @error('project_thumbnail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Project Document (PDF)') }}
                                    </label>
                                    <input type="file" class="form-control" name="project_document"
                                        accept="application/pdf">
                                    @if ($project->project_document)
                                        <a href="{{ asset($project->project_document) }}" target="_blank"
                                            class="d-inline-block mt-2">
                                            <i class="icon-base bx bx-file me-1"></i>{{ __('View current document') }}
                                        </a>
                                    @endif
                                    @error('project_document')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Add More Gallery Images') }}
                                    </label>
                                    <input type="file" class="form-control" name="gallery[]" multiple
                                        accept="image/*">
                                    @if ($project->galleries->count())
                                        <div class="d-flex flex-wrap gap-2 mt-2">
                                            @foreach ($project->galleries as $gallery)
                                                <img src="{{ asset($gallery->image) }}" width="70" height="70"
                                                    class="rounded border" alt="gallery">
                                            @endforeach
                                        </div>
                                    @endif
                                    @error('gallery')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Description') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="description" class="form-control summernote">{{ old('description', $project->description) }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Technology') }}
                                    </label>
                                    <input type="text" name="technology"
                                        value="{{ old('technology', implode(',', $project->technology ?? [])) }}"
                                        class="form-control" placeholder="{{ __('Technology') }}">
                                    @error('technology')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Key Features') }}
                                    </label>
                                    <input type="text" name="key_features"
                                        value="{{ old('key_features', implode(',', $project->key_features ?? [])) }}"
                                        class="form-control" placeholder="{{ __('Key Features') }}">
                                    @error('key_features')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Tags') }}
                                    </label>
                                    <input type="text" name="tags"
                                        value="{{ old('tags', implode(',', $project->tags ?? [])) }}"
                                        class="form-control" placeholder="{{ __('Tags') }}">
                                    @error('tags')
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
    <script src="{{ asset('backend/image_uploader/image-uploader.js') }}"></script>
    <script src="{{ asset('backend/summernote/summernote-lite.min.js') }}"></script>
    <script>
        $('.summernote').summernote({
            placeholder: 'Description',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        // thumbnail uploader
        var projectThumbnailShow = @json(formatImagePath($project->id, $project->project_thumbnail));
        $('.projectThumbnail').imageUploader({
            preloaded: projectThumbnailShow,
            imagesInputName: 'project_thumbnail',
            maxFiles: 1,
            isMultiple: false,
        });
        // tagify
        new Tagify(document.querySelector('input[name=technology]'));
        new Tagify(document.querySelector('input[name=key_features]'));
        new Tagify(document.querySelector('input[name=tags]'));
    </script>
    <script>
        $('form').on('submit', function(event) {
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);
            submitButton.html(`<span class="spinner-border me-1" role="status"></span>`);
        });
    </script>
@endpush
