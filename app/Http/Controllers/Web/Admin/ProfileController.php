<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Freelancer;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'freelancer' => ['nullable', 'integer', 'min:1'],
            'profile' => ['nullable', 'integer', 'min:1'],
        ]);
        $f_freelancer = $request->has('freelancer') ? $request->freelancer : null;
        $f_profile = $request->has('profile') ? $request->profile : null;

        $objs = Profile::when(isset($f_freelancer), fn($query) => $query->where('freelancer_id', $f_freelancer))
            ->when(isset($f_profile), fn($query) => $query->where('id', $f_profile))
            ->with('freelancer')
            ->withCount('works', 'proposals')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('admin.profile.index')
            ->with([
                'objs' => $objs,
            ]);
    }

    public function create()
    {
        $freelancers = Freelancer::get();

        return view('admin.profile.create')
            ->with([
                'freelancers' => $freelancers
            ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'freelancer' => ['required', 'integer', 'min:0'],
            'title' => ['required', 'string', 'between:0,150'],
            'body' => ['required', 'string', 'max:25500'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $freelancer = Freelancer::findOrFail($request->freelancer);

        Profile::create([
            'freelancer_id' => $freelancer->id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return to_route('v1.auth.profiles.index')
            ->with([
                'success' => 'Profile added',
            ]);
    }

    public function edit($id)
    {
        $obj = Profile::findOrFail($id);
        $freelancers = Freelancer::orderBy('id')->get();

        return view('admin.profile.edit')
            ->with([
                'obj' => $obj,
                'freelancers' => $freelancers,
            ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'freelancer' => ['nullable', 'integer', 'min:1'],
            'title' => ['required', 'string', 'between:0,150'],
            'body' => ['required', 'string', 'max:25500'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $freelancer = Freelancer::findOrFail($request->freelancer);

        $obj = Profile::findOrFail($id);
        $obj->freelancer_id = $freelancer->id ?? null;
        $obj->title = $request->title;
        $obj->body = $request->body;
        $obj->update();

        return to_route('v1.auth.profiles.index')
            ->with([
                'success' => 'Update successfully',
            ]);
    }

    public function destroy($id)
    {
        $obj = Profile::findOrFail($id);
        $obj->delete();

        return to_route('v1.auth.profiles.index')
            ->with([
                'success' => 'Profile deleted',
            ]);
    }
}
