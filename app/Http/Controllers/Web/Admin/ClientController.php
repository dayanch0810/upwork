<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Location;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'location' => ['nullable', 'integer', 'min:1'],
            'client' => ['nullable', 'integer', 'min:1'],
        ]);
        $f_location = $request->has('location') ? $request->location : null;
        $f_client = $request->has('client') ? $request->client : null;

        $objs = Client::whereNotNull('last_seen')
            ->when(isset($f_location), fn($query) => $query->where('location_id', $f_location))
            ->when(isset($f_client), fn($query) => $query->where('id', $f_client))
            ->with('location')
            ->withCount('works', 'myReviews')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('admin.client.index')
            ->with([
                'objs' => $objs,
            ]);
    }

    public function show($id)
    {
        $obj = Client::where('id', $id)
            ->with('location', 'works.freelancer', 'myReviews.freelancer', 'freelancerReviews')
            ->withCount('works', 'myReviews')
            ->firstOrFail();

        return view('admin.client.show')
            ->with([
                'obj' => $obj,
            ]);
    }

    public function create()
    {
        $locations = Location::get();

        return view('admin.client.create')
            ->with([
                'locations' => $locations
            ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => ['required', 'string', 'between:0,50'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048', 'dimensions:width=1000,height=1000'],
            'username' => ['required', 'email', 'unique:clients,username'],
            'password' => ['required', 'string', 'between:8,50'],
            'password_confirmation' => ['same:password'],
            'rating' => ['required', 'numeric', 'between:0,5'],
            'email_verified' => ['required', 'integer', 'between:0,1'],
            'payment_method_verified' => ['required', 'integer', 'between:0,1'],
            'total_jobs' => ['required', 'integer', 'min:0'],
            'total_spent' => ['required', 'integer', 'min:0'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $location = Location::findOrFail($request->location);

        $obj = Client::create([
            'location_id' => $location->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'avatar' => $request->avatar,
            'username' => $request->username,
            'password' => $request->password,
            'rating' => $request->rating,
            'email_verified' => $request->email_verified,
            'payment_method_verified' => $request->payment_method_verified,
            'total_jobs' => $request->total_jobs,
            'total_spent' => $request->total_spent,
        ]);

        if ($request->hasfile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = str()->random(5) . '.' . $avatar->extension();
            Storage::put('public/client/' . $avatarName, $avatar);

            $obj->avatar = 'clients/' . $avatarName;
            $obj->update();
        }

        return to_route('auth.clients.index')
            ->with([
                'success' => 'Client added',
            ]);
    }

    public function destroy($id)
    {
        $obj = Client::findOrFail($id);
        $obj->username = $obj->username . '_deleted_' . time();
        $obj->delete();

        return to_route('auth.clients.index')
            ->with([
                'success' => 'Client deleted',
            ]);
    }
}
