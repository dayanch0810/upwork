@extends('layouts.app')
@section('title')
    {{ $obj->first_name }} {{ $obj->last_name }}
@endsection
@section('content')
    @include('admin.app.nav')

    <div class=" container-fluid border border-1 border-secondary p-3">
        <div class="row align-items-center">
            <div class="col-auto">
                @if($obj->avatar)
                    <div class="rounded-circle overflow-hidden">
                        <a href="{{ asset('storage/' . $obj->avatar) }}" data-fancybox="gallery"
                           data-caption="{{ $obj->first_name }} #1">
                            <img src="{{ asset('storage/' . $obj->avatar) }}" alt="Avatar" class="img-fluid w-100">
                        </a>
                    </div>
                @else
                    <div class="rounded-4 overflow-hidden">
                        <i class="bi-person-circle" style="font-size: 5rem"></i>
                    </div>
                @endif
            </div>
            <div class="col-auto py-2">
                <div class="fs-2 fw-bold">{{ $obj->first_name }} {{ $obj->last_name }}</div>
                <div class="fs-5 fw-semibold text-secondary">
                    <i class="bi-geo-alt-fill"></i>{{ $obj->location ? $obj->location->name : 'No location specified' }} / <i class="bi-person-fill"></i>{{ $obj->username }}
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4 border border-top-0 border-1 border-secondary">
                <div class="row border border-end-0 border-1 border-secondary p-4">
                    <div class="d-flex justify-content-around">
                        <div>
                            <div class="fw-bold fs-5">
                                @if($obj->total_earnings >= 1000 && $obj->total_earnings < 1000000)
                                    ${{ round($obj->total_earnings / 1000) }}K+
                                @elseif($obj->total_earnings >= 1000000)
                                    ${{ round($obj->total_earnings / 1000000) }}M+
                                @else
                                    ${{ $obj->total_earnings }}
                                @endif
                            </div>
                            <div class="text-secondary small">Total earnings</div>
                        </div>
                        <div>
                            <div class="fw-bold fs-5"><i class="bi-collection-fill"> </i>{{ $obj->total_jobs }}</div>
                            <div class="text-secondary small">Total jobs</div>
                        </div>
                        <div>
                            <div class="fw-bold fs-5"><i class="bi-star-fill text-warning"> </i>{{ $obj->rating }}</div>
                            <div class="text-secondary small">Total rating</div>
                        </div>
                    </div>
                </div>
                <div class="row border border-end-0 border-bottom-0 border-1 border-secondary p-4">
                    <div class="py-2">
                        <div class="fs-5 fw-bold">Verifications</div>
                        <div class="fw-semibold">Verified:
                            @if($obj->verified)
                                <i class="bi-check-circle-fill text-success"></i>
                            @else
                                <i class="bi-x-circle-fill text-danger"></i>
                            @endif
                        </div>
                    </div>
                    <div class="py-2">
                        <div class="py-1">
                            <div class="fs-5 fw-bold">Created at</div>
                            <div>{{ $obj->created_at->format('d-m-Y H:i') }}</div>
                        </div>

                        <div class="">
                            <div class="fs-5 fw-bold">Updated at</div>
                            <div>{{ $obj->updated_at->format('d-m-Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 border border-1 border-secondary p-3">
                <div class="fs-4 fw-bold py-2 px-2">Skills</div>
                @foreach($obj->freelancerSkills as $skill)
                    <div class="fs-6 fw-semibold badge bg-secondary-subtle text-secondary-emphasis">{{ $skill->name }}</div>
                @endforeach
                <div class="fs-4 fw-bold py-4 px-2">Works and Reviews</div>
                <div class="row row-cols-2 p-2">
                    <div class="">
                        <div id="tabWorks" class="btn btn-dark border-0 border-bottom border-success border-4 fw-bold">
                            Works ({{ $obj->works_count }})
                        </div>
                        <div id="tabReviews" class="btn btn-dark border-0 fw-bold">
                            Reviews ({{ $obj->my_reviews_count }})
                        </div>
                        <div id="tabProfiles" class="btn btn-dark border-0 fw-bold">
                            Profiles ({{ $obj->profiles_count }})
                        </div>
                        <div id="tabProposals" class="btn btn-dark border-0 fw-bold">
                            Proposals ({{ $obj->proposals_count }})
                        </div>
                    </div>
                </div>
                <div id="worksSection">
                    @foreach($obj->works as $work)
                        <div class="border rounded p-3 mb-2">
                            <div class="fs-5 fw-bold text-success"><a href="{{ route('v1.auth.clients.show', $work->client_id) }}" class="text-decoration-none text-success">{{ $work->client->first_name }} {{ $work->client->last_name }}</a><span class="text-dark"> / Work ID: <a href="{{ route('v1.auth.works.show', $work->id) }}" class="text-decoration-none text-success">{{ $work->id }}</a></span></div>
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
                <div id="reviewsSection" style="display: none;">
                    @foreach($obj->myReviews as $review)
                        <div class="p-3 border rounded mb-2">
                            <div class="fs-5 fw-bold text-success"><a href="{{ route('v1.auth.clients.show', $review->client_id) }}" class="text-decoration-none text-success">{{ $review->client?->first_name }} {{ $review->client->last_name }}</a></div>
                            <div class="row g-2">
                                <div class="col-auto">
                                    @foreach(range(1, 5) as $i)
                                        @if(intval($review->rating) >= $i)
                                            <i class="bi-star-fill text-warning"></i>
                                        @else
                                            <i class="bi-star text-warning"></i>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="text-secondary">{{ $review->comment }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="profilesSection" style="display: none;">
                    @foreach($obj->profiles as $profile)
                        <div class="p-3 border rounded mb-2">
                            <div class="fs-5 fw-bold text-success">{{ $profile->title }}</div>
                            <div class="row g-2">
                                <div class="text-secondary">{{ $profile->body }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div id="proposalsSection" style="display: none;">
                    @foreach($obj->proposals as $proposal)
                        <div class="p-3 border rounded mb-2">
                            <div class="fs-5 fw-bold">Work ID: <a href="{{ route('v1.auth.works.show', $proposal->work_id) }}" class="text-decoration-none">{{ $proposal->work_id }}</a></div>
                            <div class="text-secondary">{{ $proposal->cover_letter }}</div>
                            <div class="badge bg-{{ $proposal->statusColor() }}-subtle text-{{ $proposal->statusColor() }}-emphasis">{{ $proposal->status() }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        const tabWorks = document.getElementById('tabWorks');
        const tabReviews = document.getElementById('tabReviews');
        const tabProfiles = document.getElementById('tabProfiles');
        const tabProposals = document.getElementById('tabProposals');
        const worksSection = document.getElementById('worksSection');
        const reviewsSection = document.getElementById('reviewsSection');
        const profilesSection = document.getElementById('profilesSection');
        const proposalsSection = document.getElementById('proposalsSection');

        tabWorks.addEventListener('click', () => {
            worksSection.style.display = 'block';
            reviewsSection.style.display = 'none';
            profilesSection.style.display = 'none';
            proposalsSection.style.display = 'none';
            tabWorks.classList.add('border-bottom', 'border-success', 'border-4');
            tabReviews.classList.remove('border-bottom', 'border-success', 'border-4');
            tabProfiles.classList.remove('border-bottom', 'border-success', 'border-4');
            tabProposals.classList.remove('border-bottom', 'border-success', 'border-4');
        });

        tabReviews.addEventListener('click', () => {
            worksSection.style.display = 'none';
            reviewsSection.style.display = 'block';
            profilesSection.style.display = 'none';
            proposalsSection.style.display = 'none';
            tabWorks.classList.remove('border-bottom', 'border-success', 'border-4');
            tabReviews.classList.add('border-bottom', 'border-success', 'border-4');
            tabProfiles.classList.remove('border-bottom', 'border-success', 'border-4');
            tabProposals.classList.remove('border-bottom', 'border-success', 'border-4');
        });

        tabProfiles.addEventListener('click', () => {
            worksSection.style.display = 'none';
            reviewsSection.style.display = 'none';
            profilesSection.style.display = 'block';
            proposalsSection.style.display = 'none';
            tabWorks.classList.remove('border-bottom', 'border-success', 'border-4');
            tabReviews.classList.remove('border-bottom', 'border-success', 'border-4');
            tabProfiles.classList.add('border-bottom', 'border-success', 'border-4');
            tabProposals.classList.remove('border-bottom', 'border-success', 'border-4');
        });

        tabProposals.addEventListener('click', () => {
            worksSection.style.display = 'none';
            reviewsSection.style.display = 'none';
            profilesSection.style.display = 'none';
            proposalsSection.style.display = 'block';
            tabWorks.classList.remove('border-bottom', 'border-success', 'border-4');
            tabReviews.classList.remove('border-bottom', 'border-success', 'border-4');
            tabProfiles.classList.remove('border-bottom', 'border-success', 'border-4');
            tabProposals.classList.add('border-bottom', 'border-success', 'border-4');
        });
    </script>
@endsection
