@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center ">
            <h5 class="pb-0">Product Details</h5>
            <a href="{{ route('product.index') }}" class="btn btn-primary btn-md d-inline-flex align-items-center gap-1">
                <div class="mr-1">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <span>Back</span>
            </a>
        </div>
        <div class="card-body">
            <div class="sectionCard mb-5">
                <span class="sectionTitle">Product Info</span>
                <div class="row">
                    <div class="col-12 ">
                        <div class="mt-3">
                            <p>Product Name:</p>
                            <h5>{{ $product->name }}</h5>
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="mt-3">
                            <p>Short Description:</p>
                            <h5>{{ $product->details?->short_description }}</h5>
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="mt-3">
                            <p>Tags:</p>
                            @foreach ($product->tags as $tag)
                                <span class="btn btn-primary text-white">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="sectionCard mb-5">
                <span class="sectionTitle">General Information</span>
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="mt-3">
                            <p>Category:</p>
                            <h5>{{ $product->details?->category?->name }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-3">
                            <p>Sub category:</p>
                            <h5>{{ $product->details?->subCategory?->name }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-3">
                            <p>Product SKU:</p>
                            <h5>{{ $product->sku_code }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-3">
                            <p>Product Brand:</p>
                            <h5>{{ $product->details?->brand?->name }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-3">
                            <p>Buying Price:</p>
                            <h5>{{ $product->by_price }}</h5>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-3">
                            <p>Selling Price:</p>
                            <h5>{{ $product->price }}</h5>
                        </div>
                    </div>

                </div>
            </div>
            <div class="sectionCard mb-5">
                <span class="sectionTitle">Description Info</span>
                <div class="row">
                    <div class="col-12 ">
                        <div class="mt-3">
                            <p>Description:</p>
                            {!! $product->details?->description !!}
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="mt-3">
                            <p>Additional Information:</p>
                            {!! $product->details?->additional_info !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="sectionCard mb-5">
                <span class="sectionTitle">Product Images</span>
                <div class="row">
                    <div class="col-12 ">
                        <div class="mt-3">
                            <p>Product Thumbnail:</p>
                            <img src="{{ $product?->thumbnail }}" alt="Product Thumbnail" width="140" height="140"
                                class="img-thumbnail">
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="mt-3">
                            <p>Product Gallery:</p>
                            <div class="row">
                                @foreach ($productGelleries as $gallery)
                                    <div class="col-sm-6 col-md-3 col-lg-2">
                                        <img src="{{ $gallery['src'] }}" alt="product gallery" class="w-100">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sectionCard mb">
                <div class="btnGroup d-flex justify-content-between">
                    <a href="{{ route('product.index') }}" class="btn btn-primary btn-md"><i
                            class="fas fa-angle-left me-2"></i> Back</a>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-md">Edit <i
                            class="fas fa-edit ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
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
    </style>
@endpush

@push('script')
    {{-- <script>
        function validateImage(input) {
            const file = input.files[0];
            const errorMessgae = document.getElementById('imageError');
            const imgePrv = document.getElementById('proImageprv');
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
    </script> --}}
@endpush
