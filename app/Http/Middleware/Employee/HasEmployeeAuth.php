<?php

namespace App\Http\Middleware\Employee;

use Closure;
use App\Models\Employee;
use App\Traits\BaseTrait;
class HasEmployeeAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    use BaseTrait;
    public function handle($request, Closure $next)
    {   
        if($request->has('auth_uuid')){
            $user = Employee::where([['uuid','=',$request->auth_uuid]])->first();
            if($user == null) {
                return $this->response(['type' => 'noUpdate', 'title' => 'No authenticated user found']);
            }
            $request->merge(['auth' => $user]);
        }
        return $next($request);
    }
}