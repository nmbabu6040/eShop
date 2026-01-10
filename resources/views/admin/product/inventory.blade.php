@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Product name: {{ $product?->name }}</h5>
                </div>
                <div class="card-footer">
                    <table class="table table-hover display" id="categoryTable">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Color Name</th>
                                <th>Size Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inventories ?? [] as $key => $inventory)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $inventory?->color?->name }} </td>
                                    <td>{{ $inventory?->size?->name }}</td>
                                    <td class="text-center">{{ $inventory?->quantity }}</td>
                                    <td class="text-center">
                                        <div class="btn btn-primary btn-icon editBtn"
                                            data-inventory="{{ json_encode($inventory->toArray()) }}"><i
                                                data-lucide="edit"></i></div>
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

                        <div class="mb-4 d-flex justify-content-between">
                            <a href="{{ route('product.index') }}" class="btn btn-secondary btn-md">Back</a>
                            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Inventory: {{ $product?->name }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="editInventoryForm" method="post">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="" value="{{ $product?->id }}">
                        <div class="mb-4">

                            <x-select name="editColor" label="Color Name">
                                <option value="">Select Color</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mb-4">

                            <x-select name="editSize" label="Size Name">
                                <option value="">Select Size</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mb-4">
                            <x-input type="number" label="Quantity" name="editQuantity" placeholder="Quantity"
                                class="form-control" :required="true"></x-input>
                        </div>

                        {{-- <div class="mb-4 d-flex justify-content-between">
                        <a href="{{ route('product.index') }}" class="btn btn-secondary btn-md">Back</a>
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div> --}}

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
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


            $('.editBtn').click(function() {
                const inventory = $(this).data('inventory');
                const url = '{{ route('inventory.update', ':id') }}'.replace(':id', inventory.id) ?? '';

                $('#editInventoryForm').attr('action', '');
                $('#editColor').val('');
                $('#editSize').val('');
                $('#editQuantity').val('');

                $('#exampleModal').modal('show');

                $('#editInventoryForm').attr('action', url);
                $('#editColor').val(inventory.color_id).trigger('change');
                $('#editSize').val(inventory.size_id).trigger('change');
                $('#editQuantity').val(inventory.quantity);


            })
        });
    </script>
@endpush
