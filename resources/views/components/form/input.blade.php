<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input name="{{ $name }}" type="{{ $type }}" id="{{ $id }}" value="{{ $value ?? '' }}"
        class="form-control @error($name) is-invalid @enderror" placeholder="{{ $placeholder ?? 'Enter ' . $label }}">
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
