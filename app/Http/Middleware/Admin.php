<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     * Kernel.php line 65
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // nếu user đã đăng nhập
        // thì check quyền
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->level == 1) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect()->route('getLogin')->withErrors('Bạn đéo có quyền');
            }
        } else {
            return redirect('admin/login');
        }
    }
}
