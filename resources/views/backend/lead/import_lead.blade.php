@extends('backend.layouts.app')

@section('title', __('Import Leads'))

@push('style')
@endpush

@section('content')
    <div class="container-xxl container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements">
                        <h5 class="mb-0 me-2">
                            {{ __('Leads') }}
                        </h5>
                        <div class="card-header-elements ms-auto">
                            <a href="{{ route('admin.lead.download.sheet') }}"
                                class="btn btn-info btn-xs rounded-pill mt-2 mt-sm-0 ms-sm-2">
                                <i class="icon-base bx bx-import me-2"></i>
                                {{ __('Download Demo File') }}
                            </a>
                            <a href="{{ route('admin.lead.index') }}" class="btn btn-primary btn-xs  rounded-pill">
                                <i class="icon-base bx bx-list-ul"></i>
                                {{ __('List') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Upload Card --}}
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <form action="{{ route('admin.lead.import.data') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <label class="form-label">
                                                {{ __('Lead File') }}
                                                <small class="text-muted">(csv/xlsx)</small>
                                                <span class="text-danger">*</span>
                                            </label>

                                            <div class="input-group">
                                                <input type="file" name="file" class="form-control"
                                                    accept=".csv,.xlsx" required>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-upload me-1"></i> Upload
                                                </button>
                                            </div>

                                            <small class="text-muted">Mimes: csv, xlsx</small>

                                            @error('file')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </form>
                                    </div>
                                </div>

                                {{-- Success Message --}}
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        <strong>{{ session('success') }}</strong><br>
                                        Total Uploaded: {{ session('total_upload') }}
                                    </div>
                                @endif

                                {{-- Duplicate Records --}}
                                @if (session('duplicates') && count(session('duplicates')) > 0)
                                    <div class="card">
                                        <div class="card-header bg-danger text-white">
                                            Duplicate Records ({{ count(session('duplicates')) }})
                                        </div>

                                        <div class="card-body p-0" style="max-height: 250px; overflow-y: auto;">
                                            <ul class="list-group list-group-flush">
                                                @foreach (session('duplicates') as $duplicate)
                                                    @php $duplicate = (object) $duplicate; @endphp

                                                    <li class="list-group-item small">
                                                        <strong>{{ $duplicate->first_name }}
                                                            {{ $duplicate->last_name }}</strong><br>
                                                        <span class="text-muted">
                                                            {{ $duplicate->email }} | {{ $duplicate->phone }}
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            <div class="col-md-6">
                                <div class="list-group shadow-sm">
                                    @foreach (leadRuleLists() as $field => $rules)
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1 fw-semibold">{{ $field }}</h6>
                                            </div>
                                            <span class="badge bg-danger text-white rounded-pill">
                                                {{ Str::upper(implode(', ', $rules)) }}
                                            </span>
                                        </div>
                                    @endforeach
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
@endpush
