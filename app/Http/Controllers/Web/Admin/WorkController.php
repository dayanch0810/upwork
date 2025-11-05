<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Freelancer;
use App\Models\Profile;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WorkController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'client' => ['nullable', 'integer', 'min:1'],
            'freelancer' => ['nullable', 'integer', 'min:1'],
            'profile' => ['nullable', 'integer', 'min:1'],
            'work' => ['nullable', 'integer', 'min:1'],
            'workSkills' => ['nullable', 'integer', 'min:1'],
        ]);
        $f_client = $request->has('client') ? $request->client : null;
        $f_freelancer = $request->has('freelancer') ? $request->freelancer : null;
        $f_profile = $request->has('profile') ? $request->profile : null;
        $f_work = $request->has('work') ? $request->work : null;
        $f_workSkills = $request->has('workSkills') ? $request->workSkills : null;

        $objs = Work::when(isset($f_client), fn($query) => $query->where('client_id', $f_client))
            ->when(isset($f_freelancer), fn($query) => $query->where('freelancer_id', $f_freelancer))
            ->when(isset($f_profile), fn($query) => $query->where('profile_id', $f_profile))
            ->when(isset($f_work), fn($query) => $query->where('id', $f_work))
            ->when(isset($f_workSkills), fn($query) => $query->whereHas('workSkills', fn($query) => $query->where('skills.id', $f_workSkills)))
            ->with('client', 'freelancer', 'profile')
            ->withCount('workSkills')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('admin.work.index')
            ->with([
                'objs' => $objs,
            ]);
    }

    public function show($id)
    {
        $obj = Work::where('id', $id)
            ->with('freelancer', 'client', 'profile', 'proposals.freelancer')
            ->firstOrFail();

        return view('admin.work.show')
            ->with([
                'obj' => $obj,
            ]);
    }

    public function edit($id)
    {
        $obj = Work::findOrFail($id);
        $clients = Client::orderBy('id')->get();
        $freelancers = Freelancer::orderBy('id')->get();
        $profiles = Profile::orderBy('id')->get();

        return view('admin.work.edit')
            ->with([
                'obj' => $obj,
                'clients' => $clients,
                'freelancers' => $freelancers,
                'profiles' => $profiles,
            ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'client' => ['required', 'integer', 'min:1'],
            'freelancer' => ['nullable', 'integer', 'min:1'],
            'profile' => ['nullable', 'integer', 'min:1'],
            'title' => ['required', 'string', 'between:0,150'],
            'body' => ['required', 'string', 'max:25500'],
            'experience_level' => ['required', 'integer', 'between:0,2'],
            'job_type' => ['required', 'integer', 'between:0,1'],
            'price' => ['required', 'integer', 'min:0'],
            'number_of_proposals' => ['required', 'integer', 'min:0'],
            'project_type' => ['required', 'integer', 'between:0,1'],
            'project_length' => ['required', 'integer', 'between:0,3'],
            'hours_per_week' => ['required', 'integer', 'between:0,1'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $client = Client::findOrFail($request->client);
        $freelancer = Freelancer::findOrFail($request->freelancer);
        $profile = Profile::findOrFail($request->profile);
        $price = round($request->price, 1);

        $obj = Work::findOrFail($id);
        $obj->client_id = $client->id;
        $obj->freelancer_id = $freelancer->id ?? null;
        $obj->profile_id = $profile->id ?? null;
        $obj->title = $request->title;
        $obj->body = $request->body;
        $obj->experience_level = $request->experience_level;
        $obj->job_type = $request->job_type;
        $obj->price = $price;
        $obj->number_of_proposals = $request->number_of_proposals;
        $obj->project_type = $request->project_type;
        $obj->project_length = $request->project_length;
        $obj->hours_per_week = $request->hours_per_week;
        $obj->update();

        return to_route('v1.auth.works.index')
            ->with([
                'success' => 'Update successfully',
            ]);
    }

    public function destroy($id)
    {
        $obj = Work::findOrFail($id);
        $obj->delete();

        return to_route('v1.auth.works.index')
            ->with([
                'success' => 'Work deleted',
            ]);
    }
}
