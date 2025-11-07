@extends('admin.layouts.app')
@section('title')
    Reviews
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="row align-items-center p-3">
        <div class="col h3 text-start">
            Reviews
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
                <th>Clients</th>
                <th>Freelancers</th>
                <th>From</th>
                <th>Rating</th>
                <th>Comment</th>
                <th width="8%">Created At</th>
                <th width="8%">Updated At</th>
            </tr>
            </thead>

            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>
                        <a href="{{ route('auth.clients.index', ['client' => $obj->client_id]) }}" class="text-decoration-none" target="_blank">
                            {{ $obj->client->first_name }} {{ $obj->client->last_name }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('auth.freelancers.index', ['freelancer' => $obj->freelancer_id]) }}" class="text-decoration-none" target="_blank">
                            {{ $obj->freelancer?->first_name }} {{ $obj->freelancer?->last_name }}
                        </a>
                    </td>
                    <td>
                        <span class="badge bg-{{ $obj->fromColor() }}-subtle text-{{ $obj->fromColor() }}-emphasis">
                            {{ $obj->from }}
                        </span>
                    </td>
                    <td><i class="bi-star-fill text-warning"> </i>{{ $obj->rating }}</td>
                    <td>{{ $obj->comment }}</td>
                    <td>{{ $obj->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $obj->updated_at->format('d.m.Y H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $objs->links() }}</div>
@endsection
