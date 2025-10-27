<?php

namespace App\Repositories\Admin\Employee\Draft\Crud\BankDetails\Form\Update;

use App\Http\Requests\Admin\Employee\Draft\Crud\BankDetails\Form\Update\ValidateEmployeeBankDetailsUpdate;
use App\Models\Employee;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use DB;
class  EmployeeBankDetailsUpdateRepository extends BaseRepository implements IEmployeeBankDetailsUpdateRepository {

    use BaseTrait;
    public function __construct() {
        $this->LoadModels(['Employee']);
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
                title: 'Employee update was viewed by '.$request?->auth?->name.' at '.Carbon::now()->format('d M Y H:i:s A'),
                request: $request,
                onlyTitle: true
            )
        );
       return $this->getPageDefault(model: $this->Employee, id: $id);
    }

    /**
     * Update resource
     *
     * @param Requets $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update($request) : JsonResponse
    {
        $row = Employee::find($request->id);
        if(empty($row)){
            return  $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-danger">'.pxLang($request->lang,'','common.no_resourse').'</span>']);
        }
        $rowRef = [...$row->toArray()];
        $row->bank_name = $request->bank_name;
        $row->branch = $request->branch;
        $row->ac_name = $request->ac_name;
        $row->ac_number = $request->ac_number;
        if($row->isDirty()){
            $validator = Validator::make($request->all(), (new ValidateEmployeeBankDetailsUpdate())->rules($request,$row));
            if ($validator->fails()) {
                return $this->response(['type' => 'validation','errors' => $validator->errors()]);
            }
            DB::beginTransaction();
            try {
                $row->save();
                $data['extraData'] = ["inflate" =>  pxLang($request->lang,'','common.action_success')];
                $this->saveTractAction($this->getTrackData(title: " Employee ".$row?->name.' was updated by '.$request?->auth?->name,request: $request, row: $rowRef, type: 'to'));
                DB::commit();
                return $this->response(['type' => 'success','data' => $data]);
            } catch (\Exception $e) {
                DB::rollback();
                $this->saveError($this->getSystemError(['name'=>'Employee_update_error']), $e);
                return $this->response(["type"=>"wrong","lang"=>"server_wrong"]);
            }
        } else {
            return $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-success">'.pxLang($request->lang,'','common.no_change').'</span>']);
        }
    }
}
