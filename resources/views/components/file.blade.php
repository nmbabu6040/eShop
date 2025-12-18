<div class="from-group mb-3">
    @if (isset($label))
        <label for="{{ $name }}" class="form-label">
           {{ $label }} @if (!empty($required)) <span class="text-danger">*</span> @endif
        </label>
    @endif

    <input
        type="file"
        name="{{ $name }}"
        id="{{ $id ?? $name }}"
        class="form-control {{ $class }}"
        placeholder="{{ $placeholder }}"
        onchange="previewFile(event, '{{ $preview }}')"
        @if (!empty($required)) required @endif
    >

    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<script>
    function previewFile(event, previewId) {
        const input = event.target;
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e){
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>
