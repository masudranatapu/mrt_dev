<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">
            {{ __('Edit Data') }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{ route('admin.lead-status.update', $leadStatus->id) }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        {{ __('Name') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="name" value="{{ $leadStatus->name }}"
                        placeholder="{{ __('Name') }}" required />
                    @error('name')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        {{ __('Color') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="color" class="form-control" name="color" value="{{ $leadStatus->color }}"
                        required />
                    @error('color')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        {{ __('Status') }}
                        <span class="text-danger">*</span>
                    </label>
                    <select name="status" class="form-control" required>
                        <option value="Active" @if ($leadStatus->status == 'Active') selected @endif>
                            {{ __('Active') }}
                        </option>
                        <option value="Inactive" @if ($leadStatus->status == 'Inactive') selected @endif>
                            {{ __('Inactive') }}
                        </option>
                    </select>
                    @error('status')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Send SMS') }}
                                    </label>
                                    <select name="send_sms" class="form-control">
                                        <option value="No" @if ($leadStatus->send_sms == 'No') selected @endif>
                                            {{ __('No') }}
                                        </option>
                                        <option value="Yes" @if ($leadStatus->send_sms == 'Yes') selected @endif>
                                            {{ __('Yes') }}
                                        </option>
                                    </select>
                                    @error('send_sms')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">
                                        {{ __('SMS Body') }}
                                    </label>
                                    <textarea name="sms_body" class="form-control" cols="30" rows="4" placeholder="{{ __('SMS Body') }}">{{ $leadStatus->sms_body }}</textarea>
                                    @error('sms_body')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">
                                        {{ __('Send SMS') }}
                                    </label>
                                    <select name="send_email" class="form-control">
                                        <option value="No" @if ($leadStatus->send_email == 'No') selected @endif>
                                            {{ __('No') }}
                                        </option>
                                        <option value="Yes" @if ($leadStatus->send_email == 'Yes') selected @endif>
                                            {{ __('Yes') }}
                                        </option>
                                    </select>
                                    @error('send_email')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">
                                        {{ __('Email Body') }}
                                    </label>
                                    <textarea name="email_body" class="form-control" cols="30" rows="4" placeholder="{{ __('Email Body') }}">{{ $leadStatus->email_body }}</textarea>
                                    @error('email_body')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
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
