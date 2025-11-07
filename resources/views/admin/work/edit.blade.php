@extends('admin.layouts.app')
@section('title')
    Works
@endsection
@section('content')
    <div class="container-xxl py-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-6">

                <div class="h4 mb-3">
                    <a href="{{ route('auth.works.index') }}" class="text-decoration-none">
                        <i class="bi-chevron-left"></i> Works
                    </a> / Edit
                </div>

                <form action="{{ route('auth.works.update', $obj->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label for="client" class="form-label fw-semibold">
                                Client <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('client') is-invalid @enderror" id="client" name="client" required autofocus>
                                @foreach($clients as $client)
                                    <option value="{{ $client->id }}" {{ $client->id == $obj->client_id ? 'selected':'' }}>
                                        {{ $client->first_name }} {{ $client->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('client')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="freelancer" class="form-label fw-semibold">
                                Freelancer <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('freelancer') is-invalid @enderror" id="freelancer" name="freelancer" required autofocus>

                                @if($obj->freelancer_id == null)
                                    <option value="" {{ $obj->freelancer_id === null ? 'selected' : '' }}>
                                        Not Freelancer
                                    </option>
                                @endif

                                @foreach($freelancers as $freelancer)
                                    <option value="{{ $freelancer->id }}" {{ $freelancer->id == $obj->freelancer_id ? 'selected':'' }}>
                                        {{ $freelancer->first_name }} {{ $freelancer->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('freelancer')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label for="profile" class="form-label fw-semibold">
                                Profile ID <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('profile') is-invalid @enderror" id="profile" name="profile" required autofocus>

                                @if($obj->profile_id == null)
                                    <option value="" {{ $obj->profile_id === null ? 'selected' : '' }}>
                                        Not Profile
                                    </option>
                                @endif

                                @foreach($profiles->where('freelancer_id', $obj->freelancer_id) as $profile)
                                    <option value="{{ $profile->id }}" {{ $profile->id == $obj->profile_id ? 'selected':'' }}>
                                        {{ $profile->id }}
                                    </option>
                                @endforeach
                            </select>
                            @error('profile')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="number_of_proposals" class="form-label fw-semibold">
                                Number Of Proposals <span class="text-danger">*</span>
                            </label>
                            <input type="number" min="0"
                                   class="form-control @error('number_of_proposals') is-invalid @enderror" id="number_of_proposals"
                                   name="number_of_proposals" value="{{ $obj->number_of_proposals }}" required>
                            @error('number_of_proposals')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="price" class="form-label fw-semibold">
                                Price <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.1" min="0"
                                   class="form-control @error('price') is-invalid @enderror" id="price"
                                   name="price" value="{{ $obj->price }}" required>
                            @error('price')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label for="experience_level" class="form-label fw-semibold">
                                Experience Level <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('experience_level') is-invalid @enderror" id="experience_level" name="experience_level" required>
                                @foreach($obj->experienceLevelList() as $key => $label)
                                    <option value="{{ $key }}" {{ $key == $obj->experience_level ? 'selected':'' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('experience_level')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="hours_per_week" class="form-label fw-semibold">
                                Hours Per Week <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('hours_per_week') is-invalid @enderror" id="hours_per_week" name="hours_per_week" required>
                                @foreach($obj->hoursPerWeekList() as $key => $label)
                                    <option value="{{ $key }}" {{ $key == $obj->hours_per_week ? 'selected':'' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('hours_per_week')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label for="job_type" class="form-label fw-semibold">
                                Job Type <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('job_type') is-invalid @enderror" id="job_type" name="job_type" required>
                                @foreach($obj->jobTypeList() as $key => $label)
                                    <option value="{{ $key }}" {{ $key == $obj->job_type ? 'selected':'' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('price')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="project_type" class="form-label fw-semibold">
                                Project Type <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('project_type') is-invalid @enderror" id="project_type" name="project_type" required>
                                @foreach($obj->projectTypeList() as $key => $label)
                                    <option value="{{ $key }}" {{ $key == $obj->project_type ? 'selected':'' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_type')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="project_length" class="form-label fw-semibold">
                                Project Length <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('project_length') is-invalid @enderror" id="project_length" name="project_length" required>
                                @foreach($obj->projectLengthList() as $key => $label)
                                    <option value="{{ $key }}" {{ $key == $obj->project_length ? 'selected':'' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_length')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">
                            Title <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('title') is-invalid @enderror"
                                  name="title" id="title" rows="2" required>{{ $obj->title }}</textarea>
                        @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label fw-semibold">
                            Body <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('body') is-invalid @enderror"
                                  name="body" id="body" rows="2" required>{{ $obj->body }}</textarea>
                        @error('body')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Update
                    </button>
                </form>

            </div>
        </div>
    </div>

    <script>
        const allProfiles = @json($profiles);

        const freelancerSelect = document.getElementById('freelancer');
        const profileSelect = document.getElementById('profile');

        freelancerSelect.addEventListener('change', function () {
            const freelancerId = parseInt(this.value);

            profileSelect.innerHTML = '';

            const filteredProfiles = allProfiles.filter(p => p.freelancer_id === freelancerId);

            if (filteredProfiles.length === 0) {
                const opt = document.createElement('option');
                opt.value = '';
                opt.textContent = 'No profiles found';
                profileSelect.appendChild(opt);
                return;
            }

            filteredProfiles.forEach(profile => {
                const opt = document.createElement('option');
                opt.value = profile.id;
                opt.textContent = profile.id;
                profileSelect.appendChild(opt);
            });
        });
    </script>
@endsection
