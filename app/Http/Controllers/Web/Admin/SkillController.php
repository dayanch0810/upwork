<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'freelancerSkills' => ['nullable', 'integer', 'min:1'],
            'workSkills' => ['nullable', 'integer', 'min:1'],
        ]);
        $f_freelancerSkills = $request->has('freelancerSkills') ? $request->freelancerSkills : null;
        $f_workSkills = $request->has('workSkills') ? $request->workSkills : null;

        $objs = Skill::when(isset($f_freelancerSkills), fn($query) => $query->whereHas('freelancerSkills', fn($query) => $query->where('freelancers.id', $f_freelancerSkills)))
            ->when(isset($f_workSkills), fn($query) => $query->whereHas('workSkills', fn($query) => $query->where('works.id', $f_workSkills)))
            ->withCount('freelancerSkills', 'workSkills')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('admin.skill.index')
            ->with([
                'objs' => $objs,
            ]);
    }
}
