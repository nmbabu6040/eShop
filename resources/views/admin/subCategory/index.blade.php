@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">All Sub Categories</h5>
            </div>
            <div class="card-footer">
                <table class="table table-hover display" id="subCategoryTable">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subCategories ?? [] as $key => $subCategory)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{$subCategory?->category?->name}}</td>
                            <td>{{$subCategory?->name}}</td>
                            <td>{{$subCategory?->slug}}</td>
                            <td class="text-center"><img src="{{$subCategory?->thumbnail}}" alt=""></td>
                            <td class="text-center">
                                <a href="{{ route('subCategory.edit', $subCategory?->id)}}" class="btn btn-primary btn-icon "><i data-lucide="edit"></i></a>
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
                <h5 class="card-title">Add New Sub-Category</h5>
            </div>
            <div class="card-footer">
                <form action="{{route('subCategory.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" id="categoryName" placeholder="Sub Category Name" class="form-control">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="" class="form-label">Slug</label>
                        <input type="text" name="slug" id="categorySlug" placeholder="Sub Category Slug" class="form-control">
                        @error('slug')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="" class="form-label">Category</label>
                        <select name="category" id="category" class="form-contol form-select">
                            <option value="">Select Category</option>
                            @foreach($categories ?? [] as $category)
                            <option value="{{$category?->id}}" {{ old('category') == $category?->id ? 'selected' : ''}}>{{$category?->name}}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="subCategoryImage" class="form-label">Thumbnail</label> <br>
                        <img src="{{asset('default.jpg')}}" alt="" width="120" id="subCategoryImageprv" class="mb-2">
                        <input type="file" name="image" id="subCategoryImage" class="form-control" onchange="validateImage(this)">
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
        $('#subCategoryTable').DataTable();
    });

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
