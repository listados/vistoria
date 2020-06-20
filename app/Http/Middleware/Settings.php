<?php

namespace EspindolaAdm\Http\Middleware;

use Closure;
use EspindolaAdm\User;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class Settings
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
        if(Auth::user()->adm != 1){
            return redirect('home');
        }
        return $next($request);
    }
}
