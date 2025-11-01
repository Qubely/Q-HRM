<?php

namespace App\Http\Controllers\Admin\Attendance\Reconciliation\Dt\EmployeeRecon;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\Attendance\Reconciliation\Dt\EmployeeRecon\IEmployeeReconDtRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class EmployeeReconDtController extends Controller {

    use BaseTrait;
    public function __construct(private IEmployeeReconDtRepository $iEmployeeReconDtRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.attendance.reconciliation.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for employeerecon crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iEmployeeReconDtRepo->index($request);
        $data['lang'] = $this->lang;
        return view('admin.pages.attendance.reconciliation.dt.employee-recon.index',compact('data'));
    }

    /**
     * List items for yajra datatable for employeerecon   crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iEmployeeReconDtRepo->list($request);
    }

    /**
     * Ban the reconciliated
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function ban(Request $request) : JsonResponse
    {
        return  $this->iEmployeeReconDtRepo->ban($request);
    }

}
