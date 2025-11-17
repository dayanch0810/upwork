<?php

namespace App\Http\Controllers\Web\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\Freelancer;
use App\Models\Location;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function create()
    {
        return view('freelancer.auth.login');
    }


    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'integer', 'regex:/^(6[0-5]\d{6}|71\d{6})$/', 'unique:freelancers,username'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        Verification::updateOrCreate([
            'username' => $request->username,
        ], [
            'code' => rand(10000, 99999),
            'status' => 0,
        ]);

        // Send OTP

        return view('freelancer.auth.verify')
            ->with([
                'username' => $request->username,
            ]);
    }


    public function confirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => ['nullable', 'integer', 'min:0'],
            'username' => ['required', 'integer', 'regex:/^(6[0-5]\d{6}|71\d{6})$/', 'unique:freelancers,username'],
            'code' => ['required', 'integer', 'between:10000,99999'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $locations = Location::get();
        $verification = Verification::where('username', $request->username)
            ->where('code', $request->code)
            ->where('status', 0)
            ->where('updated_at', '>', now()->subMinutes(3))
            ->orderBy('id', 'desc')
            ->first();

        if ($verification) {
            $verification->status = 1;
            $verification->update();

            $freelancer = Freelancer::where('username', $request->username)->first();

            if ($freelancer) {
                $freelancer->update();
                auth('freelancer_web')->login($freelancer);

                return to_route('freelancer.home')
                    ->with([
                        'success' => trans('Successfully Logged In'),
                    ]);
            } else {
                return view('freelancer.auth.confirm')
                    ->with([
                        'username' => $request->username,
                        'code' => $request->code,
                        'locations' => $locations,
                    ]);
            }
        } else {
            $verification->status = 2;
            $verification->update();

            return to_route('freelancer.login')
                ->with([
                    'error' => trans('Invalid Verification Code'),
                ]);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => ['nullable', 'integer', 'min:1'],
            'username' => ['required', 'integer', 'regex:/^(6[0-5]\d{6}|71\d{6})$/', 'unique:freelancers,username'],
            'code' => ['required', 'integer', 'between:10000,99999'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'between:8,50'],
            'password_confirmation' => ['same:password'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $location = Location::findOrFail($request->location);
        $verification = Verification::where('username', $request->username)
            ->where('code', $request->code)
            ->where('status', 1)
            ->where('updated_at', '>', now()->subMinutes(5))
            ->orderBy('id', 'desc')
            ->first();

        if ($verification) {
            $freelancer = Freelancer::create([
                'location_id' => $location->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'password' => $request->password,
                'verified' => 1,
            ]);

            auth('freelancer_web')->login($freelancer);

            return to_route('freelancer.home')
                ->with([
                    'success' => trans('Successfully Logged In'),
                ]);
        } else {
            $verification->status = 2;
            $verification->update();

            return to_route('freelancer.login')
                ->with([
                    'error' => trans('Invalid Verification Code'),
                ]);
        }
    }


    public function destroy(Request $request)
    {
        $freelancer = Auth::guard('freelancer_web')->user();

        if ($freelancer) {
            $freelancer->last_seen = null;
            $freelancer->save();
        }

        Auth::guard('freelancer_web')->logout();
        $request->session()->regenerate();

        return redirect('/');
    }
}
