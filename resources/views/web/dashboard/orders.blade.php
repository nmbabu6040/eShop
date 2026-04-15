@extends('web.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-3">
                @include('web.dashboard.sidebar')
            </div>
            <div class="col-md-9">
                <div class="pb-3">
                    <h5>My Order List</h5>
                </div>
                <div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    Order ID
                                </th>
                                <th>
                                    Order Date
                                </th>
                                <th>
                                    Order Amount
                                </th>
                                <th>
                                    Order Status
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders ?? [] as $order)
                                <tr>
                                    <td>{{ $order->order_code }}</td>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td>${{ $order->total_price }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td><a href="{{ route('user.order.details', $order->id) }}"
                                            class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-danger">No Order Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
