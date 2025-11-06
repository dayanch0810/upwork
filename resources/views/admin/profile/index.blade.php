@extends('layouts.app')
@section('title')
    Profiles
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="row align-items-center p-3">
        <div class="col h3 text-start">
            Profiles
        </div>

        <div class="col text-end">
            <a href="{{ route('v1.auth.profiles.create') }}" class="btn btn-dark">Add <i class="bi-plus"></i></a>
        </div>
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
                <th class="text-center"><i class="bi-gear"></i></th>
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
                    <td>{{ $obj->title }}</td>
                    <td>{{ $obj->body }}</td>
                    <td><a href="{{ route('v1.auth.works.index', ['profile' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->works_count }}</a></td>
                    <td><a href="{{ route('v1.auth.proposals.index', ['profile' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->proposals_count }}</a></td>
                    <td>{{ $obj->created_at->format('d-m-Y H:i') }}</td>
                    <td class="text-center">
                        <div class="mb-1">
                            <a href="{{ route('v1.auth.profiles.edit', $obj->id) }}" class="btn btn-success btn-sm">
                                <i class="bi-pencil-fill"></i>
                            </a>
                        </div>
                        <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="bi-trash-fill"></i>
                        </button>
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title fs-5" id="deleteModalLabel">Delete</div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{ $obj->id }}
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" action="{{ route('v1.auth.profiles.destroy', $obj->id) }}">
                                            @csrf
                                            {{ method_field('DELETE') }}

                                            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="position-fixed bottom-0 end-0 p-2" style="z-index: 9999;">
        <div class="col">
            @include('admin.app.alert')
        </div>
    </div>
    <div>{{ $objs->links() }}</div>
@endsection
