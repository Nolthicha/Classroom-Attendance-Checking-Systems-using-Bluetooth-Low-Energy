<?php

namespace App\Http\Middleware;

use Closure;

class MergeId
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
        if(!empty($request->id)){
            $request->merge(['id' => $request->id]);
        }
        return $next($request);
    }
}
