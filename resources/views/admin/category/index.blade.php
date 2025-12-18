@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">All Categories</h5>
            </div>
            <div class="card-footer">
                <table class="table table-hover display" id="categoryTable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Category Slug</th>
                            <th class="text-center">Category Image</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories ?? [] as $key => $category)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$category?->name}}</td>
                            <td>{{$category?->slug}}</td>
                            <td class="text-center"><img src="{{$category?->thumbnail}}" alt=""></td>
                            <td class="text-center">
                                <a href="{{ route('category.edit', $category?->id)}}" class="btn btn-primary btn-icon "><i data-lucide="edit"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-danger text-center">Category not found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Add New Category</h5>
            </div>
            <div class="card-footer">
                <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" name="name" id="categoryName" placeholder="Category Name" class="form-control">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="" class="form-label">Category Slug</label>
                        <input type="text" name="slug" id="categorySlug" placeholder="Category Slug" class="form-control">
                        @error('slug')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="categoryImage" class="form-label">Category Image</label> <br>
                        <img src="{{asset('default.jpg')}}" alt="" width="80" id="categoryImageprv" class="mb-2">
                        <input type="file" name="image" id="categoryImage" class="form-control" onchange="validateImage(this)">
                        <span class="text-danger" id="imageError"></span>
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-4 text-center">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function() {
        $('#categoryTable').DataTable();
    });

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
