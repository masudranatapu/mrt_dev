@extends('backend.layouts.app')

@section('title', __('Subscribers'))

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
                            {{ __('Subscribers') }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <label>
                                                <input class="form-check-input" type="checkbox">
                                                {{ __('SL No') }}
                                            </label>
                                        </th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($subscribers as $key => $data)
                                        <tr>
                                            <td>
                                                <label>
                                                    <input value="{{ $data->id }}" class="form-check-input"
                                                        type="checkbox">
                                                    {{ $loop->iteration }}
                                                </label>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $data->email }}">
                                                    {{ $data->email }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        onclick="deleteData('{{ route('admin.subscribers.delete', $data->id) }}')"
                                                        class="btn btn-info btn-xs">
                                                        <i class="icon-base bx bx-envelope me-1"></i>
                                                    </button>
                                                    <button type="button"
                                                        onclick="deleteData('{{ route('admin.subscribers.delete', $data->id) }}')"
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
                        {{ $subscribers->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/sweetalert2/sweetalert2.js') }}"></script>
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
