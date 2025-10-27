<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Freelancer;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'location' => ['nullable', 'integer', 'min:1'],
            'freelancer' => ['nullable', 'integer', 'min:1'],
            'freelancerSkills' => ['nullable', 'integer', 'min:1'],
        ]);
        $f_location = $request->has('location') ? $request->location : null;
        $f_freelancer = $request->has('freelancer') ? $request->freelancer : null;
        $f_freelancerSkills = $request->has('freelancerSkills') ? $request->freelancerSkills : null;

        $objs = Freelancer::when(isset($f_location), fn($query) => $query->where('location_id', $f_location))
            ->when(isset($f_freelancer), fn($query) => $query->where('id', $f_freelancer))
            ->when(isset($f_freelancerSkills), fn($query) => $query->whereHas('freelancerSkills', fn($query) => $query->where('skills.id', $f_freelancerSkills)))
            ->with('location')
            ->withCount('profiles', 'freelancerSkills', 'myReviews', 'works', 'proposals')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('admin.freelancer.index')
            ->with([
                'objs' => $objs,
            ]);
    }

    public function show($id)
    {
        $obj = Freelancer::where('id', $id)
            ->with('location', 'works.client', 'myReviews.client', 'clientReviews')
            ->withCount('profiles', 'freelancerSkills', 'myReviews', 'works', 'proposals')
            ->firstOrFail();

        return view('admin.freelancer.show')
            ->with([
                'obj' => $obj,
            ]);
    }
}
