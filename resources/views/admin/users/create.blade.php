@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Add New User</h4>
                        </div>
                        <div>
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
                    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="" class="form-label">User Name</label>
                            <input type="text" name="name" id="name" placeholder="Enter User Name"
                                class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter User Email"
                                class="form-control" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="" class="form-label">Profile Image</label>
                            <div class="mb-2">
                                <img src="{{ asset('default.jpg') }}" alt="" width="100" id="imageprv">
                            </div>
                            <input type="file" name="image" id="image" class="form-control"
                                placeholder="Enter User Image" value="{{ old('image') }}"
                                onchange="document.getElementById('imageprv').src = window.URL.createObjectURL(this.files[0])">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
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
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('role')
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
@endsection
