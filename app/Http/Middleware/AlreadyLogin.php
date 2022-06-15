<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AlreadyLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('loginId')){
            return redirect('/admin/dashboard');
        } elseif($request->session()->has('vendorId')) {
            return redirect('/vendor/dashboard');
        } elseif($request->session()->has('userId')) {
            return redirect('/');
        } else{
            return $next($request);
        }
    }
}
