<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">
            {{ __('Edit Team Member') }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">
                        {{ __('Avatar') }}
                    </label>
                    <div class="teamAvatarEdit"></div>
                    @error('avatar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        {{ __('Name') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="name" value="{{ $team->name }}"
                        placeholder="{{ __('Name') }}" required />
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        {{ __('Status') }}
                        <span class="text-danger">*</span>
                    </label>
                    <select name="status" class="form-control" required>
                        <option value="Active" @if ($team->status == 'Active') selected @endif>
                            {{ __('Active') }}
                        </option>
                        <option value="Inactive" @if ($team->status == 'Inactive') selected @endif>
                            {{ __('Inactive') }}
                        </option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        {{ __('Department') }}
                    </label>
                    <input type="text" class="form-control" name="department" value="{{ $team->department }}"
                        placeholder="{{ __('Department') }}" />
                    @error('department')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        {{ __('Designation') }}
                    </label>
                    <input type="text" class="form-control" name="designation" value="{{ $team->designation }}"
                        placeholder="{{ __('Designation') }}" />
                    @error('designation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        {{ __('Phone') }}
                    </label>
                    <input type="text" class="form-control" name="phone" value="{{ $team->phone }}"
                        placeholder="{{ __('Phone') }}" />
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        {{ __('Email') }}
                    </label>
                    <input type="email" class="form-control" name="email" value="{{ $team->email }}"
                        placeholder="{{ __('Email') }}" />
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">
                        {{ __('Address') }}
                    </label>
                    <input type="text" class="form-control" name="address" value="{{ $team->address }}"
                        placeholder="{{ __('Address') }}" />
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">
                        {{ __('Facebook') }}
                    </label>
                    <input type="text" class="form-control" name="facebook_link"
                        value="{{ $team->facebook_link }}" placeholder="https://facebook.com/..." />
                    @error('facebook_link')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">
                        {{ __('X (Twitter)') }}
                    </label>
                    <input type="text" class="form-control" name="x_link" value="{{ $team->x_link }}"
                        placeholder="https://x.com/..." />
                    @error('x_link')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">
                        {{ __('Instagram') }}
                    </label>
                    <input type="text" class="form-control" name="instagram_link"
                        value="{{ $team->instagram_link }}" placeholder="https://instagram.com/..." />
                    @error('instagram_link')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">
                        {{ __('LinkedIn') }}
                    </label>
                    <input type="text" class="form-control" name="linkedin_link"
                        value="{{ $team->linkedin_link }}" placeholder="https://linkedin.com/..." />
                    @error('linkedin_link')
                        <span class="text-danger">{{ $message }}</span>
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
<script>
    var teamAvatarEditShow = @json(formatImagePath($team->id, $team->avatar));
    $('.teamAvatarEdit').imageUploader({
        preloaded: teamAvatarEditShow,
        imagesInputName: 'avatar',
        maxFiles: 1,
        isMultiple: false,
    });
</script>
