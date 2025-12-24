<div>
    @if (isset($label))
        <label for="{{ $name }}" class="form-label">
            {{ $label }} @if (!empty($required))
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <textarea name="{{ $name }}" id="{{ $id ?? $name }}" class="form-control {{ $class }}"
        @if (!empty($required)) required @endif
        @if (!empty($placeholder)) placeholder="{{ $placeholder }}" @endif
        @if (!empty($disabled)) disabled @endif cols="" rows="{{ $rows }}">{{ old($name, $value) }}</textarea>

    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
