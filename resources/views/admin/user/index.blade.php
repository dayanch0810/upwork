@extends('layouts.app')
@section('title')
    Admins
@endsection
@section('content')
    <div>
        @include('admin.app.nav')
    </div>

    <div class="h3 p-3">
        Admins
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="small">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Username</th>
            </tr>
            </thead>
            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>{{ $obj->name }}</td>
                    <td>{{ $obj->username }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>{{ $objs->links() }}</div>
@endsection
