@extends('layouts.app')
@section('title')
    Profiles
@endsection
@section('content')
    <div>
        @include('admin.app.nav')
    </div>

    <div class="h3 p-3">
        Profiles
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="small">
            <tr>
                <th>Id</th>
                <th width="10%">Freelancer</th>
                <th>Title</th>
                <th>Body</th>
                <th>Works</th>
                <th>Proposals</th>
                <th width="8%">Created At</th>
                <th width="8%">Updated At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>
                        <a href="{{ route('v1.auth.freelancers.index', ['freelancer' => $obj->freelancer_id]) }}" class="text-decoration-none" target="_blank">
                            {{ $obj->freelancer?->first_name }} {{ $obj->freelancer?->last_name }}
                            <i class="bi-box-arrow-up-right"></i>
                        </a>
                    </td>
                    <td>{{ $obj->title }}</td>
                    <td>{{ $obj->body }}</td>
                    <td><a href="{{ route('v1.auth.works.index', ['profile' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->works_count }}</a></td>
                    <td><a href="{{ route('v1.auth.proposals.index', ['profile' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->proposals_count }}</a></td>
                    <td>{{ $obj->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $obj->updated_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>{{ $objs->links() }}</div>
@endsection
