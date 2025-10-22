@extends('layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="container-fluid py-3">
        @include('admin.app.alert')
    </div>
@endsection
