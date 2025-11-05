@extends('layouts.app')
@section('title')
    Ip Address
@endsection
@section('content')
    @include('admin.app.nav')

    <div class="row align-items-center p-3">
        <div class="col h3 text-start">
            Ip Address
        </div>

        <div class="col-auto">
            @include('admin.app.alert')
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="small">
            <tr>
                <th>Id</th>
                <th>Ip Address</th>
                <th>Country Code</th>
                <th>Country Name</th>
                <th>City Name</th>
                <th>Disabled</th>
            </tr>
            </thead>

            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>{{ $obj->ip_address }}</td>
                    <td>{{ $obj->country_code }}</td>
                    <td>{{ $obj->country_name }}</td>
                    <td>{{ $obj->city_name }}</td>
                    <td>
                        <span class="badge bg-{{ $obj->getDisabledColor() }}-subtle text-{{ $obj->getDisabledColor() }}-emphasis">
                            {{ $obj->getDisabled() }}
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $objs->links() }}</div>
@endsection
