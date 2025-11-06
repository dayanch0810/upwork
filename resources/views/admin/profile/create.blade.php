@extends('layouts.app')
@section('title')
    @lang('app.products')
@endsection
@section('content')
    <div class="container-xxl py-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-6">

                <div class="h4 mb-3">
                    <a href="{{ route('v1.auth.profiles.index') }}" class="text-decoration-none">
                        <i class="bi-chevron-left"></i> Profiles
                    </a> / @lang('app.add')
                </div>

                <form action="{{ route('v1.auth.profiles.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="category" class="form-label fw-semibold">
                            Freelancer <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('freelancer') is-invalid @enderror" id="freelancer" name="freelancer" required autofocus>
                            @foreach($freelancers as $freelancer)
                                <option value="{{ $freelancer->id }}">
                                    {{ $freelancer->first_name }} {{ $freelancer->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('freelancer')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">
                            Title <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('title') is-invalid @enderror"
                                  name="title" id="title" rows="2" required></textarea>
                        @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label fw-semibold">
                            Body <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('body') is-invalid @enderror"
                                  name="body" id="body" rows="2" required></textarea>
                        @error('body')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary w-100">
                        @lang('app.add')
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection
