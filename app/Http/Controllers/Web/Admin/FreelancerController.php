<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Freelancer;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function create()
    {
        $locations = Location::get();

        return view('admin.freelancer.create')
            ->with([
                'locations' => $locations
            ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => ['nullable', 'string', 'between:0,50'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048', 'dimensions:width=1000,height=1000'],
            'username' => ['required', 'integer', 'regex:/^(6[0-5]\d{6}|71\d{6})$/', 'unique:freelancers,username'],
            'password' => ['required', 'string', 'between:8,50'],
            'password_confirmation' => ['same:password'],
            'rating' => ['required', 'integer', 'between:0,5'],
            'verified' => ['required', 'integer', 'between:0,1'],
            'total_jobs' => ['required', 'integer', 'min:0'],
            'total_earnings' => ['required', 'integer', 'min:0'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $location = Location::findOrFail($request->location);

        $obj = Freelancer::create([
            'location_id' => $location->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'avatar' => $request->avatar,
            'username' => $request->username,
            'password' => $request->password,
            'rating' => $request->rating,
            'verified' => $request->verified,
            'total_jobs' => $request->total_jobs,
            'total_earnings' => $request->total_earnings,
        ]);

        if ($request->hasfile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = str()->random(5) . '.' . $request->file()->extension();
            Storage::put('public/product/' . $avatarName, $avatar);

            $obj->avatar = 'product/' . $avatarName;
            $obj->update();
        }

        return to_route('v1.auth.freelancers.index')
            ->with([
                'success' => 'Freelancer added',
            ]);
    }

    public function destroy($id)
    {
        $obj = Freelancer::findOrFail($id);
        $obj->delete();

        return to_route('v1.auth.freelancers.index')
            ->with([
                'success' => 'Freelancer deleted',
            ]);
    }
}
