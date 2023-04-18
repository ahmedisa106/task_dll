<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AuthRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_form()
    {
        return view('dashboard.auth.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->safe()->toArray();
        if (auth('admin')->attempt($credentials)) {
            return response()->json('success', Response::HTTP_ACCEPTED);
        } else {
            return response()->json(['error' => 'invalid data'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return to_route('dashboard.login');
    }
}
