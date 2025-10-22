@extends('layouts.app')
@section('title')
    Skills
@endsection
@section('content')
    <div>
        @include('admin.app.nav')
    </div>

    <div class="h3 p-3">
        Skills
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm">
            <thead class="small">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Skill Freelancers</th>
                <th>Skill Works</th>
            </tr>
            </thead>

            <tbody>
            @foreach($objs as $obj)
                <tr>
                    <td>{{ $obj->id }}</td>
                    <td>{{ $obj->name }}</td>
                    <td><a href="{{ route('v1.auth.freelancers.index', ['freelancerSkills' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->freelancer_skills_count }}</a></td>
                    <td><a href="{{ route('v1.auth.works.index', ['workSkills' => $obj->id]) }}" class="text-decoration-none" target="_blank"><i class="bi-box-arrow-up-right"> </i>{{ $obj->work_skills_count }}</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div>{{ $objs->links() }}</div>
@endsection
