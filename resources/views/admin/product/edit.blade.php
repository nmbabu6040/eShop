@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center ">
            <h5>Edit Product</h5>
            <a href="{{ route('product.index') }}" class="btn btn-primary btn-md d-inline-flex align-items-center gap-1">
                <div class="mr-1">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <span>Back</span>
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="sectionCard mb-4">
                    <span class="sectionTitle">Product Info</span>
                    <div class="row mt-4">
                        <div class="col-12 mb-3">
                            <x-input label="Product Name" name="name" placeholder="Product Name"
                                value="{{ $product->name }}" />
                        </div>
                        <div class="col-12 mb-3">
                            <x-textarea label="Short Description" name="short_description" id=""
                                placeholder="Short Description .." value="{!! old('short_description', $product?->details?->short_description) !!}" cols="30"
                                rows="10"></x-textarea>
                        </div>
                        <div class="col-12">
                            <x-select label="Tags" name="tags[]" placeholder="Select Tags" class="selectTags" multiple>
                                <option value="">Select Tags</option>
                                @foreach ($tags ?? [] as $tag)
                                    <option value="{{ $tag?->id }}"
                                        {{ in_array($tag?->id, $ProductTagIds) ? 'selected' : '' }}>
                                        {{ $tag?->name }}</option>
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
                                    <option value="{{ $category?->id }}"
                                        {{ ($product?->details?->category_id ?? old('category')) == $category?->id ? 'selected' : '' }}>
                                        {{ $category?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <x-select label="Sub Category" name="sub_category" placeholder="Select Sub-category"
                                class="">
                                <option value="">Select Sub Category</option>
                                @foreach ($subCategories ?? [] as $subCategory)
                                    <option value="{{ $subCategory?->id }}"
                                        {{ ($product?->details?->sub_category_id ?? old('sub_category')) == $subCategory?->id ? 'selected' : '' }}>
                                        {{ $subCategory?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-md-6">

                            <div class="d-flex justify-content-between align-items-center">
                                <label for="">Product SKU</label>
                                {{-- <span class="" id="generate_sku" onclick="codeGenerate()">Generate SKU</span> --}}
                            </div>
                            <input type="text" name="product_sku" id="product_sku"
                                value="{{ old('sku_code', $product->sku_code) }}" readonly class="form-control"
                                placeholder="Product SKU">

                            @error('product_sku')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4">
                            <x-select label="Product brand Name" name="brand" placeholder="Product Brand Name"
                                class="">
                                <option value="">Select Brand Name</option>
                                @foreach ($brands ?? [] as $brand)
                                    <option value="{{ $brand?->id }}"
                                        {{ ($product?->details?->brand_id ?? old('brand')) == $brand?->id ? 'selected' : '' }}>
                                        {{ $brand?->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <x-input type="number" name="by_price" value="{{ old('by_price', $product->by_price) }}"
                                placeholder="Product Buying Price" label="Product Buying Price"
                                class="form-control "></x-input>
                        </div>
                        <div class="col-md-6 mb-4">
                            <x-input type="number" name="sale_price" value="{{ old('price', $product->price) }}"
                                placeholder="Product Sale Price" label="Product Sale Price" class="form-control"></x-input>
                        </div>
                    </div>
                </div>
                <div class="sectionCard mb-4">
                    <span class="sectionTitle">Product Description</span>
                    <div class="row mt-4">
                        <div class="col-12">
                            <x-textarea label="Description" name="description" class="summernote"
                                placeholder="Description .." value="{!! old('description', $product?->details?->description) !!}"></x-textarea>
                        </div>
                        <div class="col-12">
                            <x-textarea label="Additional Information" name="additional_info" class="summernote"
                                value="{!! old('additional_info', $product?->details?->additional_info) !!}" id="" placeholder="Additional Info.."></x-textarea>
                        </div>

                    </div>
                </div>
                <div class="sectionCard mb-4">
                    <span class="sectionTitle">Product Images</span>
                    <div class="row mt-3">
                        <div class="col-12">
                            <p>Product Thumbnail</p>
                            <label for="thumbnail">
                                <img src="{{ $product?->thumbnail }}" alt="" width="140" height="140"
                                    class="img-tmumbnail" id="thumbnailPreview">
                            </label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control d-none"
                                onchange="validateImage(this)"> <br>
                            <span class="text-danger" id="imageError"></span>
                            @error('thumbnail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <p>Product Gellery</p>
                            <div class="upload__box">
                                <div class="upload__btn-box">
                                    <label class="upload__btn" for="upload">
                                        <img src="{{ asset('admin/assets/images/upload.png') }}" alt="Upload Icon"
                                            class="image-thumbnail" width="140" height="140" id="thumbnailGellery">
                                    </label>

                                    {{-- এখানে 'images[]' নাম থাকবে --}}
                                    <input type="file" name="images[]" data-max_length="20"
                                        class="upload__inputfile d-none" id="upload" multiple>

                                    <div class="upload__img-wrap ">
                                        @foreach ($product?->galleries ?? [] as $image)
                                            <div class='upload__img-box'>
                                                <div class='img-bg'
                                                    style='background-image: url({{ Storage::url($image['src']) }})'
                                                    data-file='{{ $image['name'] }}'data-id='{{ $image['id'] }}'>
                                                    <div class='upload__img-close'><i class='fas fa-xmark'></i></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
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
            const sku = Math.floor(Math.random() * 1000000000);
            document.getElementById('product_sku').value = sku;
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#thumbnail').on('change', function() {
                const file = this.files[0];
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#thumbnailPreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            });
        });
    </script>
    <script>
        jQuery(document).ready(function() {

            // গ্যালারি ফাইলগুলো রাখার জন্য গ্লোবাল অ্যারে। এটিতে শুধুমাত্র ফাইল অবজেক্ট থাকবে।
            let imgArray = [];
            let imgWrap = $(".upload__img-wrap");

            // ফাংশন যা প্রিভিউ তৈরি করে
            function generatePreview(file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let html = `
                    <div class='upload__img-box'>
                        <div class='img-bg' style='background-image: url(${e.target.result})'
                            data-file-name='${file.name}' data-file-size='${file.size}'>
                            <div class='upload__img-close'><i class='fas fa-xmark'></i></div>
                        </div>
                    </div>`;
                    imgWrap.append(html);
                };
                reader.readAsDataURL(file);
            }

            // আপলোড ইনপুট পরিবর্তন হলে
            $(".upload__inputfile").on("change", function(e) {
                let maxLength = $(this).attr("data-max_length");
                let files = e.target.files;
                let filesArr = Array.prototype.slice.call(files);

                filesArr.forEach(function(f) {
                    if (!f.type.match("image.*")) return;

                    // ম্যাক্সিমাম লিমিট চেক
                    if (imgArray.length >= maxLength) {
                        alert('Maximum ' + maxLength + ' files allowed.');
                        return false;
                    }

                    // ডুপ্লিকেট ফাইল (নাম ও সাইজ এক হলে) এড়ানোর জন্য চেক
                    let isDuplicate = imgArray.some(existingFile =>
                        existingFile.name === f.name && existingFile.size === f.size
                    );

                    if (isDuplicate) {
                        // console.log('Duplicate file skipped:', f.name);
                        return;
                    }

                    // অ্যারেতে ফাইল যোগ করুন এবং প্রিভিউ দেখান
                    imgArray.push(f);
                    generatePreview(f);
                });

                // ইনপুট ফিল্ডটি রিসেট করুন যাতে একই ফাইল আবার সিলেক্ট করা যায়
                $(this).val('');

                // ফর্মে পাঠানোর জন্য নতুন Datatransfer অবজেক্ট তৈরি করা এবং ইনপুট ফিল্ডে সেট করা
                updateFileInput();
            });


            // ফাইল রিমুভ করার ফাংশন
            $("body").on("click", ".upload__img-close", function() {
                let fileName = $(this).parent().data("file");
                let id = $(this).parent().data("id");

                const confirmDelete = confirm('Are you sure you want to delete this image?');

                if (!confirmDelete) {
                    return;
                }

                if (id && confirmDelete) {

                    const url = `{{ route('product.deleteImage', ':id') }}`.replace(':id', id);
                    $.ajax({
                        url: url,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log('Image deleted successfully');
                        },
                        error: function() {
                            alert('Something went wrong');
                        }

                    }).done(function() {
                        $(this).closest(".upload__img-box").remove();
                        updateFileInput();
                    })

                }

                return;

                // imgArray থেকে ফাইলটি খুঁজে বের করে মুছে ফেলুন
                for (let i = 0; i < imgArray.length; i++) {
                    // ফাইলের নাম এবং সাইজ মিলিয়ে রিমুভ করা
                    if (imgArray[i].name === fileName && imgArray[i].size == fileSize) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }

                // প্রিভিউ থেকে ছবিটি রিমুভ করুন
                $(this).closest(".upload__img-box").remove();

                // ইনপুট ফিল্ড আপডেট করুন
                updateFileInput();
            });


            // *** গুরুত্বপূর্ণ ফাংশন: আপডেটেড ফাইলগুলোকে ইনপুট ফিল্ডে সেট করা ***
            function updateFileInput() {
                const dataTransfer = new DataTransfer();

                imgArray.forEach(file => {
                    dataTransfer.items.add(file);
                });

                // মূল ফাইল ইনপুট ফিল্ড আপডেট করা হচ্ছে
                document.getElementById('upload').files = dataTransfer.files;

                // ফাইলের সংখ্যা ট্র‍্যাক করা
                $('#image_files_count').val(imgArray.length);
            }

        });
    </script>
    <script>
        function validateImage(input) {
            const file = input.files[0];
            const errorMessgae = document.getElementById('imageError');
            const imgePrv = document.getElementById('thumbnailPreview');
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
    <script>
        $(".selectTags").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
    </script>
@endpush


@push('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #ffffff;
            border: 0;
            border-radius: 3px;
            padding: 7px;
            font-size: -0.375rem;
            font-family: inherit;
            line-height: 1;
            background: #727cf5;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
            cursor: default;
            padding-left: 10px;
            padding-right: 5px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: #ffffff;
            border: 0;
            border-radius: 3px;
            padding: 7px;
            font-size: 14px;
            font-family: inherit;
            line-height: 1;
            background: #727cf5;
        }

        .sectionCard {
            padding: 15px;
            border: 1px solid #ebebeb;
            border-radius: 5px;
            margin-bottom: 10px;
            position: relative;
        }

        .sectionTitle {
            position: absolute;
            top: -15px;
            left: 15px;
            font-size: 18px;
            padding: 2px 20px;
            background: #f5f5f5;
            border-radius: 5px;
        }

        .note-editor .note-toolbar>.note-btn-group,
        .note-popover .popover-content>.note-btn-group {

            margin-right: 2px;

        }

        .btn i,
        .fc .fc-button i,
        .swal2-modal .swal2-actions button i,
        .wizard>.actions a i,
        .wizard>.actions a:hover i,
        .wizard>.actions .disabled a i {
            font-size: 12px;
        }

        #generate_sku {
            color: rgb(81, 255, 0);
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            transition: all .3s ease-in-out;
        }

        #generate_sku:hover {
            color: rgb(39, 100, 11);
        }

        .upload__box {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .upload__img-box {
            width: 140px;
            position: relative;
        }

        .img-bg {
            width: 100%;
            padding-bottom: 100%;
            /* Perfect square */
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: 8px;
            position: relative;
        }

        .upload__img-close {
            position: absolute;
            top: 5px;
            right: 5px;
            width: 26px;
            height: 26px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 50%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            z-index: 10;
            opacity: 0;
            transition: 0.2s ease-in-out;
        }

        .upload__img-box:hover .upload__img-close {
            opacity: 1;
        }

        .note-editor.note-airframe .note-editing-area .note-editable,
        .note-editor.note-frame .note-editing-area .note-editable {
            max-height: 550px;
            min-height: 230px;
            overflow-y: scroll;
        }
    </style>
@endpush
