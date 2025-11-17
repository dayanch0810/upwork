@extends('admin.layouts.app')
@section('title')
    Upwork
@endsection
@section('content')
    <div class="container-xl text-center py-3">
        <div class="row my-3">
            <div class="col text-end">
                <a href="{{ route('login.select') }}" class="btn btn-primary px-5">
                    <i class="bi-box-arrow-in-right"> </i>Log In
                </a>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-xl-4 g-3">
            @foreach($works as $work)
                <div class="col">
                    <div class="border">
                        <div>{{ $work->uuid }}</div>
                        <div>{!! QrCode::size(200)->generate($work->uuid) !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
