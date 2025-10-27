@extends('layouts.app')
@section('title')
    Verifications
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="h3 p-3">
        Verifications
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="small">
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Code</th>
                <th>Method</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>
                        @if($obj->method)
                            {{ $obj->username }}
                        @else
                            +993 {{ $obj->username }}
                        @endif
                    </td>
                    <td><i class="bi-lock-fill text-secondary"></i> {{ $obj->code }}</td>
                    <td>
                        <span class="badge bg-{{ $obj->getMethodColor() }}-subtle text-{{ $obj->getMethodColor() }}-emphasis">
                            {{ $obj->getMethod() }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $obj->statusColor() }}-subtle text-{{ $obj->statusColor() }}-emphasis">
                            {{ $obj->status() }}
                        </span>
                    </td>
                    <td>{{ $obj->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $obj->updated_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div>{{ $objs->links() }}</div>
@endsection
