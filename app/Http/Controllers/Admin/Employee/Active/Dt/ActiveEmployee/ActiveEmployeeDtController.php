<?php

namespace App\Http\Controllers\Admin\Employee\Active\Dt\ActiveEmployee;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\Employee\Active\Dt\ActiveEmployee\IActiveEmployeeDtRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class ActiveEmployeeDtController extends Controller {

    use BaseTrait;
    public function __construct(private IActiveEmployeeDtRepository $iActiveEmployeeDtRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.employee.active.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for activeemployee crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iActiveEmployeeDtRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.employee.active.dt.active-employee.index',compact('data'));
    }

    /**
     * List items for yajra datatable for activeemployee   crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iActiveEmployeeDtRepo->list($request);
    }

}