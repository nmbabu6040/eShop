@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Edit Category</h5>
                    <a class="btn btn-primary btn-sm d-flex justify-content-between align-items-center gap-2"
                        href="{{ route('category.index') }}"><i class="fas fa-arrow-left"></i>Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $category->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Category Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                value="{{ $category->slug }}">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="categoryImage" class="form-label">Category Image</label> <br>
                            <img src="{{ $category?->thumbnail }}" alt="" width="80" id="categoryImageprv"
                                class="mb-2">
                            <input type="file" name="image" id="categoryImage" class="form-control"
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
            const imgePrv = document.getElementById('categoryImageprv');
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
