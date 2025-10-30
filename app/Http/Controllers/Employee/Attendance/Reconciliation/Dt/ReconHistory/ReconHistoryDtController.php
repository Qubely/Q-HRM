<?php

namespace App\Http\Controllers\Employee\Attendance\Reconciliation\Dt\ReconHistory;
use App\Http\Controllers\Controller;
use App\Repositories\Employee\Attendance\Reconciliation\Dt\ReconHistory\IReconHistoryDtRepository;
use App\Traits\BaseTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
class ReconHistoryDtController extends Controller {

    use BaseTrait;
    public function __construct(private IReconHistoryDtRepository $iReconHistoryDtRepo) {
        $this->middleware(['auth:employee','HasEmployeePassword','HasEmployeeAuth']);
        $this->lang= 'employee.attendance.reconciliation.crud';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for reconhistory crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $data = $this->iReconHistoryDtRepo->index($request);
        $data['lang'] = $this->lang;
        return view('employee.pages.attendance.reconciliation.dt.recon-history.index',compact('data'));
    }

    /**
     * List items for yajra datatable for reconhistory   crud
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request) : JsonResponse
    {
        return  $this->iReconHistoryDtRepo->list($request);
    }

}