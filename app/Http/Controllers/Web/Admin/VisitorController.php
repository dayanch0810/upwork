<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'ip_address' => ['nullable', 'integer', 'min:1'],
            'user_agent' => ['nullable', 'integer', 'min:1'],
        ]);
        $f_ip_address = $request->has('ip_address') ? $request->ip_address : null;
        $f_user_agent = $request->has('user_agent') ? $request->user_agent : null;

        $objs = Visitor::when(isset($f_ip_address), fn($query) => $query->where('ip_address_id', $f_ip_address))
            ->when(isset($f_user_agent), fn($query) => $query->where('user_agent_id', $f_user_agent))
            ->with('ipAddress', 'userAgent')
            ->orderBy('id', 'desc')
            ->paginate();

        return view('admin.visitor.index')
            ->with([
                'objs' => $objs,
            ]);
    }
}
