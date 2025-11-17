<?php

namespace App\Http\Controllers\Web\Freelancer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('freelancer.home.index');
    }
}
