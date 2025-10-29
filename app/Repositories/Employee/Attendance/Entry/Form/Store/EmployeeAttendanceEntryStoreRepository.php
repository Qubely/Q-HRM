<?php

namespace App\Repositories\Employee\Attendance\Entry\Form\Store;

use App\Models\Employee;
use App\Models\EmployeeAttendance;
use App\Models\EmployeeAttendanceHistory;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Illuminate\Http\JsonResponse;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Response;
use Auth;
use File;
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
        $att = EmployeeAttendance::where('employee_id', Auth::user()->id)->whereDate('att_date', date('Y-m-d'))->first();
        return [...$this->getPageDefault(model: $this->EmployeeAttendance, id: $id), 'att' => $att];
    }

    /**
     * Store resource
     *
     * @param Request  $request
     * @return JsonResponse
     */
    public function store($request) : JsonResponse
    {
        $userAgent = $request->header('User-Agent');
        if (!str_contains($userAgent, 'Chrome')) {
           return $this->response(['type'=>'noUpdate','title'=>  pxLang($request->lang,'mgs.chrome_required')]);
        }
        $employee = Employee::where([['id','=',$request->employee_id]])->first();
        if(empty($employee)) {
            return $this->response(['type'=>'noUpdate','title'=> pxLang($request->lang,'mgs.employee_no_found')]);
        }
        $today = Carbon::now()->format('Y-m-d');
        $nowTime =  Carbon::now()->format('H:i:s');
        try {
            DB::beginTransaction();
            $ex = EmployeeAttendance::where([['employee_id','=',$employee->id],['att_date','=', $today]])->first();
            if(empty($ex)) {
                $ex = new EmployeeAttendance;
                $ex->employee_id = $employee->id;
                $ex->att_date = $today;
                $ex->in_time = $nowTime;
                $ex->longitude_in = $request->longitude;
                $ex->latitude_in = $request->latitude;
                $path = imagePaths()['dyn_image'];
                $image = $request->file('image');
                if ($request->hasFile('image')) {
                    $originalName = $image->getClientOriginalName();
                    $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                    $filename = time() . '_.' . $extension;
                    $image->move($path, $filename);
                    $ex->in_image = $filename;
                }
                $ex->status = 'present';
                $ex->save();
                $h = new EmployeeAttendanceHistory;
                $h->employee_attendance_id = $ex->id;
                $h->type = 'in-time';
                $h->time =  $nowTime;
                $h->save();
            }
            DB::commit();
            $response['extraData'] = [
                'inflate' => pxLang($request->lang,'','common.action_success')
            ];
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->saveError($this->getSystemError(['name' => 'employee_attendance_store_error']), $e);
            return $this->response(['type' => 'wrong', 'lang' => 'server_wrong '.$e->getMessage()]);
        }
    }

     /**
     * Update attendace
     *
     * @param Request  $request
     * @return JsonResponse
     */
    public function update($request) : JsonResponse
    {
        $userAgent = $request->header('User-Agent');
        if (!str_contains($userAgent, 'Chrome')) {
           return $this->response(['type'=>'noUpdate','title'=>  pxLang($request->lang,'mgs.chrome_required')]);
        }
        $employee = Employee::where([['id','=',$request->employee_id]])->first();
        if(empty($employee)) {
            return $this->response(['type'=>'noUpdate','title'=> pxLang($request->lang,'mgs.employee_no_found')]);
        }
        $today = Carbon::now()->format('Y-m-d');
        $ex = EmployeeAttendance::where([['employee_id','=',$employee->id],['att_date','=', $today]])->first();
        if(empty($ex)) {
            return $this->response(['type'=>'noUpdate','title'=> pxLang($request->lang,'mgs.no_intime')]);
        }
        $nowTime =  Carbon::now()->format('H:i:s');
        try {
            $ex->out_time =  $nowTime;
            $ex->longitude_in =  $request->longitude;
            $ex->latitude_in =  $request->latitude;
            $path = imagePaths()['dyn_image'];
            $old = $path.'/'.$ex?->out_image;
            if(file_exists($old)) {
                File::delete($old);
            }
            $image = $request->file('out_image');
            if ($request->hasFile('out_image')) {
                $originalName = $image->getClientOriginalName();
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                $filename = time() . '_.' . $extension;
                $image->move($path, $filename);
                $ex->out_image = $filename;
            }
            $ex->save();
            $response['extraData'] = ['inflate' => pxLang($request->lang,'','common.action_success')];
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            $this->saveError($this->getSystemError(['name' => 'UqProfession_store_error']), $e);
            return $this->response(['type' => 'wrong', 'lang' => 'server_wrong']);
        }
    }
}
