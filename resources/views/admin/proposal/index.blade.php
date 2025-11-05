@extends('layouts.app')
@section('title')
    Proposals
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="row align-items-center p-3">
        <div class="col h3 text-start">
            Proposals
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
                <th>Freelancer</th>
                <th width="6%">Profile Id</th>
                <th width="5%">Work Id</th>
                <th>Cover Letter</th>
                <th>Status</th>
                <th width="7.5%">Created At</th>
                <th width="7.5%">Updated At</th>
            </tr>
            </thead>

            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>
                        <a href="{{ route('v1.auth.freelancers.index', ['freelancer' => $obj->freelancer_id]) }}" class="text-decoration-none" target="_blank">
                            {{ $obj->freelancer?->first_name }} {{ $obj->freelancer?->last_name }}
                        </a>
                    </td>
                    <td>
                        @if($obj->profile_id)
                            <a href="{{ route('v1.auth.profiles.index', ['profile' => $obj->profile_id]) }}" class="text-decoration-none" target="_blank">
                                <i class="bi-box-arrow-up-right"> </i>
                                {{ $obj->profile?->id }}
                            </a>
                        @endif
                    </td>
                    <td>
                        @if($obj->work_id)
                            <a href="{{ route('v1.auth.works.index', ['work' => $obj->work_id]) }}" class="text-decoration-none" target="_blank">
                                <i class="bi-box-arrow-up-right"> </i>
                                {{ $obj->work->id }}
                            </a>
                        @endif
                    </td>
                    <td>{{ $obj->cover_letter }}</td>
                    <td>
                        <span class="badge bg-{{ $obj->statusColor() }}-subtle text-{{ $obj->statusColor() }}-emphasis">
                            {{ $obj->status() }}
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
