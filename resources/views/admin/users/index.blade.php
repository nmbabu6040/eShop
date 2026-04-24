@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="font-weight-bold mb-0">Users</h4>
                    </div>
                    <div class="">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search"
                                    aria-label="Search" aria-describedby="basic-addon1"
                                    value="{{ request()->query('search') }}">
                                <button type="submit" class="btn btn-outline-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th>
                                        <th> Email </th>
                                        <th> Role </th>
                                        <th class="text-center"> Thumbnail </th>
                                        <th class="text-right"> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users ?? [] as $user)
                                        <tr>
                                            <td> {{ $user->id }} </td>
                                            <td> {{ $user->name }} </td>
                                            <td> {{ $user->email }} </td>
                                            <td class="">
                                                <p class="d-inline-block bg-success text-white px-2 py-1"
                                                    style="font-size: 12px; border-radius: 8px;">
                                                    {{ $user->getRoleNames()->first() }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <img src="{{ $user->thumbnail }}" alt="" class="img-fluid"
                                                    style="width: 40px">
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
