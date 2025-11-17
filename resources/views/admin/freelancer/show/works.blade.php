<div id="worksSection">
    @foreach($obj->works as $work)
        <div class="border rounded p-3 mb-2">
            <div class="fs-5 fw-bold text-success"><a href="{{ route('auth.clients.show', $work->client_id) }}" class="text-decoration-none text-success">{{ $work->client->first_name }} {{ $work->client->last_name }}</a><span class="text-dark"> / Work ID: <a href="{{ route('auth.works.show', $work->id) }}" class="text-decoration-none text-success">{{ $work->id }}</a></span></div>
            <div class="fw-semibold small mb-1">{{ $work->projectLength() }}</div>
            <div class="d-flex justify-content-between text-secondary pt-2">
                <span class="badge bg-secondary-subtle text-secondary-emphasis">${{ $work->price }}</span>
                <span class="badge bg-{{ $work->jobTypeColor() }}-subtle text-{{ $work->jobTypeColor() }}-emphasis">{{ $work->jobType() }}</span>
                <span class="badge bg-{{ $work->projectTypeColor() }}-subtle text-{{ $work->projectTypeColor() }}-emphasis">{{ $work->projectType() }}</span>
                <span class="badge bg-{{ $work->hoursPerWeekColor() }}-subtle text-{{ $work->hoursPerWeekColor() }}-emphasis">{{ $work->hoursPerWeek() }}</span>
                <span class="badge bg-{{ $work->experienceLevelColor() }}-subtle text-{{ $work->experienceLevelColor() }}-emphasis">{{ $work->experienceLevel() }}</span>
            </div>
        </div>
    @endforeach
</div>
