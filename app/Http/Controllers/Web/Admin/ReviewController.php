<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'client' => ['nullable', 'integer', 'min:1'],
            'freelancer' => ['nullable', 'integer', 'min:1'],
        ]);
        $f_client = $request->has('client') ? $request->client : null;
        $f_freelancer = $request->has('freelancer') ? $request->freelancer : null;

        $objs = Review::when(isset($f_client), fn($query) => $query->where('from', 'client')->where('client_id', $f_client))
            ->when(isset($f_freelancer), fn($query) => $query->where('from', 'freelancer')->where('freelancer_id', $f_freelancer))
            ->with('freelancer', 'client')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('admin.review.index')
            ->with([
                'objs' => $objs,
            ]);
    }
}
