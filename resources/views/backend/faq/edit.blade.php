<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="backDropModalTitle">
            {{ __('Edit Data') }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label">
                        {{ __('Faq Question') }}
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="question" value="{{ $faq->question }}"
                        placeholder="{{ __('Faq Question') }}" />
                    @error('question')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">
                        {{ __('Status') }}
                        <span class="text-danger">*</span>
                    </label>
                    <select name="status" class="form-control">
                        <option value="Active" @if ($faq->status == 'Active') selected @endif>
                            {{ __('Active') }}
                        </option>
                        <option value="Inactive" @if ($faq->status == 'Inactive') selected @endif>
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
                    <label class="form-label">
                        {{ __('Answer') }}
                        <span class="text-danger">*</span>
                    </label>
                    <textarea name="answer" class="form-control" cols="30" rows="3" placeholder="{{ __('Answer') }}">{{ $faq->answer }}</textarea>
                    @error('answer')
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
<script>
    $('form').on('submit', function(event) {
        const submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true);
        submitButton.html(`<span class="spinner-border me-1" role="status"></span>`);
    });
</script>
