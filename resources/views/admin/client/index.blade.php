@extends('layouts.app')
@section('title')
    Clients
@endsection
@section('content')
    <div>
        @include('admin.app.nav')
    </div>

    <div class="h3 p-3">
        Clients
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="small">
            <tr>
                <th>Id</th>
                <th>Location</th>
                <th>Name<br>surname</th>
                <th>Avatar</th>
                <th>Username</th>
                <th>Rating</th>
                <th>Phone Number Verified</th>
                <th>Payment Method Verified</th>
                <th>Total Jobs</th>
                <th>Total Spent</th>
                <th>Works</th>
                <th>Reviews</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>{{ $obj->location?->name ?? 'Not specified' }}</td>
                    <td>{{ $obj->first_name }} <br> {{ $obj->last_name }}</td>
                    <td>{{ $obj->avatar }}</td>
                    <td>{{ $obj->username }}</td>
                    <td><i class="bi-star-fill text-warning"> </i>{{ $obj->rating }}</td>
                    <td>
                        @if($obj->phone_number_verified)
                            <div class="badge bg-success-subtle text-success-emphasis">Verified</div>
                        @else
                            <div class="badge bg-warning-subtle text-warning-emphasis">Not Verified</div>
                        @endif
                    </td>
                    <td>
                        @if($obj->payment_method_verified)
                            <div class="badge bg-success-subtle text-success-emphasis">Verified</div>
                        @else
                            <div class="badge bg-warning-subtle text-warning-emphasis">Not Verified</div>
                        @endif
                    </td>
                    <td><i class="bi-briefcase"></i> {{ $obj->total_jobs }}</td>
                    <td><i class="bi-currency-dollar"></i>{{ $obj->total_spent }}</td>
                    <td><a href="{{ route('v1.auth.works.index', ['client' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->works_count }}</a></td>
                    <td><a href="{{ route('v1.auth.reviews.index', ['client' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->my_reviews_count }}</a></td>
                    <td>{{ $obj->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $obj->updated_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>{{ $objs->links() }}</div>
@endsection
