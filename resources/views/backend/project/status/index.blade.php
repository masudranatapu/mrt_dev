@extends('backend.layouts.app')

@section('title', __('Project Status'))

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
                            {{ __('Project Status') }}
                        </h5>
                        <div class="card-header-elements ms-auto">
                            <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal"
                                data-bs-target="#createDataModal">
                                <i class="icon-base bx bx-plus-circle"></i>
                                {{ __('Add New') }}
                            </button>
                        </div>
                    </div>
                    <div class="card-header">
                        <form action="{{ route('admin.project-status.index') }}" method="get">
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
                                        <a href="{{ route('admin.project-status.index') }}" class="btn btn-danger">
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
                                        <th>{{ __('SL No') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Color') }}</th>
                                        <th>{{ __('Total Project') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($projectStatus as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                <div title="{{ __('Click to copy color code') }}"
                                                    onclick="copyColorCode('{{ $data->color }}')"
                                                    style="height: 40px; width: 40px; cursor: pointer; background-color: {{ $data->color }};">
                                                </div>
                                            </td>
                                            <td>
                                                {{ $data->projects_count }}
                                            </td>
                                            <td>
                                                <span class="badge {{ statusActiveClass($data->status) }}">
                                                    {{ $data->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        onclick="editData('{{ route('admin.project-status.edit', $data->id) }}')"
                                                        class="btn btn-info btn-xs">
                                                        <i class="icon-base bx bx-edit-alt me-1"></i>
                                                    </button>
                                                    <button type="button"
                                                        onclick="deleteData('{{ route('admin.project-status.delete', $data->id) }}')"
                                                        class="btn btn-danger btn-xs">
                                                        <i class="icon-base bx bx-trash me-1"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{ $projectStatus->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="createDataModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="backDropModalTitle">
                            {{ __('Project Status') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.project-status.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Name') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        placeholder="{{ __('Name') }}" required />
                                    @error('name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Color') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="color" class="form-control" name="color" value="{{ old('color') }}"
                                        required />
                                    @error('color')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Status') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="status" class="form-control" required>
                                        <option value="Active" @if (old('status') == 'Active') selected @endif>
                                            {{ __('Active') }}
                                        </option>
                                        <option value="Inactive" @if (old('status') == 'Inactive') selected @endif>
                                            {{ __('Inactive') }}
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editModalData" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" id="showModalData">

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/sweetalert2/sweetalert2.js') }}"></script>
    <script>
        function copyColorCode(colorCode) {
            navigator.clipboard.writeText(colorCode).then(() => {
                iziToast.success({
                    message: "Color Successfully copied",
                    position: 'topRight'
                });
            }).catch(err => {
                iziToast.warning({
                    message: "Something went wrong with copy color. Please try again",
                    position: 'topRight'
                });
            });
        }
    </script>
    <script>
        function editData(routeUrl) {
            $.ajax({
                type: "GET",
                url: routeUrl,
                success: function(response) {

                    if (response.status) {
                        $("#editModalData").modal('show');
                        $("#showModalData").html(response.data);
                    } else {
                        iziToast.error({
                            message: response.message,
                            position: 'topRight'
                        });
                    }
                },
            });
        }
    </script>
    <script>
        $('form').on('submit', function(event) {
            const submitButton = $(this).find('button[type="submit"]');
            submitButton.prop('disabled', true);
            submitButton.html(`<span class="spinner-border me-1" role="status"></span>`);
        });
    </script>
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
