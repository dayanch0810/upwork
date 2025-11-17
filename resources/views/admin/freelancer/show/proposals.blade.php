<div id="proposalsSectionAll" style="display: none;">
    @foreach($obj->proposals as $proposal)
        <div class="p-3 border rounded mb-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="fs-5 fw-bold">Work ID: <a href="{{ route('auth.works.show', $proposal->work_id) }}" class="text-decoration-none">{{ $proposal->work_id }}</a> / <span>Profile ID: {{ $proposal->profile_id }}</span></div>
                </div>
                <div class="col text-end">
                    <div class="fw-bold text-secondary small">{{ $proposal->created_at->format('d.m.Y H:i') }}</div>
                </div>
            </div>
            <div class="text-secondary">{{ $proposal->cover_letter }}</div>
            <div class="badge bg-{{ $proposal->statusColor() }}-subtle text-{{ $proposal->statusColor() }}-emphasis">{{ $proposal->status() }}</div>
        </div>
    @endforeach
</div>

@foreach($obj->profiles as $profile)
    <div id="proposalsSectionProfile{{ $profile->id }}" style="display: none;">
        @foreach($obj->proposals as $proposal)
            @if($profile->id == $proposal->profile_id)
                <div class="p-3 border rounded mb-2">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="fs-5 fw-bold">Work ID: <a href="{{ route('auth.works.show', $proposal->work_id) }}" class="text-decoration-none">{{ $proposal->work_id }}</a> / <span>Profile ID: {{ $proposal->profile_id }}</span></div>
                        </div>
                        <div class="col text-end">
                            <div class="fw-bold text-secondary small">{{ $proposal->created_at->format('d.m.Y H:i') }}</div>
                        </div>
                    </div>
                    <div class="text-secondary">{{ $proposal->cover_letter }}</div>
                    <div class="badge bg-{{ $proposal->statusColor() }}-subtle text-{{ $proposal->statusColor() }}-emphasis">
                        {{ $proposal->status() }}
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endforeach
