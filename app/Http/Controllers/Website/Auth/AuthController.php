<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_form()
    {
        return view('website.auth.login');
    }

    public function login(AuthRequest $request)
    {
        $data = $request->safe()->toArray();
        if (auth('web')->attempt($data)) {
            return response()->json('success', 200);
        } else {
            return response()->json(['error' => 'invalid data'], 401);
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->back();
    }
}
