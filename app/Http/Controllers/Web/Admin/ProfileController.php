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
    public function create($freelancer_id)
    {
        $freelancer = Freelancer::findOrFail($freelancer_id);

        return view('admin.profile.create')
            ->with([
                'freelancer' => $freelancer
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
            'freelancer_id' =>  $freelancer->id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return to_route('auth.freelancers.show', $freelancer->id)
            ->with([
                'success' => 'Profile added',
            ]);
    }

    public function edit($id, $freelancer_id)
    {
        $obj = Profile::findOrFail($id);
        $freelancer = Freelancer::findOrFail($freelancer_id);

        return view('admin.profile.edit')
            ->with([
                'obj' => $obj,
                'freelancer' => $freelancer,
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
        $obj->freelancer_id = $freelancer->id;
        $obj->title = $request->title;
        $obj->body = $request->body;
        $obj->update();

        return to_route('auth.freelancers.show', $freelancer->id)
            ->with([
                'success' => 'Update successfully',
            ]);
    }

    public function destroy($id)
    {
        $obj = Profile::findOrFail($id);
        $obj->delete();

        return redirect()->back()
            ->with([
                'success' => 'Profile deleted',
            ]);
    }
}
