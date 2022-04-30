<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Auth;

class UserCompany
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


        if (auth()->user()->hasActiveCompany() or \Str::contains($request->url(),'dashboard/items')) {
            return $next($request);
        }
        return redirect()->back()->with('error', Company::MESSAGE_NOT_ACTIVE);
    }
}
