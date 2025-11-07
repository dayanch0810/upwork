@extends('admin.layouts.app')
@section('title')
    Work ID: {{ $obj->id }}
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="container-fluid">
        <div class="fs-3 fw-bold p-4">Work ID: {{ $obj->id }}</div>
        <div class="row border border-1 border-secondary">
            <div class="col-4 border border-1 border-secondary">
                <div class="row border border-top-0 border-end-0 border-1 border-secondary p-2">
                    <div class="p-2">
                        <div class="fs-4 fw-bold">Client</div>
                        <div class="fw-semibold"><a href="{{ route('auth.clients.show', $obj->client_id) }}" class="text-decoration-none text-success">{{ $obj->client?->first_name }} {{ $obj->client?->last_name }}</a></div>
                    </div>
                    @if($obj->freelancer)
                        <div class="p-2">
                            <div class="fs-4 fw-bold">Freelancer</div>
                            <div class="fw-semibold"><a href="{{ route('auth.freelancers.show', $obj->freelancer_id) }}" class="text-decoration-none text-success">{{ $obj->freelancer?->first_name }} {{ $obj->freelancer?->last_name }}</a> / <span class="text-secondary small">Profile ID: {{ $obj->profile_id }}</span></div>
                        </div>
                    @else
                        <div class="p-2">
                            <div class="fs-4 fw-bold">Freelancer</div>
                            <div class="fw-semibold text-success">Not freelancer</div>
                        </div>
                    @endif
                </div>
                <div class="row row-cols-3 text-center border border-top border-0 border-secondary p-2">
                    <div class="col">
                        <div class="fw-bold fs-5">
                            ${{ $obj->price }}
                        </div>
                        <div class="text-secondary small">Price</div>
                    </div>
                    <div class="col">
                        <div class="fw-bold fs-5">
                            {{ $obj->number_of_proposals }}
                        </div>
                        <div class="text-secondary small">Number of proposals</div>
                    </div>
                    <div class="col">
                        <span class="fs-6 badge bg-{{ $obj->jobTypeColor() }}-subtle text-{{ $obj->jobTypeColor() }}-emphasis">{{ $obj->jobType() }}</span>
                        <div class="text-secondary small">Job type</div>
                    </div>
                </div>
                <div class="row row-cols-3 text-center border border-0 border-secondary p-2">
                    <div class="col">
                        <span class="fs-6 badge bg-{{ $obj->projectTypeColor() }}-subtle text-{{ $obj->projectTypeColor() }}-emphasis">{{ $obj->projectType() }}</span>
                        <div class="text-secondary small">Project type</div>
                    </div>
                    <div class="col">
                        <span class="fs-6 badge bg-{{ $obj->projectLengthColor() }}-subtle text-{{ $obj->projectLengthColor() }}-emphasis">{{ $obj->projectLength() }}</span>
                        <div class="text-secondary small">Project length</div>
                    </div>
                    <div class="col">
                        <span class="fs-6 badge bg-{{ $obj->experienceLevelColor() }}-subtle text-{{ $obj->experienceLevelColor() }}-emphasis">{{ $obj->experienceLevel() }}</span>
                        <div class="text-secondary small">Experience level</div>
                    </div>
                </div>
                <div class="row text-center border border-0 border-secondary p-2">
                    <div class="col">
                        <span class="fs-6 badge bg-{{ $obj->hoursPerWeekColor() }}-subtle text-{{ $obj->hoursPerWeekColor() }}-emphasis">{{ $obj->hoursPerWeek() }}</span>
                        <div class="text-secondary small">Hours per week</div>
                    </div>
                </div>
            </div>
            <div class="col-8 border border-1 border-secondary">
                <div class="p-3">
                    <div class="fs-4 fw-bold">
                        Title
                    </div>
                    <div class="text-secondary fw-semibold">{{ $obj->title }}</div>
                    <div class="fs-4 fw-bold pt-3">
                        Body
                    </div>
                    <div class="text-secondary fw-semibold">{{ $obj->body }}</div>
                    <div class="fs-4 fw-bold pt-3">Skills</div>
                    @foreach($obj->workSkills as $skill)
                        <div class="fs-6 badge bg-secondary-subtle text-secondary-emphasis">{{ $skill->name }}</div>
                    @endforeach

                    <div class="fs-4 fw-bold pt-3 pb-1">Proposals</div>
                    <div id="proposalsSection">
                        @foreach($obj->proposals as $proposal)
                            <div class="p-3 border rounded mb-2">
                                <div class="row">
                                    <div class="col">
                                        <div class="fs-5 fw-bold"><a href="{{ route('auth.freelancers.show', $proposal->freelancer_id) }}" class="text-decoration-none text-success">{{ $proposal->freelancer?->first_name }} {{ $proposal->freelancer?->last_name }}</a><span class="text-dark"> / Profile ID: {{ $proposal->profile_id }}</span></div>
                                    </div>
                                    <div class="col text-end">
                                        <div class="fw-bold text-secondary small">{{ $proposal->created_at->format('d.m.Y H:m') }}</div>
                                    </div>
                                </div>
                                <div class="text-secondary">{{ $proposal->cover_letter }}</div>
                                <div class="badge bg-{{ $proposal->statusColor() }}-subtle text-{{ $proposal->statusColor() }}-emphasis">{{ $proposal->status() }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection
