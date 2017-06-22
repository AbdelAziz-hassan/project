<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;


class redirectIfNotActive
{
    protected $auth;

     public function __construct(Guard $auth)
    {

        $this->auth = $auth;


    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->auth->user()->keystore->activeStatues==0){
            return redirect('/notActive');
        }
        return $next($request);
    }
}
