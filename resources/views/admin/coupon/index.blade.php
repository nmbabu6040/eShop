@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">All Coupons</h5>
                </div>
                <div class="card-footer">
                    <table class="table table-hover display table-responsive" id="couponTable">
                        <thead>
                            <tr>
                                <th class="">SL</th>
                                <th class="">Name</th>
                                <th class="">Type</th>
                                <th class="">Minimum Amount</th>
                                <th class="">Discount</th>
                                <th class="">Limit</th>
                                <th class="">Start Date</th>
                                <th class="">Expiry Date</th>
                                <th class="">Total Apply</th>
                                <th class="">Status</th>
                                <th class="">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coupons ?? [] as $key => $coupon)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $coupon?->coupon_code }}</td>
                                    <td class="text-center">{{ $coupon?->coupon_type }}</td>
                                    <td class="text-center">{{ $coupon?->min_amount }}</td>
                                    <td class="text-center">{{ $coupon?->discount }}</td>
                                    <td class="text-center">{{ $coupon?->limit }}</td>
                                    <td class="text-center">
                                        {{ $coupon?->start_date ? \Carbon\Carbon::parse($coupon?->start_date)->format('d-m-Y') : '-' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $coupon?->expiry_date ? \Carbon\Carbon::parse($coupon?->expiry_date)->format('d-m-Y') : '-' }}
                                    </td>
                                    <td class="text-center">{{ $coupon?->total_applied }}</td>
                                    <td class="text-center">{{ $coupon?->status }}</td>

                                    <td class="text-center">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            class="btn btn-primary btn-icon editBtn"
                                            data-coupon="{{ json_encode($coupon->toArray()) }}"><i
                                                data-lucide="edit"></i></button>
                                        <a class="btn btn-danger btn-icon deleteConfirm"
                                            href="{{ route('coupon.destroy', $coupon?->id) }}">
                                            <i data-lucide="trash-2"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-danger text-center ">No Coupon Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Add New Coupon</h5>
                </div>
                <div class="card-footer">
                    <form action="{{ route('coupon.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <x-input type="text" name="couponCode" placeholder="Coupon Code" label="Coupon Code" />

                        <x-select name="type" label="Coupon Type" class="">
                            <option value="">Select Type</option>
                            @foreach ($couponTypes ?? [] as $type)
                                <option value="{{ $type?->value }}">{{ $type?->value }}</option>
                            @endforeach
                        </x-select>

                        <x-input type="number" name="minimum_amount" placeholder="Minimum Amount" label="Minimum Amount" />

                        <x-input type="number" name="discount" placeholder="Discount" label="Discount" />

                        <x-input type="number" name="limit" placeholder="Limit" label="Limit" />

                        <x-input type="date" name="startDate" placeholder="Start Date" label="Start Date" />

                        <x-input type="date" name="expiryDate" placeholder="Expiry Date" label="Expiry Date" />

                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-primary" id="submit">ADD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCouponForm" action="" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <x-input type="text" name="couponCode" id="editCouponCode" placeholder="Coupon Code"
                            label="Coupon Code" readonly />

                        <x-select name="type" label="Coupon Type" id="editType">
                            <option value="">Select Type</option>
                            @foreach ($couponTypes ?? [] as $type)
                                <option value="{{ $type?->value }}">{{ $type?->value }}</option>
                            @endforeach
                        </x-select>

                        <x-input type="number" name="minimum_amount" id="editMinmumAmount" placeholder="Minimum Amount"
                            label="Minimum Amount" />

                        <x-input type="number" name="discount" id="editDiscount" placeholder="Discount"
                            label="Discount" />

                        <x-input type="number" name="limit" id="editLimit" placeholder="Limit" label="Limit" />

                        <x-input type="date" name="startDate" id="editStartDate" placeholder="Start Date"
                            label="Start Date" />

                        <x-input type="date" name="expiryDate" id="editExpiryDate" placeholder="Expiry Date"
                            label="Expiry Date" />

                        <div class="mb-4 text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
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
            $('#couponTable').DataTable();
        });


        $('.editBtn').click(function() {
            const coupon = $(this).data('coupon');
            const id = coupon.id;
            const url = '{{ route('coupon.update', ':id') }}'.replace(':id', id);

            $('#editCouponForm').attr('action', url);

            $('#editCouponCode').val(coupon.coupon_code);
            $('#editType').val(coupon.coupon_type);
            $('#editMinmumAmount').val(coupon.min_amount);
            $('#editDiscount').val(coupon.discount);
            $('#editLimit').val(coupon.limit);
            $('#editStartDate').val(coupon.start_date ? coupon.start_date.split(' ')[0] : '');
            $('#editExpiryDate').val(coupon.expiry_date ? coupon.expiry_date.split(' ')[0] : '');
            // $('#editStartDate').val(new Date(coupon.start_date).toISOString().split('T')[0]);
            // $('#editExpiryDate').val(new Date(coupon.expiry_date).toISOString().split('T')[0]);

        })
    </script>
@endpush
