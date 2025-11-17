@extends('freelancer.layouts.app')
@section('title')
    Freelacner
@endsection
@section('content')
    <div class="row p-4">
        <div class="col text-end">
            <a class="btn btn-primary" href="#" onclick="event.preventDefault(); document.getElementById('logout').submit();"><i class="bi-box-arrow-in-left"> </i>Log Out</a>
            <form method="POST" action="{{ route('freelancer.logout') }}" id="logout">
                @csrf
            </form>
        </div>
    </div>
    <div class="fs-3 fw-semibold text-center">Welcome Freelancer Page</div>
@endsection
