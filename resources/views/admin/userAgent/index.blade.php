@extends('layouts.app')
@section('title')
    User Agent
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="row align-items-center p-3">
        <div class="col h3 text-start">
            User Agent
        </div>

        <div class="col-auto">
            @include('admin.app.alert')
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="small">
            <tr>
                <th>Id</th>
                <th>User Agent</th>
                <th>Device</th>
                <th>Platform</th>
                <th>Browser</th>
                <th>Robot</th>
                <th>Disabled</th>
            </tr>
            </thead>

            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>{{ $obj->user_agent }}</td>
                    <td>{{ $obj->device }}</td>
                    <td>{{ $obj->platform }}</td>
                    <td>{{ $obj->browser }}</td>
                    <td>{{ $obj->robot }}</td>
                    <td>
                        <span class="badge bg-{{ $obj->getDisabledColor() }}-subtle text-{{ $obj->getDisabledColor() }}-emphasis">
                            {{ $obj->getDisabled() }}
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $objs->links() }}</div>
@endsection
