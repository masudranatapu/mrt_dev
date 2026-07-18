<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">
            {{ __('Edit Data') }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{ route('admin.project-status.update', $projectStatus->id) }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">
                        {{ __('Name') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="name" value="{{ $projectStatus->name }}"
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
                    <input type="color" class="form-control" name="color" value="{{ $projectStatus->color }}"
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
                        <option value="Active" @if ($projectStatus->status == 'Active') selected @endif>
                            {{ __('Active') }}
                        </option>
                        <option value="Inactive" @if ($projectStatus->status == 'Inactive') selected @endif>
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
