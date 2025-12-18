@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">All Color</h5>
                </div>
                <div class="card-footer">
                    <table class="table table-hover display" id="colorTable">
                        <thead>
                            <tr>
                                <th class="text-center">SL</th>
                                <th class="text-center">Color Name</th>
                                <th class="text-center">Color </th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($colors ?? [] as $key => $color)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td class="text-center">{{ $color?->name }}</td>
                                    <!-- <td>{{ $color?->color_code }}</td> -->
                                    <td class="text-center align-items-center">
                                        <div class="rounded "
                                            style="width: 60px; padding: 7px 0; margin: 0 auto;  background-color: {{ $color?->color_code }}; color: {{ $color?->name == 'N/A' ? '' : 'transparent' }}">
                                            {{ $color?->name }}</div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            class="btn btn-primary btn-icon editBtn" data-id="{{ $color?->id }}"
                                            data-name="{{ $color?->name }}" data-code="{{ $color?->color_code }}"><i
                                                data-lucide="edit"></i></button>
                                        <a class="btn btn-danger btn-icon deleteConfirm"
                                            href="{{ route('color.destroy', $color?->id) }}">
                                            <i data-lucide="trash-2"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-danger text-center">No Color Found</td>
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
                    <h5 class="card-title">Add New Color</h5>
                </div>
                <div class="card-footer">
                    <form action="{{ route('color.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="" class="form-label">Color Name</label>
                            <input type="text" name="name" id="colorName" placeholder="Color Name"
                                class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="form-label">Color Code</label>
                            <input type="text" name="color_code" id="colorCode" placeholder="Color Code"
                                class="form-control">
                            @error('color_code')
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Color</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editColorForm" action="" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-4">
                            <label for="" class="form-label">Color Name</label>
                            <input type="text" name="name" id="editColorName" placeholder="Color Name"
                                class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="form-label">Color Code</label>
                            <input type="text" name="color_code" id="editColorCode" placeholder="Color Code"
                                class="form-control">
                            @error('color_code')
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
            $('#colorTable').DataTable();
        });


        $('.editBtn').click(function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const colorCode = $(this).data('code');
            const url = '{{ route('color.update', ':id') }}'.replace(':id', id);

            $('#editColorName').val(name);
            $('#editColorCode').val(colorCode);
            $('#editColorForm').attr('action', url);

        })
    </script>
@endpush
