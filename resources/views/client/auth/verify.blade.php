@extends('client.layouts.app')
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
                    <form method="POST" action="{{ route('client.confirm') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">
                                Email <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="email" class="form-control @error('username') is-invalid @enderror" id="username"
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
                                       name="code" value="{{ old('code') }}" required autofocus>
                            </div>
                            @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
