@extends('web.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-3">
                @include('web.dashboard.sidebar')
            </div>
            <div class="col-md-9">
                <div class="d-flex justify-content-center align-items-center">
                    <h5>Welcome to Dashboard - <span class="text-primary">{{ auth()->user()->name }}</span></h5>
                </div>
            </div>
        </div>
    </div>
@endsection
