<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;


class redirectIfNotAdmin
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
        //dd();

        if($this->auth->user()->role!=0){
            return redirect('/');
        }
        return $next($request);
    }
}
