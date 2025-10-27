<?php

namespace App\Http\Middleware\Employee;

use Closure;
use App;
use App\Models\Employee;
use Auth;
class HasEmployeePassword
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
        if(Auth::user()->setup_done == "no") {
            return redirect()->route('employee.profile.setup');
        }
        return $next($request);
    }
}
