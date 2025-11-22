@extends('admin.layouts.app')
@section('title')
    Clients
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="row align-items-center p-3">
        <div class="col h3 text-start">
            Clients
        </div>

        <div class="col text-end">
            <a href="{{ route('auth.clients.create') }}" class="btn btn-primary"><i class="bi-plus"></i></a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="small">
            <tr>
                <th>Id</th>
                <th>Location</th>
                <th>Name<br>surname</th>
                <th>Avatar</th>
                <th>Username</th>
                <th>Rating</th>
                <th>Email Verified</th>
                <th>Payment Method Verified</th>
                <th>Total Jobs</th>
                <th>Total Spent</th>
                <th>Works</th>
                <th>Reviews</th>
                <th>Deleted At</th>
                <th class="text-center"><i class="bi-gear"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>{{ $obj->location?->name }}</td>
                    <td>
                        <a href="{{ route('auth.clients.show', $obj->id) }}" class="text-decoration-none">
                            {{ $obj->first_name }} <br> {{ $obj->last_name }}
                        </a>
                    </td>
                    <td>{{ $obj->avatar }}</td>
                    <td>{{ $obj->username }}</td>
                    <td><i class="bi-star-fill text-warning"> </i>{{ $obj->rating }}</td>
                    <td>
                        @if($obj->email_verified)
                            <div class="badge bg-success-subtle text-success-emphasis">Verified</div>
                        @else
                            <div class="badge bg-danger-subtle text-danger-emphasis">Not Verified</div>
                        @endif
                    </td>
                    <td>
                        @if($obj->payment_method_verified)
                            <div class="badge bg-success-subtle text-success-emphasis">Verified</div>
                        @else
                            <div class="badge bg-danger-subtle text-danger-emphasis">Not Verified</div>
                        @endif
                    </td>
                    <td><i class="bi-briefcase"></i> {{ $obj->total_jobs }}</td>
                    <td><i class="bi-currency-dollar"></i>{{ $obj->total_spent }}</td>
                    <td><a href="{{ route('auth.works.index', ['client' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->works_count }}</a></td>
                    <td><a href="{{ route('auth.reviews.index', ['client' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->my_reviews_count }}</a></td>
                    <td>
                        @if ($obj->deleted_at)
                            <div class="badge bg-danger-subtle text-danger-emphasis">{{ $obj->deleted_at->format('d.m.Y H:i') }}</div>
                        @else
                            <div class="badge bg-success-subtle text-success-emphasis">Null</div>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="mb-1">
                            @if($obj->deleted_at)
                                <form method="POST" action="{{ route('auth.clients.restore', $obj->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="bi-arrow-counterclockwise"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('auth.clients.edit', $obj->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="bi-pencil-fill"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                        <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $obj->id }}">
                            @if($obj->deleted_at)
                                <i class="bi-trash"></i>
                            @else
                                <i class="bi-trash-fill"></i>
                            @endif
                        </button>
                        <div class="modal fade" id="deleteModal{{ $obj->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                                        @if($obj->deleted_at)
                                            <form method="POST" action="{{ route('auth.clients.forceDelete', $obj->id) }}">
                                                @csrf
                                                {{ method_field('DELETE') }}

                                                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark btn-sm">Delete</button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('auth.clients.destroy', $obj->id) }}">
                                                @csrf
                                                {{ method_field('DELETE') }}

                                                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark btn-sm">Delete</button>
                                            </form>
                                        @endif
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
