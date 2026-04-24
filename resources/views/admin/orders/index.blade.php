@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center ">
            <h5>All Order List</h5>
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
                            <th scope="col">Order ID</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders ?? [] as $key => $order)
                            <tr>
                                <td>{{ $order?->order_code }}</td>
                                <td>{{ $order?->total_price }}</td>
                                <td>{{ $order?->created_at->format('d-m-Y') }}</td>
                                <td>
                                    @if ($order?->status == 1)
                                        <span class="text-white btn btn-success btn-sm">Active</span>
                                    @else
                                        <span class="text-white btn btn-danger btn-sm">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="" class="btn btn-success btn-icon">
                                        <i data-lucide="list"></i>
                                    </a>
                                    <a href="" class="btn btn-secondary btn-icon "><i data-lucide="eye"></i></a>
                                    <a href="" class="btn btn-primary btn-icon "><i data-lucide="edit"></i></a>
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
