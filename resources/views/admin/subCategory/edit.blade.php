@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Edit Sub-Category</h5>
                    </div>
                    <a class="btn btn-primary btn-sm d-flex justify-content-between align-items-center gap-2"
                        href="{{ route('subCategory.index') }}"><i class="fas fa-arrow-left"></i>Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('subCategory.update', $subCategory->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" value="{{ $subCategory?->name }}" id="categoryName"
                                placeholder="Sub Category Name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="form-label">Slug</label>
                            <input type="text" name="slug" value="{{ $subCategory?->slug }}" id="categorySlug"
                                placeholder="Sub Category Slug" class="form-control">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="form-label">Category</label>
                            <select name="category" id="category" class="form-contol form-select">
                                <option value="">Select Category</option>
                                @foreach ($categories ?? [] as $category)
                                    <option value="{{ $category?->id }}"
                                        {{ ($subCategory?->category_id ?? old('category')) == $category?->id ? 'selected' : '' }}>
                                        {{ $category?->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="subCategoryImage" class="form-label">Thumbnail</label> <br>
                            <img src="{{ $subCategory?->thumbnail }}" alt="" width="120"
                                id="subCategoryImageprv" class="mb-2">
                            <input type="file" name="image" id="subCategoryImage" class="form-control"
                                onchange="validateImage(this)">
                            <span class="text-danger" id="imageError"></span>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4 text-center">
                            <button type="submit" class="btn btn-primary" id="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function validateImage(input) {
            const file = input.files[0];
            const errorMessgae = document.getElementById('imageError');
            const imgePrv = document.getElementById('subCategoryImageprv');
            const submit = document.getElementById('submit');
            errorMessgae.textContent = '';

            if (file) {
                const imageSize = file.size / (1024 * 1024);
                if (imageSize > 2) {
                    errorMessgae.textContent = 'Image size must be less then 2MB';
                    imgePrv.src = URL.createObjectURL(file);
                    submit.disabled = true;
                } else {
                    imgePrv.src = URL.createObjectURL(file);
                    submit.disabled = false;
                }

            }
        }
    </script>
@endpush
