<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAgent;
use Illuminate\Http\Request;

class UserAgentController extends Controller
{
    public function index()
    {
        $objs = UserAgent::orderBy('id', 'desc')
            ->paginate();

        return view('admin.userAgent.index')
            ->with([
                'objs' => $objs,
            ]);
    }
}
