<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuthAttempt;
use Illuminate\Http\Request;

class AuthAttemptController extends Controller
{
    public function index()
    {
        $objs = AuthAttempt::orderBy('id', 'desc')
            ->paginate();

        return view('admin.authAttempt.index')
            ->with([
                'objs' => $objs,
            ]);
    }
}
