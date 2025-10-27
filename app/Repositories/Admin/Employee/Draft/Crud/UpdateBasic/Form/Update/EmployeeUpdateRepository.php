<?php

namespace App\Repositories\Admin\Employee\Draft\Crud\UpdateBasic\Form\Update;

use App\Http\Requests\Admin\Employee\Draft\Crud\UpdateBasic\Form\Update\ValidateEmployeeUpdate;
use App\Models\Employee;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use DB;
class  EmployeeUpdateRepository extends BaseRepository implements IEmployeeUpdateRepository {

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
        $row->father_name        = $request->father_name;
        $row->mother_name        = $request->mother_name;
        $row->present_address    = $request->present_address;
        $row->permanent_address  = $request->permanent_address;
        $row->gender             = $request->gender;
        $row->date_of_birth      = ($request->date_of_birth == null) ? NULL : Carbon::parse($request->date_of_birth)->format('Y-m-d');
        $row->nid                = $request->nid;
        $row->emergency_contact  = $request->emergency_contact;
        $row->maritual_status    = $request->maritual_status;
        if($row->isDirty()){
            $validator = Validator::make($request->all(), (new ValidateEmployeeUpdate())->rules($request,$row));
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
