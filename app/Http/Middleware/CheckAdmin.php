<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

use App\User;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::findOrFail(Auth::user()->id);
        if ($user->getRoleNames()[0] != "Admin") {
            session()->flash('error','You have not Admin permission');
            return redirect()->back();
        }
        return $next($request);
    }
}
