@extends('freelancer.layouts.app')
@section('title')
    Login
@endsection
@section('content')
    <div class="row justify-content-center my-5">
        <div class="col-8 col-sm-6 col-md-4 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="h3 text-center mb-3">
                        Login
                    </div>
                    <form method="POST" action="{{ route('freelancer.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">
                                Phone <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">+993</span>
                                <input type="number" min="60000000" max="71999999" class="form-control @error('username') is-invalid @enderror" id="username"
                                       name="username" value="{{ $username }}" readonly>
                            </div>
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="code" class="form-label fw-semibold">
                                Code <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi-lock-fill"></i></span>
                                <input type="number" min="10000" max="99999" class="form-control @error('code') is-invalid @enderror" id="code"
                                       name="code" value="{{ $code }}" readonly>
                            </div>
                            @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="first_name" class="form-label fw-semibold">
                                First Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                                   name="first_name" value="{{ old('first_name') }}" required autofocus>
                            @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label fw-semibold">
                                Last Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                   name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label fw-semibold">
                                Location <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('location') is-invalid @enderror" id="location" name="location" required autofocus>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}">
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('location')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" required>
                            @error('password')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">
                                Confirm Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
