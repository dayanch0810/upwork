<?php

namespace App\Http\Controllers\Web\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\LoginRequest;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        return view('admin.login');
    }


    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('v1.auth.dashboard', absolute: false));
    }


    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
