@extends('backend.layouts.app')

@section('title', __('Projects'))

@push('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/sweetalert2/sweetalert2.css" />
@endpush

@section('content')
    <div class="container-xxl container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements">
                        <h5 class="mb-0 me-2">
                            {{ __('Projects') }}
                        </h5>
                        <div class="card-header-elements ms-auto">
                            <div class="btn-group">
                                <a title="{{ __('Export (CSV)') }}"
                                    href="{{ route('admin.project.export.data', ['type' => 'csv']) }}"
                                    class="btn btn-success btn-xs rounded-pill">
                                    <i class="icon-base bx bx-export me-2"></i>
                                    {{ __('CSV') }}
                                </a>
                            </div>
                            <a href="{{ route('admin.project.create') }}" class="btn btn-primary btn-xs rounded-pill mt-2 mt-sm-0 ms-sm-2">
                                <i class="icon-base bx bx-plus-circle"></i>
                                {{ __('Add New') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-header">
                        <form action="{{ route('admin.project.index') }}" method="get">
                            <div class="row justify-content-center g-2">
                                <div class="col-sm-2">
                                    <select name="per_page" class="form-control">
                                        <option value="10" @if (request('per_page') == 10) selected @endif>
                                            {{ __('10') }}
                                        </option>
                                        <option value="25" @if (request('per_page') == 25) selected @endif>
                                            {{ __('25') }}
                                        </option>
                                        <option value="50" @if (request('per_page') == 50) selected @endif>
                                            {{ __('50') }}
                                        </option>
                                        <option value="100" @if (request('per_page') == 100) selected @endif>
                                            {{ __('100') }}
                                        </option>
                                        <option value="200" @if (request('per_page') == 200) selected @endif>
                                            {{ __('200') }}
                                        </option>
                                        <option value="500" @if (request('per_page') == 500) selected @endif>
                                            {{ __('500') }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select name="status" class="form-control">
                                        <option value="All" @if (request('status') == 'All') selected @endif>
                                            {{ __('All') }}
                                        </option>
                                        <option value="Active" @if (request('status') == 'Active') selected @endif>
                                            {{ __('Active') }}
                                        </option>
                                        <option value="Inactive" @if (request('status') == 'Inactive') selected @endif>
                                            {{ __('Inactive') }}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" name="keyword" value="{{ request('keyword') }}"
                                        class="form-control" placeholder="{{ __('Searching...') }}">
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Search') }}
                                    </button>
                                    @if (request()->query())
                                        <a href="{{ route('admin.project.index') }}" class="btn btn-danger">
                                            {{ __('Clear') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Project') }}</th>
                                        <th>{{ __('Client') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Start Date') }}</th>
                                        <th>{{ __('End Date') }}</th>
                                        <th>{{ __('Active') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($projects as $data)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <img width="45" height="45" class="rounded me-2"
                                                        src="{{ imageDemoPath($data->project_thumbnail) }}"
                                                        alt="{{ $data->name }}">
                                                    <div class="d-flex flex-column">
                                                        <span class="text-truncate">{{ $data->name }}</span>
                                                        <small class="text-muted">{{ $data->unique_code }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $data->client?->name }}
                                            </td>
                                            <td>
                                                @if ($data->projectStatus)
                                                    <span class="badge"
                                                        style="background-color: {{ $data->projectStatus->color }}">
                                                        {{ $data->projectStatus->name }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $data->start_date?->format('d M Y') }}
                                            </td>
                                            <td>
                                                {{ $data->end_date?->format('d M Y') }}
                                            </td>
                                            <td>
                                                <span class="badge {{ statusActiveClass($data->status) }}">
                                                    {{ $data->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-success btn-xs"
                                                        href="{{ route('admin.project.show', $data->id) }}">
                                                        <i class="icon-base bx bx-low-vision me-1"></i>
                                                    </a>
                                                    <a class="btn btn-info btn-xs"
                                                        href="{{ route('admin.project.edit', $data->id) }}">
                                                        <i class="icon-base bx bx-edit-alt me-1"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-xs" href="javascript:;"
                                                        onclick="deleteData('{{ route('admin.project.delete', $data->id) }}')">
                                                        <i class="icon-base bx bx-trash me-1"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $projects->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/sweetalert2/sweetalert2.js') }}"></script>
    <script>
        function deleteData(routeUrl) {
            const deleteForm = $('#delete-form');
            Swal.fire({
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('Once deleted, you will not be able to recover this record!') }}",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "{{ __('Yes, delete it!') }}",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-success",
                },
                buttonsStyling: !1,
            }).then(function(t) {
                if (t.isConfirmed) {
                    deleteForm.attr('action', routeUrl);
                    deleteForm.submit();
                } else {
                    Swal.fire({
                        title: "{{ __('Cancelled') }}",
                        text: "{{ __('Your data is safe :)') }}",
                        icon: "error",
                        customClass: {
                            confirmButton: "btn btn-success"
                        },
                    });
                }
            });
        }
    </script>
@endpush
