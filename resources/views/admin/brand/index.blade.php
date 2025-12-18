@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">All Brands</h5>
                </div>
                <div class="card-footer">
                    <table class="table table-hover display" id="brandTable">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Brand Name</th>
                                <th>Brand Slug</th>
                                <th class="text-center">Brand Image</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($brands ?? [] as $key => $brand)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $brand?->name }}</td>
                                    <td>{{ $brand?->slug }}</td>
                                    <td class="text-center"><img src="{{ $brand?->thumbnail }}" alt=""></td>
                                    <td class="text-center">
                                        <a href="{{ route('brand.edit', $brand?->id) }}"
                                            class="btn btn-primary btn-icon "><i data-lucide="edit"></i></a>
                                        <a href="{{ route('brand.destroy', $brand?->id) }}"
                                            class="btn btn-danger btn-icon deleteConfirm "><i data-lucide="trash-2"></i></a>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-danger text-center">No Brand Found</td>
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
                    <h5 class="card-title">Add New Brand</h5>
                </div>
                <div class="card-footer">
                    <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="" class="form-label">Brand Name</label>
                            <input type="text" name="name" id="brandName" placeholder="Brand Name"
                                class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="form-label">Brand Slug</label>
                            <input type="text" name="slug" id="brandSlug" placeholder="Brand Slug"
                                class="form-control">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="brandImage" class="form-label">Brand Image</label> <br>
                            <img src="{{ asset('default.jpg') }}" alt="" width="80" id="brandImageprv"
                                class="mb-2">
                            <input type="file" name="image" id="brandImage" class="form-control"
                                onchange="validateImage(this)">
                            <span class="text-danger" id="imageError"></span>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4 text-center">
                            <button type="submit" class="btn btn-primary" id="submit">ADD</button>
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
            $('#brandTable').DataTable();
        });

        function validateImage(input) {
            const file = input.files[0];
            const errorMessgae = document.getElementById('imageError');
            const imgePrv = document.getElementById('brandImageprv');
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
