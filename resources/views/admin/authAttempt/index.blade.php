@extends('layouts.app')
@section('title')
    Auth Attempt
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="h3 p-3">
        Auth Attempt
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="small">
            <tr>
                <th>Ip Address Id</th>
                <th>User Agent Id</th>
                <th>Username</th>
                <th>Event</th>
                <th>Created At</th>
            </tr>
            </thead>

            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->ip_address_id }}</td>
                    <td>{{ $obj->user_agent_id }}</td>
                    <td>{{ $obj->username }}</td>
                    <td>{{ $obj->event }}</td>
                    <td>{{ $obj->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $objs->links() }}</div>
@endsection
