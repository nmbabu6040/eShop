@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Add New Product</h5>
            <a href="{{ route('product.index') }}" class="btn btn-primary btn-md d-inline-flex align-items-center gap-1">
                <div class="mr-1">
                    <i class="fa fa-arrow-left"></i>
                </div>
                <span class="ms-1">Back</span>
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="sectionCard mb-5">
                    <span class="sectionTitle">Product Info</span>
                    <div class="row mt-4">
                        <div class="col-12">
                            <x-input label="Product Name" name="name" placeholder="Product Name"
                                value="{{ $product->name }}" />

                            <x-textarea label="Short Description" name="short_description"
                                placeholder="Short Description..." rows='6'
                                value="{{ $product->details?->short_description }}" />
                        </div>
                        <div class="col-12">
                            <x-select label="Tags" name="tags[]" placeholder="Select Tags" multiple class="selectTags">
                                <option value="">Select Tags</option>
                                @foreach ($tags ?? [] as $tag)
                                    <option value="{{ $tag?->id }}"
                                        {{ in_array($tag?->id, $productTagIds) ? 'selected' : '' }}>{{ $tag?->name }}
                                    </option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                </div>

                <div class="sectionCard mb-5">
                    <span class="sectionTitle">General Information</span>
                    <div class="row mt-4">
                        <div class="col-md-6 mt-3">
                            <x-select label="Category" name="category" placeholder="Select Category">
                                <option value="">Select Category</option>
                                @foreach ($categories ?? [] as $category)
                                    <option value="{{ $category?->id }}"
                                        {{ old('category', $product->details?->category_id) == $category?->id ? 'selected' : '' }}>
                                        {{ $category?->name }}</option>
                                @endforeach
                            </x-select>

                        </div>
                        <div class="col-md-6 mt-3">
                            <x-select label="Sub Category" name="sub_category" placeholder="Select Sub Category">
                                <option value="">Select Sub Category</option>
                                @foreach ($subCategories ?? [] as $subCategory)
                                    <option value="{{ $subCategory?->id }}"
                                        {{ old('sub_category', $product->details?->sub_category_id) == $subCategory?->id ? 'selected' : '' }}>
                                        {{ $subCategory?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="col-md-6 mt-3">
                            {{-- <x-input label='Product SKU' name="sku" placeholder="Product SKU"
                                :required="true"></x-input> --}}
                            <div class="d-flex justify-content-between align-items-center gap-2">
                                <label for="">Product SKU</label>
                            </div>
                            <input type="text" name="product_sku" id="product_sku" class="form-control"
                                placeholder="Product SKU" value="{{ old('product_sku', $product->sku_code) }}" readonly>

                            @error('product_sku')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <x-select label='Product Brand' name="brand" placeholder="Product Brand">
                                <option value="">Select Brand</option>
                                @foreach ($brands ?? [] as $brand)
                                    <option value="{{ $brand?->id }}"
                                        {{ old('brand', $product->details?->brand_id) == $brand?->id ? 'selected' : '' }}>
                                        {{ $brand?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>


                        <div class="col-md-6 mt-3">
                            <x-input type="number" label='Product Buying Price' name="buying_price"
                                placeholder="Product Buying Price" value="{{ old('buying_price', $product->by_price) }}" />
                        </div>

                        <div class="col-md-6 mt-3">
                            <x-input type="number" label='Product Selling Price' name="selling_price"
                                placeholder="Product Selling Price" value="{{ old('selling_price', $product->price) }}" />
                        </div>
                    </div>
                </div>


                <div class="sectionCard mb-5">
                    <span class="sectionTitle">Product Description</span>
                    <div class="row mt-4">
                        <div class="col-12 mt-3">
                            <x-textarea label="Description" name="description" class="summernote"
                                placeholder="Description..." value="{!! old('description', $product->details?->description) !!}" />
                        </div>
                        <div class="col-12 mt-3">
                            <x-textarea label="Additional Information" name="additional_information" class="summernote"
                                placeholder=" Additional Information..." rows='10'
                                value="{{ old('additional_information', $product->details?->additional_information) }}" />
                        </div>
                    </div>
                </div>

                <div class="sectionCard mb-5">
                    <span class="sectionTitle">Product Images</span>

                    <div class="row mt-3">

                        <div class="col-md-12">
                            <p>Product Thumbnail</p>
                            <label for="thumbnail">
                                <img src="{{ $product->thumbnail }}" alt="" class="img-thumbnail"
                                    id="thumbnail_preview" width="200" height="200">
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
                                        <img src="{{ asset('admin/assets/images/default-upload.png') }}" alt=""
                                            class="img-thumbnail" id="thumbnail_gallery" width="200" height="200">
                                    </label>
                                </div>

                                <input type="file" name="images[]" data-max_length="20" multiple
                                    class="upload__inputfile d-none" id="upload">

                                <div class="upload__img-wrap">
                                    @foreach ($product->galleries ?? [] as $image)
                                        <div class='upload__img-box'>
                                            <div class='img-bg'
                                                style='background-image:url({{ Storage::url($image['src']) }})'
                                                data-file='{{ $image['name'] }}' data-id='{{ $image['id'] }}'>
                                                <div class='upload__img-close deleteProductImage'></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="my-4 d-flex justify-content-end align-items-center gap-2">
                    <a href="{{ route('product.create') }}" class="btn btn-secondary btn-lg mr-2">
                        <i class="fa fa-undo"></i>
                        Reset
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg">
                        Submit
                        <i class="fa fa-arrow-right"></i>
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
            $('body').on('click', '.upload__img-close', function() {
                let $btn = $(this);
                let fileName = $btn.parent().data('file');
                let id = $btn.parent().data('id');

                if (!confirm('Are you sure you want to delete this image?')) return;

                if (id) {
                    const url = '{{ route('product.deleteImage', ':id') }}'.replace(':id', id);
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function() {
                            removeFromDT();
                        },
                        error: function() {
                            alert('Something went wrong');
                            return;
                        }
                    });

                    return;
                }

                removeFromDT();

                function removeFromDT() {
                    for (let i = 0; i < dt.items.length; i++) {
                        if (dt.items[i].getAsFile().name === fileName) {
                            dt.items.remove(i);
                            break;
                        }
                    }

                    document.querySelector('.upload__inputfile').files = dt.files;
                    $btn.closest('.upload__img-box').remove();
                }
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
