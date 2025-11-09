@extends('admin.layouts.app')
@section('title')
    Profiles
@endsection
@section('content')
    <div class="container-xxl py-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-6">

                <div class="h3 mb-3">
                    <a href="{{ route('auth.freelancers.show', $freelancer->id) }}" class="text-decoration-none">
                        <i class="bi-chevron-left"></i> {{ $freelancer->first_name }} {{ $freelancer->last_name }}
                    </a> / Edit
                </div>

                <form action="{{ route('auth.profiles.update', $obj->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}

                    <input type="hidden" name="freelancer" value="{{ $freelancer->id }}">

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
@endsection
