<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
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
        return view('client.auth.login');
    }


    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'email', 'unique:clients,username'],
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
            'method' => 1,
            'status' => 0,
        ]);

        // Send OTP

        return view('client.auth.verify')
            ->with([
                'username' => $request->username,
            ]);
    }


    public function confirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => ['nullable', 'integer', 'min:0'],
            'username' => ['required', 'email', 'unique:clients,username'],
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
            ->where('method', 1)
            ->where('status', 0)
            ->where('updated_at', '>', now()->subMinutes(3))
            ->orderBy('id', 'desc')
            ->first();

        if ($verification) {
            $verification->status = 1;
            $verification->update();

            $client = Client::where('username', $request->username)->first();

            if ($client) {
                $client->update();
                auth('client_web')->login($client);

                return to_route('client.home')
                    ->with([
                        'success' => trans('Successfully Logged In'),
                    ]);
            } else {
                return view('client.auth.confirm')
                    ->with([
                        'username' => $request->username,
                        'code' => $request->code,
                        'locations' => $locations,
                    ]);
            }
        } else {
            $verification->status = 2;
            $verification->update();

            return to_route('client.login')
                ->with([
                    'error' => trans('Invalid Verification Code'),
                ]);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => ['nullable', 'integer', 'min:1'],
            'username' => ['required', 'email', 'unique:clients,username'],
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
            $client = Client::create([
                'location_id' => $location->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'password' => $request->password,
                'email_verified' => 1,
            ]);

            auth('client_web')->login($client);

            return to_route('client.home')
                ->with([
                    'success' => trans('Successfully Logged In'),
                ]);
        } else {
            $verification->status = 2;
            $verification->update();

            return to_route('client.login')
                ->with([
                    'error' => trans('Invalid Verification Code'),
                ]);
        }
    }


    public function destroy(Request $request)
    {
        $client = Auth::guard('client_web')->user();

        if ($client) {
            $client->last_seen = null;
            $client->save();
        }

        Auth::guard('client_web')->logout();
        $request->session()->regenerate();

        return redirect('/');
    }
}
