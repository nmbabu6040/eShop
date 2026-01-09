@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">All Categories</h5>
                </div>
                <div class="card-footer">
                    <table class="table table-hover display" id="categoryTable">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Color Name</th>
                                <th>Size Name</th>
                                <th>Quantity</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inventories ?? [] as $key => $inventory)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $inventory?->color?->name }} </td>
                                    <td>{{ $inventory?->size?->name }}</td>
                                    <td>{{ $inventory?->quantity }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('inventory.edit', $inventory?->id) }}"
                                            class="btn btn-primary btn-icon "><i data-lucide="edit"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-danger text-center">Inventory not found</td>
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
                    <h5 class="card-title">Add Product Inventory</h5>
                </div>
                <div class="card-footer">
                    <form action="{{ route('inventory.store', $product?->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" id="" value="{{ $product?->id }}">
                        <div class="mb-4">

                            <x-select name="color" label="Color Name">
                                <option value="">Select Color</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mb-4">

                            <x-select name="size" label="Size Name">
                                <option value="">Select Size</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mb-4">
                            <x-input type="number" label="Quantity" name="quantity" placeholder="Quantity"
                                class="form-control" :required="true"></x-input>
                        </div>

                        <div class="mb-4">
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
            $('#categoryTable').DataTable();
        });
    </script>
@endpush
