@extends('backend.layouts.app')

@section('title', __('Blogs'))

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
                            {{ __('Blogs') }}
                        </h5>
                        <div class="card-header-elements ms-auto">
                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-xs  rounded-pill">
                                <i class="icon-base bx bx-plus-circle"></i>
                                {{ __('Add New') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-header">
                        <form action="" method="get">
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
                                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-danger">
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
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Thumbnail') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($blogs as $data)
                                        <tr>
                                            <td>
                                                {{ $data->title }}
                                            </td>
                                            <td>
                                                <img width="100" height="100" src="{{ asset($data->thumbnail) }}"
                                                    alt="{{ $data->title }}">
                                            </td>
                                            <td>
                                                <span class="badge {{ statusActiveClass($data->status) }}">
                                                    {{ $data->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-info btn-xs"
                                                        href="{{ route('admin.blogs.edit', $data->id) }}">
                                                        <i class="icon-base bx bx-edit-alt me-1"></i>
                                                    </a>
                                                    <a class="btn btn-success btn-xs" target="__blank"
                                                        href="{{ route('frontend.details', $data->slug) }}">
                                                        <i class="icon-base bx bx-low-vision me-1"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-xs" href="javascript:;"
                                                        onclick="deleteData('{{ route('admin.blogs.delete', $data->id) }}')">
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
                        {{ $blogs->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
        <form action="" method="POST" class="d-none" id="convert-customer-form">
            {{--  --}}
        </form>
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
