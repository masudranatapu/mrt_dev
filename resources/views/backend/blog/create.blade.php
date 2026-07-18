@extends('backend.layouts.app')

@section('title', __('Create Blog'))

@push('style')
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
                            {{ __('Create Blog') }}
                        </h5>
                        <div class="card-header-elements ms-auto">
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary btn-xs  rounded-pill">
                                <i class="icon-base bx bx-list-ul"></i>
                                {{ __('List') }}
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">
                                        {{ __('Title') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ old('title') }}" name="title"
                                        placeholder="{{ __('Title') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        {{ __('Status') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="status" class="form-control select2">
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
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Thumbnail') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="blogThumbnail"></div>
                                    @error('thumbnail')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Description') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="description" class="form-control summernote">{{ old('description') }}</textarea>
                                    @error('description')
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
        // image uploader 1
        $('.blogThumbnail').imageUploader({
            imagesInputName: 'thumbnail',
            maxFiles: 1,
            isMultiple: false,
        });
    </script>
    <script>
        $('form').on('submit', function(event) {
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);
            submitButton.html(`<span class="spinner-border me-1" role="status"></span>`);
        });
    </script>
@endpush
