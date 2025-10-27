@extends('layouts.app')
@section('title')
    Works
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="h3 p-3">
        Works
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
                <th>Proposals</th>
                <th width="7.5%">Created At</th>
            </tr>
            </thead>

            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td class="text-center fw-medium text-muted">
                        <a href="{{ route('v1.auth.works.show', $obj->id) }}" class="text-decoration-none">{{ $obj->id }}</a>
                    </td>
                    <td>
                        <a href="{{ route('v1.auth.clients.index', ['client' => $obj->client_id]) }}" class="text-decoration-none" target="_blank">
                            {{ $obj->client->first_name }} {{ $obj->client->last_name }}
                        </a>
                    </td>
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
                    <td><a href="{{ route('v1.auth.skills.index', ['workSkills' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->work_skills_count }}</a></td>
                    <td><a href="{{ route('v1.auth.proposals.index', ['work' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->proposals_count }}</a></td>
                    <td>{{ $obj->created_at->format('d-m-Y H:i') }}</td>
{{--                    <td><a href="{{ route('v1.auth.works.show', $obj->id) }}" class="text-decoration-none fs-6 fw-bold">Show</a></td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $objs->links() }}</div>
@endsection
