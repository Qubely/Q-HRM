<?php

namespace App\Http\Controllers\Employee\Logout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Http\RedirectResponse;
use App\Traits\BaseTrait;
//vpx_imports
class EmployeeLogoutController extends Controller
{
    use BaseTrait;
    public function __construct()
    {
        $this->middleware(['auth:employee','HasEmployeePassword','HasEmployeeAuth']);
        $this->lang = 'employee.logout';
    }

    public function logout(Request $request) : RedirectResponse
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.login.index')->withErrors(["success" => [0 =>  pxLang($this->lang,'mgs.logout_sucess')]]);
    
    }
    //vpx_attach
}
