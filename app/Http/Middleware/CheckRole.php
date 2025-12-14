<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{

    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            // Chưa đăng nhập -> redirect về login
            return redirect()->route('user.dangnhap');
        }

        $user = Auth::user();

        // 0 = admin, 1 = user
        if ($role === 'admin' && $user->role != 0) {
            // Không đúng vai trò -> view 403
            return response()->view('errors.403', [], 403);
        }

        if ($role === 'user' && !in_array($user->role, [0, 1])) {
            // Không đúng vai trò -> view 403
            return response()->view('errors.403', [], 403);
        }

        return $next($request);
    }
}
