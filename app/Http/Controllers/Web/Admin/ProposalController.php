<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'work' => ['nullable', 'integer', 'min:1'],
            'freelancer' => ['nullable', 'integer', 'min:1'],
            'profile' => ['nullable', 'integer', 'min:1'],
        ]);
        $f_work = $request->has('work') ? $request->work : null;
        $f_freelancer = $request->has('freelancer') ? $request->freelancer : null;
        $f_profile = $request->has('profile') ? $request->profile : null;

        $objs = Proposal::when(isset($f_work), fn($query) => $query->where('work_id', $f_work))
            ->when(isset($f_freelancer), fn($query) => $query->where('freelancer_id', $f_freelancer))
            ->when(isset($f_profile), fn($query) => $query->where('profile_id', $f_profile))
            ->with('work', 'freelancer', 'profile')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('admin.proposal.index')
            ->with([
                'objs' => $objs,
            ]);
    }
}
