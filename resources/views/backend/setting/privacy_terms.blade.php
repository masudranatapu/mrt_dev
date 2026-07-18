@extends('backend.layouts.app')

@section('title', __('Privacy And Terms'))

@push('style')
    <link href="{{ asset('backend/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-xxl container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            {{ __('Privacy And Terms Settings') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-1">
                            <div class="col-md-3">
                                <div class="nav flex-column nav-pills border">
                                    <button class="nav-link active mb-2" data-bs-toggle="pill"
                                        data-bs-target="#privacyAndPolicy">
                                        <i class="menu-icon bx bx-home"></i>
                                        {{ __('Privacy And Policy') }}
                                    </button>
                                    <button class="nav-link mb-2" data-bs-toggle="pill" data-bs-target="#termsAndCondition">
                                        <i class="menu-icon bx bx-info-circle"></i>
                                        {{ __('Terms And Condition') }}
                                    </button>
                                </div>
                            </div>

                            <!-- RIGHT CONTENT -->
                            <div class="col-md-9">
                                <div class="tab-content border p-3">
                                    {{-- home  --}}
                                    <div class="tab-pane fade show active" id="privacyAndPolicy">
                                        <form action="{{ route('admin.setting.privacy.terms.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="privacy">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Privacy Policy') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="privacy_policy" class="form-control summernote" cols="30" rows="5"
                                                        placeholder="{{ __('Privacy Policy') }}">{{ $setting->privacy_policy }}</textarea>
                                                    @error('privacy_policy')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- about --}}
                                    <div class="tab-pane fade" id="termsAndCondition">
                                        <form action="{{ route('admin.setting.privacy.terms.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="terms">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        {{ __('Terms And Condition') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="terms_condition" class="form-control summernote" cols="30" rows="5"
                                                        placeholder="{{ __('Terms And Condition') }}">{{ $setting->terms_condition }}</textarea>
                                                    @error('terms_condition')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/summernote/summernote-lite.min.js') }}"></script>
    <script>
        $('.summernote').summernote({
            tabsize: 2,
            height: 500,
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
    </script>
@endpush
