@extends('admin.layouts.app')
@section('title')
    Login Select
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="fs-1 fw-semibold text-center mb-5">How do you want to login?</div>
                <div class="row justify-content-center g-4">
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('client.login') }}" class="text-decoration-none text-dark">
                            <div class="card border shadow-sm text-center">
                                <div class="card border-4 border-primary bg-primary bg-opacity-10 text-center">
                                    <div class="card-body py-5">
                                        <div class="mb-2">
                                            <i class="bi-briefcase text-primary" style="font-size: 6rem;"></i>
                                        </div>
                                        <div class="fs-3 fw-semibold mb-2">Client</div>
                                        <p class="text-muted mb-0">Log in as a client</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('freelancer.login') }}" class="text-decoration-none text-dark">
                            <div class="card border-4 border-success bg-success bg-opacity-10 text-center">
                                <div class="card-body py-5">
                                    <div class="mb-2">
                                        <i class="bi-person-circle text-success" style="font-size: 6rem;"></i>
                                    </div>
                                    <div class="fs-3 fw-semibold mb-2">Freelancer</div>
                                    <p class="text-muted mb-0">Log in as a freelancer</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="text-secondary fw-semibold text-decoration-none">Home Page</a>
                </div>
            </div>
        </div>
        </div>
@endsection
