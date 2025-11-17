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
                    <form method="POST" action="{{ route('freelancer.verify') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">
                                Phone <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">+993</span>
                                <input type="number" min="60000000" max="71999999" class="form-control @error('username') is-invalid @enderror" id="username"
                                       name="username" value="{{ old('username') }}" required autofocus>
                            </div>
                            @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Verify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
