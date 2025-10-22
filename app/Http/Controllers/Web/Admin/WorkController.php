<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Work;
use Illuminate\Http\Request;

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
            ->withCount('proposals', 'workSkills')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('admin.work.index')
            ->with([
                'objs' => $objs,
            ]);
    }
}
