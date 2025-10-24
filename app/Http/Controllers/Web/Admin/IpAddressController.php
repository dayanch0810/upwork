<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\IpAddress;
use Illuminate\Http\Request;

class IpAddressController extends Controller
{
    public function index()
    {
        $objs = IpAddress::orderBy('id', 'desc')
            ->paginate();

        return view('admin.ipAddress.index')
            ->with([
                'objs' => $objs,
            ]);
    }
}
