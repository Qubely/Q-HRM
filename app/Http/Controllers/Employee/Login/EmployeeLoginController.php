<?php

namespace App\Http\Controllers\Employee\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\Login\ValidateEmployeeLogin;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Traits\BaseTrait;
use Illuminate\Http\JsonResponse;
use Auth;
//vpx_imports
class EmployeeLoginController extends Controller
{
    use BaseTrait;
    public function __construct()
    {
        $this->middleware(['guest:employee']);
        $this->lang = 'employee.login';
    }

    /**
     * View login page
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = [];
        if(isset($_GET['pass_changed']) && $_GET['pass_changed']) {
            $data = [
                "success" => [pxLang($this->lang,'mgs.pass_changed')]
            ];
        }
        $data['lang'] = $this->lang;
        return view('employee.pages.login.index')->with('data',$data)->withErrors($data);
    }

    /**
     * Employee Login
     *
     * @param ValidateEmployeeLogin $request
     * @return JsonResponse
     */
    public function login(ValidateEmployeeLogin $request) : JsonResponse
    {
        $u = $request->get('u');
        $attempt_to = $request->get('attempt_to');
        if (empty($u)) {
            return $this->response([ 'type' => "noUpdate", "title" => pxLang($this->lang,'mgs.no_user')]);
        }
        if($u?->status == 'Disabled') {
            return $this->response([ 'type' => "noUpdate", "title" => pxLang($this->lang,'mgs.ac_disabled')]);
        }
        $remember = false;
        if(isset($request->remember) && $request->remember == "yes") {
            $remember = true;
        }
        if (Auth::guard('employee')->attempt([$attempt_to => $request->safe()->email, 'password' => $request->safe()->password], $remember)) {
            $data['extraData'] = [
                "inflate" => pxLang($this->lang,'mgs.login_successfull'),
                "redirect" => 'employee/dashboard'
            ];
            return $this->response(['type' => "success",'data'=> $data]);
        } else {
            return $this->response([ 'type' => "noUpdate", "title" => '<span class="text-danger fs-16">'.pxLang($this->lang,'mgs.inc_pass').'</span>']);
        }
    }

    //vpx_attach
}
