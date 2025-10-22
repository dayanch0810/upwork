@extends('layouts.app')
@section('title')
    Visitors
@endsection
@section('content')
    <div>
        @include('admin.app.nav')
    </div>

    <div class="h3 p-3">
        Visitors
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="small">
            <tr>
                <th>Id</th>
                <th>Ip Address</th>
                <th>User Agent</th>
                <th>Hits</th>
                <th>Suspect Hits</th>
                <th>Robot</th>
                <th>API</th>
                <th>Disabled</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>{{ $obj->ip_address }}</td>
                    <td>{{ $obj->user_agent }}</td>
                    <td>{{ $obj->hits }}</td>
                    <td>{{ $obj->suspect_hits }}</td>
                    <td>
                        <span class="badge bg-{{ $obj->robotColor() }}-subtle text-{{ $obj->robotColor() }}-emphasis">
                            {{ $obj->robot() }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $obj->apiColor() }}-subtle text-{{ $obj->apiColor() }}-emphasis">
                            {{ $obj->api() }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $obj->disabledColor() }}-subtle text-{{ $obj->disabledColor() }}-emphasis">
                            {{ $obj->disabled() }}
                        </span>
                    </td>
                    <td>{{ $obj->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $obj->updated_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>{{ $objs->links() }}</div>
@endsection
