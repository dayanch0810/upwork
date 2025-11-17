<div id="profilesSection" style="display: none;">
    @foreach($obj->profiles as $profile)
        <div class="p-3 border rounded mb-2">
            <div class="row align-items-center">
                <div class="col">
                    <div class="fs-5 fw-bold text-success">{{ $profile->title }}</div>
                </div>
                <div class="col text-end">
                    <div class="fw-bold text-secondary small">{{ $profile->created_at->format('d.m.Y H:i') }}</div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-secondary">{{ $profile->body }}</div>
                </div>
                <div class="col-auto">
                    <div class="mb-1">
                        <a href="{{ route('auth.profiles.edit', [$profile->id, $obj->id]) }}" class="btn btn-success btn-sm">
                            <i class="bi-pencil-fill"></i>
                        </a>
                    </div>
                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $profile->id }}">
                        <i class="bi-trash-fill"></i>
                    </button>
                    <div class="modal fade" id="deleteModal{{ $profile->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title fs-5" id="deleteModalLabel">Delete</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $profile->id }}
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="{{ route('auth.profiles.destroy', $profile->id) }}">
                                        @csrf
                                        {{ method_field('DELETE') }}

                                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-dark btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
