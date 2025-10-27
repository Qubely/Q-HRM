<?php

namespace App\Repositories\Employee\Attendance\Entry\Form\Store;

use App\Models\EmployeeAttendance;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\JsonResponse;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Response;
class  EmployeeAttendanceEntryStoreRepository extends BaseRepository implements IEmployeeAttendanceEntryStoreRepository {

    use BaseTrait;
    public function __construct() {
        $this->LoadModels(['EmployeeAttendance']);
    }

    /**
     * Get the page default resource
     *
     * @param Request $request
     * @param integer|string $id
     * @return array
     */
    public function index($request, $id=null) : array
    {
       $this->saveTractAction(
            $this->getTrackData(
                title: 'EmployeeAttendance store was viewed by '.$request?->auth?->name.' at '.Carbon::now()->format('d M Y H:i:s A'),
                request: $request,
                onlyTitle: true
            )
        );
       return $this->getPageDefault(model: $this->EmployeeAttendance, id: $id);
    }

    /**
     * Store resource
     *
     * @param Request  $request
     * @return JsonResponse
     */
    public function store($request) : JsonResponse
    {
        print_r($request->all());
        die();
        $userAgent = $request->header('User-Agent');
        if (!str_contains($userAgent, 'Chrome')) {
           return $this->response(['type'=>'noUpdate','title'=>  pxLang($this->lang,'mgs.chrome_required')]);
        }
        $employee = HrmEmployee::where([['id','=',$request->employee_id]])->first();
        if(empty($employee)) {
            return $this->response(['type'=>'noUpdate','title'=> pxLang($this->lang,'mgs.employee_no_found')]);
        }
        $today = Carbon::now()->format('Y-m-d');
        $nowTime =  Carbon::now()->format('H:i:s');
        try {
            $ex = EmployeeAttendance::where([['employee_id','=',$employee->id],['att_date','=', $today]])->first();
            if(empty($ex)) {
                $attendance = EmployeeAttendance::firstOrCreate(
                    [
                        'employee_id' => $employee->id,
                        'att_date' => $today,
                    ],
                    [
                        'in_time' => $nowTime,
                        'lang_in' => $request->lang,
                        'lati_in' => $request->lati,
                        'status' => 'present',
                    ]
                );
                if (is_null($attendance->in_time)) {
                    $attendance->in_time = $nowTime;
                    $attendance->status = 'present';
                    $attendance->save();
                }

            }  else {

                if($ex->device_id == null) {
                    $ex->device_id = 'user';
                    $ex->status = 'present';
                    $ex->in_time =  $nowTime;
                    $ex->lang_in =  $request->lang;
                    $ex->lati_in =  $request->lati;
                    $ex->save();
                }
            }
            $response['extraData'] = [
                'inflate' => pxLang($this->lang,'common.action_success')
            ];
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            $this->saveError($this->getSystemError(['name' => 'employee_attendance_store_error']), $e);
            return $this->response(['type' => 'wrong', 'lang' => 'server_wrong '.$e->getMessage()]);
        }
    }
}
