@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center ">
            <h5>Product List</h5>
            <a href="{{ route('product.create') }}" class="btn btn-primary btn-md d-inline-flex align-items-center gap-1">
                <div class="mr-1">
                    <i class="fas fa-plus"></i>
                </div>
                <span>Add Product</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Product SKU</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Sub Category</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Product Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products ?? [] as $key => $product)
                            <tr>
                                <td>{{ $product?->sku_code }}</td>
                                <td>{{ $product?->name }}</td>
                                <td>{{ $product?->details?->category?->name }}</td>
                                <td>{{ $product?->details?->subCategory?->name }}</td>
                                <td>{{ $product?->details?->brand?->name }}</td>
                                <td>{{ $product?->price }}</td>
                                <td>
                                    @if ($product?->status == 1)
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('product.show', $product?->id) }}"
                                        class="btn btn-secondary btn-icon "><i data-lucide="eye"></i></a>
                                    <a href="{{ route('product.edit', $product?->id) }}"
                                        class="btn btn-primary btn-icon "><i data-lucide="edit"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-danger text-center">Product not found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
