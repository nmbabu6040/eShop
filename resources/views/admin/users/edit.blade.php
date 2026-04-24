@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="editTitle">Edit User</h4>
                        </div>
                        <div>
                            <button href="" type="button"
                                class="btn btn-secondary btn-sm d-inline-flex align-items-center gap-1" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <div class="mr-1">
                                    <i class="link-icon" data-feather="lock"></i>
                                </div>
                                <span class="ms-1">Reset Password</span>
                            </button>
                            <a href="{{ route('admin.user.index') }}"
                                class="btn btn-primary btn-sm d-inline-flex align-items-center gap-1">
                                <div class="mr-1">
                                    <i class="link-icon" data-feather="users"></i>
                                </div>
                                <span class="ms-1">All Users</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="" class="form-label">User Name</label>
                            <input type="text" name="name" id="name" aria-describedby="helpId"
                                placeholder="Enter User Name" class="form-control" value="{{ old('name') ?? $user->name }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter User Email"
                                class="form-control" value="{{ old('email') ?? $user->email }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="form-label">Profile Image</label>
                            <div class="mb-2">
                                <img src="{{ $user->thumbnail }}" alt="" width="100" id="imageprv">
                            </div>
                            <input type="file" name="image" id="image" class="form-control"
                                placeholder="Enter User Image" value="{{ old('image') }}"
                                onchange="document.getElementById('imageprv').src = window.URL.createObjectURL(this.files[0])">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="mb-4">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" id="password" aria-describedby="helpId"
                                placeholder="User Password" class="form-control">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-control form-select">
                                <option value="">Select Role</option>
                                <option value="admin" {{ (old('role') ?? $user->role) == 'admin' ? 'selected' : '' }}>
                                    Admin</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('role')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="mb-4 text-center">
                            <button type="submit" class="btn btn-primary" id="submit">ADD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Password change modal  --}}


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Password Change</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.user.changePassword', $user->id) }}" method="post"
                        enctype="multipart/form-data" id="changePassword">
                        @csrf

                        <div class="mb-4">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" id="password" aria-describedby="helpId"
                                placeholder="User Password" class="form-control">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class = "form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                aria-describedby="helpId" placeholder="User Password" class="form-control">
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="changePasswordBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .card .editTitle {
            color: #000;
            margin-bottom: 0;
            text-transform: uppercase;
            font-size: .875rem;
            font-weight: 600;
        }
    </style>
@endpush

@push('script')
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#exampleModal').modal('show');
            });
        </script>
    @endif

    <script>
        $('#changePasswordBtn').click(function() {
            $('#changePassword').submit();
        });
    </script>
@endpush
