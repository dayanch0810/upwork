<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $objs = Location::withCount('freelancers', 'clients')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('admin.location.index')
            ->with([
                'objs' => $objs,
            ]);
    }
}
