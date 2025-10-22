<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $objs = User::orderBy('id', 'desc')
            ->paginate();

        return view('admin.user.index')
            ->with([
                'objs' => $objs,
            ]);
    }
}
