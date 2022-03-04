<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route; 

class Local
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
        /*if($request->has('lang')){
        $local =$request->input('lang');
        if($local != session('lang')){
            session()->put('lang',$local);
        }
       }
        App::setlocale(session('lang','en'));*/

        $local =$request->route('lang');
        URL::defaults([
            'lang'=>$local
        ]);
        Route::current()->forgetParameter('lang');
        return $next($request);
    }
}
