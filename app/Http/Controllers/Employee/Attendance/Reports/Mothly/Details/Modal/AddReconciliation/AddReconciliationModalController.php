<?php

namespace App\Http\Controllers\Employee\Attendance\Reports\Mothly\Details\Modal\AddReconciliation;
use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeAttendanceRecon;
use App\Traits\BaseTrait;
use Illuminate\Http\JsonResponse;
use View;
use Illuminate\Http\Request;
use App\Repositories\Employee\Attendance\Reports\Monthly\Details\Modal\AddReconciliation\IAddReconciliationRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Response;
//vpx_imports

class AddReconciliationModalController extends Controller {

    use BaseTrait;
    public function __construct(private IAddReconciliationRepository $iAddReconciliationRepo) {
        $this->middleware(['auth:employee','HasEmployeePassword','HasEmployeeAuth']);
        $this->lang= 'employee.attendance.reports.monthly.details.modal.add-reconciliation';
        $this->middleware(function ($request, $next) {
            $request->merge(['lang' => $this->lang]);
            return $next($request);
        });

    }

    /**
     * Loaded page for addreconciliation
     *
     * @param Request $request
     * @return View
     */
    public function display(Request $request) : JsonResponse
    {
        $data['lang'] = $this->lang;
        $data = [...$data,...$this->iAddReconciliationRepo->display($request)];
        $view = View::make('employee.pages.attendance.reports.monthly.details.modal.add-reconciliation._modal', compact('data'))->render();
        $response = ['extraData' => ['inflate' => pxLang($data['lang'],'','common.response_success')],'view' => $view];
        return $this->response(['type' => 'success', 'data' => $response]);
    }
    //vpx_attach

    public function send(Request $request)
    {
        $att = EmployeeAttendance::where([['id','=',$request->id]])->first();
        if(empty($att)){
            return $this->response(['type'=>'noUpdate','title'=>pxLang($this->lang,'','common.page_not_found')]);
        }
        $messages = [
        ];
        $rules = [
            'in_time' => ['required', 'date_format:h:i A'],
            'reason' => 'required|string|max:253',
            'out_time' => [
                'required',
                'date_format:h:i A',
                function ($attribute, $value, $fail) use ($request) {
                    $inTime = Carbon::createFromFormat('h:i A', $request->in_time);
                    $outTime = Carbon::createFromFormat('h:i A', $value);
                    if ($outTime->lte($inTime)) {
                        $fail(pxLang($this->lang,'text.max_out_time'));
                    }
                },
            ],
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return Response::json(
            array(
                'success' => false,
                'errors'  => $validator->getMessageBag()->toArray(),
            ));
        }
        try {
            $m = new EmployeeAttendanceRecon;
            $m->employee_id = $request?->auth?->id;
            $m->employee_attendance_id = $att->id;
            $m->in_time = Carbon::parse($request->in_time)->format('H:i:s');
            $m->out_time = Carbon::parse($request->out_time)->format('H:i:s');
            $m->reason = $request->reason;
            $m->save();
            $response['extraData'] = [ 'inflate' => pxLang($this->lang,'','common.action_success')];
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            $this->saveError($this->getSystemError(['name' => 'UqProfession_store_error']), $e);
            return $this->response(['type' => 'wrong', 'lang' => 'server_wrong']);
        }
    }

}
