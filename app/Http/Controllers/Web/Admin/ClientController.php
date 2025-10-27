<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Review;
use Illuminate\Http\Request;

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

        $objs = Client::when(isset($f_location), fn($query) => $query->where('location_id', $f_location))
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
}
