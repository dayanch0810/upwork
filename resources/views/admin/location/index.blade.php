@extends('layouts.app')
@section('title')
    Locations
@endsection
@section('content')
    <div>
        @include('admin.app.nav')
    </div>

    <div class="h3 p-3">
        Locations
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="small">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Freelancers</th>
                <th>Clients</th>
            </tr>
            </thead>

            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>{{ $obj->name }}</td>
                    <td><a href="{{ route('v1.auth.freelancers.index', ['location' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->freelancers_count }}</a></td>
                    <td><a href="{{ route('v1.auth.clients.index', ['location' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->clients_count }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $objs->links() }}</div>
@endsection
