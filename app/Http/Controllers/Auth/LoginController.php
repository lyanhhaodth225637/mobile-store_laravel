<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;                    // ĐÚNG VỊ TRÍ
use Illuminate\Support\Facades\Auth;           // ĐÚNG VỊ TRÍ

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        if ($user->role == 0) {
            return redirect()->route('admin.home');
        } elseif ($user->role == 1) {
            return redirect()->route('user.home');
        }

        return redirect()->route('frontend.home');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}