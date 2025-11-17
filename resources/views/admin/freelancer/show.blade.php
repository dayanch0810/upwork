@extends('admin.layouts.app')
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
                    <i class="bi-geo-alt-fill"></i>{{ $obj->location->name }} / <i class="bi-person-fill"></i>{{ $obj->username }}
                </div>
            </div>

            <div class="col text-end">
                <a href="{{ route('auth.profiles.create', $obj->id) }}" class="btn btn-primary">New Profile</a>
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
                            <div>{{ $obj->created_at->format('d.m.Y H:i') }}</div>
                        </div>

                        <div class="">
                            <div class="fs-5 fw-bold">Updated at</div>
                            <div>{{ $obj->updated_at->format('d.m.Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 border border-1 border-secondary p-3">
                <div class="fs-4 fw-bold py-2 px-2">Skills</div>
                @foreach($obj->freelancerSkills as $skill)
                    <div class="fs-6 fw-semibold badge bg-secondary-subtle text-secondary-emphasis">{{ $skill->name }}</div>
                @endforeach
                <div class="fs-4 fw-bold pt-3 px-2">More</div>
                <div class="row p-2">
                    <div class="">
                        <div id="tabWorks" class="btn btn-dark border-0 border-bottom border-success border-4 fw-bold">
                            Works ({{ $obj->works_count }})
                        </div>
                        <div id="tabProfiles" class="btn btn-dark border-0 fw-bold">
                            Profiles ({{ $obj->profiles_count }})
                        </div>
                        <div class="dropdown d-inline-block">
                            <button class="btn btn-dark border-0 fw-bold dropdown-toggle" type="button" id="proposalsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Proposals
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="proposalsDropdown">
                                <li class="dropdown-item" id="tabProposalsAll">All Proposals ({{ $obj->proposals_count }})</li>
                                @foreach($obj->profiles as $profile)
                                    <li class="dropdown-item" id="tabProposalsProfile{{ $profile->id }}">
                                        Profile {{ $profile->id }} ({{ $profile->proposals_count }})
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="dropdown d-inline-block">
                            <button class="btn btn-dark border-0 fw-bold dropdown-toggle" type="button" id="reviewsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Reviews
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="reviewsDropdown">
                                <li class="dropdown-item" id="tabMyReviews">My Reviews ({{ $obj->my_reviews_count }})</li>
                                <li class="dropdown-item" id="tabClientReviews">Client Reviews ({{ $obj->client_reviews_count }})</li>
                            </ul>
                        </div>
                    </div>
                </div>
                @include('admin.freelancer.show.works')
                @include('admin.freelancer.show.profiles')
                @include('admin.freelancer.show.proposals')
                @include('admin.freelancer.show.reviews')
            </div>
        </div>
    </div>
    @include('admin.freelancer.show.scripts')
@endsection
