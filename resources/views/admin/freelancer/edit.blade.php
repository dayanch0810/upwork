@extends('admin.layouts.app')
@section('title')
    Freelancer
@endsection
@section('content')
    <div class="container-xxl py-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-6">

                <div class="h3 mb-3">
                    <a href="{{ route('auth.freelancers.index') }}" class="text-decoration-none">
                        <i class="bi-chevron-left"></i> Freelancers
                    </a> / Edit
                </div>

                <form action="{{ route('auth.freelancers.update', $obj->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}

                    <div class="mb-3">
                        <label for="location" class="form-label fw-semibold">
                            Location <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('location') is-invalid @enderror"
                                id="location" name="location" required autofocus>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ $location->id == $obj->location_id ? 'selected':'' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('location')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label for="first_name" class="form-label fw-semibold">
                                First Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                                   name="first_name" value="{{ $obj->first_name }}" required>
                            @error('first_name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="last_name" class="form-label fw-semibold">
                                Last Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                   name="last_name" value="{{ $obj->last_name }}" required>
                            @error('last_name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="avatar" class="form-label fw-semibold">
                            Avatar (1000x1000) — optional
                        </label>
                        <input type="file"
                               class="form-control @error('avatar') is-invalid @enderror"
                               id="avatar"
                               name="avatar"
                               accept=".jpg,.jpeg,.png">
                        @error('avatar')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="username" class="form-label fw-semibold">
                                Username (phone) <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                                   name="username" value="{{ $obj->username }}" required>
                            @error('username')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="password" class="form-label fw-semibold">
                                Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password">
                            @error('password')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold">
                                    Confirm Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="rating" class="form-label fw-semibold">
                                Rating <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.1" min="0" class="form-control @error('rating') is-invalid @enderror" id="rating"
                                   name="rating" value="{{ $obj->rating }}" required>
                            @error('rating')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="verified" class="form-label fw-semibold">
                                Verified <span class="text-danger">*</span>
                            </label>

                            <select class="form-select @error('verified') is-invalid @enderror"
                                    id="verified" name="verified" required>
                                @foreach($obj->verifiedList() as $key => $label)
                                    <option value="{{ $key }}" {{ old('verified', $obj->verified ?? 0) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>

                            @error('verified')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="total_jobs" class="form-label fw-semibold">
                                Total Jobs <span class="text-danger">*</span>
                            </label>
                            <input type="number" min="0" class="form-control @error('total_jobs') is-invalid @enderror"
                                   id="total_jobs" name="total_jobs" value="{{ $obj->total_jobs }}" required>
                            @error('total_jobs')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col">
                            <label for="total_earnings" class="form-label fw-semibold">
                                Total Earnings <span class="text-danger">*</span>
                            </label>
                            <input type="number" min="0" class="form-control @error('total_earnings') is-invalid @enderror"
                                   id="total_earnings" name="total_earnings" value="{{ $obj->total_earnings }}" required>
                            @error('total_earnings')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Update
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
