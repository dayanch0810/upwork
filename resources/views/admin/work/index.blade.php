@extends('admin.layouts.app')
@section('title')
    Works
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="row align-items-center p-3">
        <div class="col h3 text-start">
            Works
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
                <th>Client</th>
                <th>Freelancer</th>
                <th>Profile Id</th>
                <th width="5%">Price</th>
                <th>Experience Level</th>
                <th>Job Type</th>
                <th>Project Type</th>
                <th>Project Length</th>
                <th>Hours Per Week</th>
                <th>Work Skills</th>
                <th width="7.5%">Created At</th>
                <th class="text-center"><i class="bi-gear"></i></th>
            </tr>
            </thead>

            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td class="text-center fw-medium text-muted">
                        <a href="{{ route('auth.works.show', $obj->id) }}" class="text-decoration-none">{{ $obj->id }}</a>
                    </td>
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
                    <td class="text-center">
                        @if($obj->profile_id)
                            <a href="{{ route('auth.profiles.index', ['profile' => $obj->profile_id]) }}" class="text-decoration-none" target="_blank">
                                {{ $obj->profile?->id }}
                            </a>
                        @endif
                    </td>
                    <td><i class="bi-currency-dollar"></i>{{ $obj->price }}</td>
                    <td>
                        <span class="badge bg-{{ $obj->experienceLevelColor() }}-subtle text-{{ $obj->experienceLevelColor() }}-emphasis">
                            {{ $obj->experienceLevel() }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $obj->jobTypeColor() }}-subtle text-{{ $obj->jobTypeColor() }}-emphasis">
                            {{ $obj->jobType() }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $obj->projectTypeColor() }}-subtle text-{{ $obj->projectTypeColor() }}-emphasis">
                            {{ $obj->projectType() }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $obj->projectLengthColor() }}-subtle text-{{ $obj->projectLengthColor() }}-emphasis">
                            {{ $obj->projectLength() }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $obj->hoursPerWeekColor() }}-subtle text-{{ $obj->hoursPerWeekColor() }}-emphasis">
                            {{ $obj->hoursPerWeek() }}
                        </span>
                    </td>
                    <td><a href="{{ route('auth.skills.index', ['workSkills' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->work_skills_count }}</a></td>
                    <td>{{ $obj->created_at->format('d.m.Y H:i') }}</td>
                    <td class="text-center">
                        <div class="mb-1">
                            <a href="{{ route('auth.works.edit', $obj->id) }}" class="btn btn-success btn-sm">
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
                                        <form method="POST" action="{{ route('auth.works.destroy', $obj->id) }}">
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

    <div>{{ $objs->links() }}</div>
@endsection
