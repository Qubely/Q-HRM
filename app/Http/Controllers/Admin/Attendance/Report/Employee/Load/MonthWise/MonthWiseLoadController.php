<?php

namespace App\Http\Controllers\Admin\Attendance\Report\Employee\Load\MonthWise;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Repositories\Admin\Attendance\Report\Employee\Load\MonthWise\IMonthWiseLoadRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use Illuminate\Contracts\View\View as RenderView;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use View;
use Response;
class MonthWiseLoadController extends Controller {

    use BaseTrait;
    public function __construct(private IMonthWiseLoadRepository $iMonthWiseLoadRepo) {
        $this->middleware(['auth:admin','HasAdminUserPassword','HasAdminUserAuth']);
        $this->lang= 'admin.attendance.report.employee.load';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Index page for monthwise crud
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : RenderView
    {
        $data = $this->iMonthWiseLoadRepo->index($request);
        $data['lang'] = $this->lang;
        $data['employee'] = Employee::where([['status','=','Active']])->select(['id','name'])->get();
        return view('admin.pages.attendance.report.employee.load.month-wise.index',compact('data'));
    }

    /**
     * Load view
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function display(Request $request) : JsonResponse
    {
        $data['lang'] = $this->lang;
        $messages = [
        ];
        $rules = [
            'from_date'   => 'required|date',
            'to_date'     => 'required|date|after_or_equal:from_date',
            'employee_id' => 'required|integer|exists:employees,id',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return Response::json(array(
                'success' => false,
                'errors'  => $validator->getMessageBag()->toArray(),
            ));
        }
        if($this->cheExccedTotalDate($request)){
            return Response::json(array(
                    'success' => false,
                    'errors'  => ['to_date' => ['Total date can not be excced to 31']],
                ));
        }
        $data = [...$data,...$this->iMonthWiseLoadRepo->display($request)];
        $view = View::make('admin.pages.attendance.report.employee.load.month-wise.fragments._display', compact('data'))->render();
        $response = ['extraData' => ['inflate' => pxLang($data['lang'],'','common.response_success')],'view' => $view,'data' => $data];
        return $this->response(['type' => 'success', 'data' => $response]);
    }

}
