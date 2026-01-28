@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center ">
            <h5>Create New Product</h5>
            <a href="{{ route('product.index') }}" class="btn btn-primary btn-md d-inline-flex align-items-center gap-1">
                <div class="mr-1">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <span>Back</span>
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="sectionCard mb-4">
                    <span class="sectionTitle">Product Info</span>
                    <div class="row mt-4">
                        <div class="col-12 mb-3">
                            <x-input label="Product Name" name="name" placeholder="Product Name" />

                            <x-textarea label="Short Description" name="shortDescription" id=""
                                placeholder="Short Description .." cols="30" rows="10"></x-textarea>
                        </div>
                        <div class="col-12">
                            <x-select label="Tags" name="tags[]" placeholder="Select Tags" class="selectTags" multiple>
                                <option value="">Select Tags</option>
                                @foreach ($tags ?? [] as $tag)
                                    <option value="{{ $tag?->id }}">{{ $tag?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                </div>
                <div class="sectionCard mb-4">
                    <span class="sectionTitle">General Info</span>
                    <div class="row mt-4">
                        <div class="col-md-6 mb-4">
                            <x-select label="Category" name="category" placeholder="Select Category" class="">
                                <option value="">Select Category</option>
                                @foreach ($categories ?? [] as $category)
                                    <option value="{{ $category?->id }}">{{ $category?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <x-select label="Sub Category" name="subCategory" placeholder="Select Sub-category"
                                class="">
                                <option value="">Select Sub Category</option>
                                @foreach ($subCategories ?? [] as $subCategory)
                                    <option value="{{ $subCategory?->id }}">{{ $subCategory?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-md-6">

                            <div class="d-flex justify-content-between align-items-center">
                                <label for="">Product SKU</label>
                                <span class="" id="generate_sku" onclick="codeGenerate()">Generate SKU</span>
                            </div>
                            <input type="text" name="productSku" id="product_sku" class="form-control"
                                placeholder="Product SKU">

                            @error('productSku')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <x-select label="Product brand Name" name="brand" placeholder="Product Brand Name"
                                class="">
                                <option value="">Select Brand Name</option>
                                @foreach ($brands ?? [] as $brand)
                                    <option value="{{ $brand?->id }}">{{ $brand?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-md-4 mb-4">
                            <x-input type="number" name="byingPrice" placeholder="Product Buying Price"
                                label="Product Buying Price" class="form-control "></x-input>
                        </div>
                        <div class="col-md-4 mb-4">
                            <x-input type="number" name="salePrice" placeholder="Product Sale Price"
                                label="Product Sale Price" class="form-control"></x-input>
                        </div>

                        <div class="col-md-4 mb-4">
                            <x-input type="number" label='Product Discount Price' name="discount_price"
                                placeholder="Product Discount Price" />
                        </div>
                    </div>
                </div>
                <div class="sectionCard mb-4">
                    <span class="sectionTitle">Product Description</span>
                    <div class="row mt-4">
                        <div class="col-12">
                            <x-textarea label="Description" name="description" class="summernote"
                                placeholder="Description .."></x-textarea>
                        </div>
                        <div class="col-12">
                            <x-textarea label="Additional Information" name="additionalInfo" class="summernote"
                                id="" placeholder="Additional Info.."></x-textarea>
                        </div>

                    </div>
                </div>
                <div class="sectionCard mb-4">
                    <span class="sectionTitle">Product Images</span>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <p>Product Thumbnail</p>
                            <label for="thumbnail">
                                <img src="{{ asset('admin/assets/images/upload.png') }}" alt=""
                                    class="img-thumbnail" id="thumbnail_preview" width="140" height="140">
                            </label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control d-none"
                                onchange="validateImage(this)"> <br>
                            <span class="text-danger" id="imageError"></span>
                            @error('thumbnail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 mt-3">
                            <p>Product Gallery</p>
                            <div class="upload__box">
                                <div class="upload__btn-box">
                                    <label class="upload__btn" for="upload">
                                        <img src="{{ asset('admin/assets/images/upload.png') }}" alt=""
                                            class="img-thumbnail" id="thumbnail_gallery" width="140" height="140">
                                    </label>
                                </div>

                                <input type="file" name="images[]" data-max_length="20" multiple
                                    class="upload__inputfile d-none" id="upload">

                                <div class="upload__img-wrap"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-4 d-flex justify-content-end align-items-center gap-1">
                    <a href="{{ route('product.create') }}"
                        class="btn btn-secondary btn-md d-flex justify-content-between align-items-center">
                        <i class="fas fa-undo me-1"></i> Reset
                    </a>
                    <button type="submit"
                        class="btn btn-primary btn-md d-flex justify-content-between align-items-center">
                        Submit <i class="fas fa-arrow-right ms-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });

        codeGenerate = () => {
            const sku = Math.floor(Math.random() * 1000000);
            document.getElementById('product_sku').value = sku;
        }

        $('#thumbnail').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#thumbnail_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        })
    </script>
    <script>
        function ImgUpload() {

            let dt = new DataTransfer(); // stores all files

            $('.upload__inputfile').on('change', function(e) {

                let imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                let maxLength = parseInt($(this).attr('data-max_length'));

                let files = e.target.files;

                for (let i = 0; i < files.length; i++) {

                    let file = files[i];

                    if (!file.type.match('image.*')) continue;

                    if (dt.files.length >= maxLength) {
                        alert("Max image limit reached!");
                        break;
                    }

                    dt.items.add(file); // store ALL files permanently

                    let reader = new FileReader();
                    reader.onload = function(event) {
                        let html = `
                        <div class='upload__img-box'>
                            <div class='img-bg'
                                style='background-image:url(${event.target.result})'
                                data-file='${file.name}'>
                                <div class='upload__img-close'></div>
                            </div>
                        </div>
                    `;
                        imgWrap.append(html);
                    };
                    reader.readAsDataURL(file);
                }

                // Replace actual input file list with our custom DataTransfer list
                this.files = dt.files;

            });

            // delete image
            $('body').on('click', ".upload__img-close", function() {

                let fileName = $(this).parent().data("file");

                for (let i = 0; i < dt.items.length; i++) {
                    if (dt.items[i].getAsFile().name === fileName) {
                        dt.items.remove(i);
                        break;
                    }
                }

                // update input with new file list
                document.querySelector('.upload__inputfile').files = dt.files;

                $(this).closest('.upload__img-box').remove();
            });

        }

        $(document).ready(function() {
            ImgUpload();

            $('.selectTags').select2();

        });
    </script>
    <script>
        function validateImage(input) {
            const file = input.files[0];
            const errorMessage = document.getElementById('imageError');
            const ImagePrv = document.getElementById('thumbnail_preview');
            errorMessage.textContent = '';

            if (file) {
                const imgSize = file.size / (1024 * 1024);
                if (imgSize > 2) {
                    errorMessage.textContent = 'Image size must be less than 2MB';
                    ImagePrv.src = URL.createObjectURL(file);
                    submit.disabled = true;
                } else {
                    ImagePrv.src = URL.createObjectURL(file);
                    submit.disabled = false;
                }
            }
        }
    </script>
@endpush

@push('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <style>
        .sectionCard {
            position: relative;
            border: 1px solid #ebebeb;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .sectionTitle {
            position: absolute;
            top: -15px;
            left: 15px;
            /* font-weight: 600; */
            font-size: 18px;
            padding: 2px 20px;
            background: #ededed;
            border-radius: 5px;
        }

        #generate_sku {
            cursor: pointer;
            color: rgb(91, 200, 107);
            font-size: 16px;
        }

        #generate_sku:hover {
            color: rgb(72, 246, 98);
        }


        .upload__box {
            /* padding: 20px; */
            margin-top: 10px;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .upload__btn-box {
            margin-bottom: 10px;
        }

        .upload__btn {
            display: inline-block;
            font-weight: 600;
            color: #fff;
            text-align: center;
            cursor: pointer;
            border-radius: 8px;
            font-size: 14px;
        }

        .upload__inputfile {
            width: .1px;
            height: .1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .upload__img-box {
            width: 160px;
        }

        .img-bg {
            width: 100%;
            padding-bottom: 100%;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .upload__img-close {
            width: 26px;
            height: 26px;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 50%;
            position: absolute;
            top: 8px;
            right: 8px;
            cursor: pointer;
        }

        .upload__img-close::after {
            content: '×';
            color: #fff;
            font-size: 20px;
            line-height: 26px;
            text-align: center;
            display: block;
        }

        .note-editor.note-airframe .note-editing-area .note-editable,
        .note-editor.note-frame .note-editing-area .note-editable {
            min-height: 220px;
            max-height: 700px;
            overflow-y: scroll;
        }
    </style>
@endpush
