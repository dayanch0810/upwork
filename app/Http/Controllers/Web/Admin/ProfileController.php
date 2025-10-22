<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

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
}
