<?php

namespace App\Repositories\Admin\Employee\Draft\Crud\Modal\ViewDraftEmployee;

use App\Models\AppData;
use App\Models\Employee;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use DB;
class ViewDraftEmployeeRepository extends BaseRepository implements IViewDraftEmployeeRepository
{

    /**
     * Modal  data
     *
     * @param Request $request
     * @return array
     */
    public function display($request) : array
    {
        $appData = AppData::find(1);
        $data['item'] = Employee::where([['id','=',$request->id]])->first();
        $data['lastId'] = $this->getLstEmpId($appData);
        return $data;
    }

    public function entry($request) : JsonResponse
    {
        $appData = AppData::find(1);
        if(empty($appData)) {
            return $this->response(['type'=>'noUpdate','title'=> pxLang($this->lang,'','common.page_not_found')]);
        }
        $employee = Employee::find($request->id);
        if(empty($employee)) {
            return $this->response(['type'=>'noUpdate','title'=> pxLang($this->lang,'','common.page_not_found')]);
        }
        DB::beginTransaction();
        try {
            $employee->employee_id = $this->getLstEmpId($appData);
            $employee->status = 'Active';
            $employee->joining_date = Carbon::parse($request->joining_date)->format('Y-m-d');
            $employee->save();
            $appData->last_employee_id += 1;
            $appData->save();
            $data['extraData'] = ["inflate" =>  pxLang($request->lang,'','common.action_success')];
            $this->saveTractAction($this->getTrackData(title: " Employee  ".$employee?->name.' was updated activated  by '.$request?->auth?->name,request: $request));
            DB::commit();
            return $this->response(['type' => 'success','data' => $data]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->saveError($this->getSystemError(['name'=>'employee_entry_update_error']), $e);
            return $this->response(["type"=>"wrong","lang"=>"server_wrong"]);
        }
    }

    private function getLstEmpId($appData){
        $lastId = '000000'.$appData?->last_employee_id;
        return $lastId;
    }
}
