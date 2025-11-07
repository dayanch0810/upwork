@extends('admin.layouts.app')
@section('title')
    Auth Attempt
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="row align-items-center p-3">
        <div class="col h3 text-start">
            Auth Attempt
        </div>

        <div class="col-auto">
            @include('admin.app.alert')
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="small">
            <tr>
                <th>ID</th>
                <th>Ip Address</th>
                <th width="50%">User Agent</th>
                <th>Username</th>
                <th>Event</th>
                <th>Created At</th>
            </tr>
            </thead>

            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>
                        {{ $obj->ipAddress->getIp() }}
                        <div class="small text-secondary">{{ $obj->ipAddress->ip_address }}</div>
                    </td>
                    <td>
                        {{ $obj->userAgent->getUa() }}
                        <div class="small text-secondary">{{ $obj->userAgent->user_agent }}</div>
                    </td>
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
