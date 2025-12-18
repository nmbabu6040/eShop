@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">All Size</h5>
                </div>
                <div class="card-footer">
                    <table class="table table-hover display" id="sizeTable">
                        <thead>
                            <tr>
                                <th class="text-center">SL</th>
                                <th class="text-center">Size Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sizes ?? [] as $key => $size)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $size?->name }}</td>

                                    <td class="text-center">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            class="btn btn-primary btn-icon editBtn" data-id="{{ $size?->id }}"
                                            data-name="{{ $size?->name }}"><i
                                                data-lucide="edit"></i></button>
                                        <a class="btn btn-danger btn-icon deleteConfirm"
                                            href="{{ route('size.destroy', $size?->id) }}">
                                            <i data-lucide="trash-2"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-danger text-center">No Size Found</td>
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
                    <h5 class="card-title">Add New Size</h5>
                </div>
                <div class="card-footer">
                    <form action="{{ route('size.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="" class="form-label">Size Name</label>
                            <input type="text" name="name" id="sizeName" placeholder="Size Name"
                                class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4 text-center">
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Size</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editSizeForm" action="" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-4">
                            <label for="" class="form-label">Size Name</label>
                            <input type="text" name="name" id="editSizeName" placeholder="Size Name"
                                class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

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
            $('#sizeTable').DataTable();
        });


        $('.editBtn').click(function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const url = '{{ route('size.update', ':id') }}'.replace(':id', id);

            $('#editSizeName').val(name);
            $('#editSizeForm').attr('action', url);

        })
    </script>
@endpush
