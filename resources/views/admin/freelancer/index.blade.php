@extends('layouts.app')
@section('title')
    Freelancers
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="row align-items-center p-3">
        <div class="col-auto h3 text-start">
            Freelancers
        </div>

        <div class="col text-end">
            <a href="{{ route('v1.auth.freelancers.create') }}" class="btn btn-dark">Add <i class="bi-plus"></i></a>
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
                <th width="10%">Username</th>
                <th>Rating</th>
                <th>Verified</th>
                <th>Total Jobs</th>
                <th>Total Earnings</th>
                <th>Profiles</th>
                <th>Skills</th>
                <th>Reviews</th>
                <th>Works</th>
                <th>Proposals</th>
                <th>Created At</th>
                <th class="text-center"><i class="bi-gear"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>{{ $obj->location?->name ?? 'Not specified' }}</td>
                    <td>
                        <a href="{{ route('v1.auth.freelancers.show', $obj->id) }}" class="text-decoration-none">
                            {{ $obj->first_name }} <br> {{ $obj->last_name }}
                        </a>
                    </td>
                    <td>{{ $obj->avatar }}</td>
                    <td>+993 {{ $obj->username }}</td>
                    <td><i class="bi-star-fill text-warning"> </i>{{ $obj->rating }}</td>
                    <td>
                        @if($obj->verified)
                            <div class="badge bg-success-subtle text-success-emphasis">Verified</div>
                        @else
                            <div class="badge bg-warning-subtle text-warning-emphasis">Not Verified</div>
                        @endif
                    </td>
                    <td><i class="bi-briefcase"></i> {{ $obj->total_jobs }}</td>
                    <td><i class="bi-currency-dollar"></i>{{ $obj->total_earnings }}</td>
                    <td><a href="{{ route('v1.auth.profiles.index', ['freelancer' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->profiles_count }}</a></td>
                    <td><a href="{{ route('v1.auth.skills.index', ['freelancerSkills' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->freelancer_skills_count }}</a></td>
                    <td><a href="{{ route('v1.auth.reviews.index', ['freelancer' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->my_reviews_count }}</a></td>
                    <td><a href="{{ route('v1.auth.works.index', ['freelancer' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->works_count }}</a></td>
                    <td><a href="{{ route('v1.auth.proposals.index', ['freelancer' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->proposals_count }}</a></td>
                    <td>{{ $obj->created_at->format('d-m-Y H:i') }}</td>
                    <td class="text-center">
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
                                        <form method="POST" action="{{ route('v1.auth.freelancers.destroy', $obj->id) }}">
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
