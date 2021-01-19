<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(\Session::has('lang')){
            app()->setLocale(\Session::get('lang'));
            config([
                'core.main_menu' => config('core.main_menu')
            ]);
        }
        return $next($request);
    }
}
