<?php

namespace App\Repositories\Admin\DataLibrary\Leave\Crud;

use App\Http\Requests\Admin\DataLibrary\Leave\Crud\ValidateUpdateLibLeave;
use App\Models\LibLeave;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Auth;
use DB;
class  LibLeaveCrudRepository extends BaseRepository implements ILibLeaveCrudRepository {

    use BaseTrait;
    public function __construct() {
        $this->LoadModels(['LibLeave']);
    }

    /**
     * Get the page default resource
     *
     * @param Request $request
     * @param integer|string $id
     * @return array
     */
    public function index($request,$id=null) : array
    {
       return $this->getPageDefault(model: $this->LibLeave, id: $id);
    }


    /**
     * Yajra datatbale list resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list($request) : JsonResponse
    {
        $model = LibLeave::query();
        $this->saveTractAction(
            $this->getTrackData(
                title: 'LibLeave was viewed by '.$request?->auth?->name.' at '.Carbon::now()->format('d M Y H:i:s A'),
                request: $request,
                onlyTitle: true
            )
        );
        return DataTables::of($model)
        ->editColumn('created_at', function($item) {
            return  Carbon::parse($item->created_at)->format('d-m-Y');
        })
        ->escapeColumns([])
        ->make(true);
    }

    /**
     * Store resource
     *
     * @param Request  $request
     * @return JsonResponse
     */
    public function store($request) : JsonResponse
    {   
        DB::beginTransaction();
        try {
            LibLeave::create([
                ...$request->all(),
                //'serial' => $this->facSrWc($this->LibLeave)
            ]);
            $response['extraData'] = ['inflate' => pxLang($request->lang,'','common.action_success') ];
            $this->saveTractAction($this->getTrackData(title: "LibLeave was created by ".$request?->auth?->name,request: $request));
            DB::commit();
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->saveError($this->getSystemError(['name' => 'LibLeave_store_error']), $e);
            return $this->response(['type' => 'noUpdate', 'title' => pxLang($request->lang,'','common.server_wrong')]);
        }
    }

    /**
     * Update resource
     *
     * @param Requets $request
     * @param integer|string $id
     * @return JsonResponse
     */
    public function update($request,$id) : JsonResponse
    {
        $row = LibLeave::find($id);
        if(empty($row)){
            return  $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-danger">'.pxLang($request->lang,'','common.no_resourse').'</span>']);
        }
        $rowRef = [...$row->toArray()];
        $row->fill($request->all());
        if($row->isDirty()){
            $validator = Validator::make($request->all(), (new ValidateUpdateLibLeave())->rules($request,$row));
            if ($validator->fails()) {
                return $this->response(['type' => 'validation','errors' => $validator->errors()]);
            }
            DB::beginTransaction();
            try {
                $row->save();
                $data['extraData'] = ["inflate" =>  pxLang($request->lang,'','common.action_success')];
                $this->saveTractAction($this->getTrackData(title: " LibLeave ".$row?->name.' was updated by '.$request?->auth?->name,request: $request, row: $rowRef, type: 'to'));
                DB::commit();
                return $this->response(['type' => 'success','data' => $data]);
            } catch (\Exception $e) {
                $this->saveError($this->getSystemError(['name'=>'LibLeave_update_error']), $e);
                return $this->response(["type"=>"wrong","lang"=>"server_wrong"]);
            }
        } else {
            return $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-success">'.pxLang($request->lang,'','common.no_change').'</span>']);
        }
    }

    /**
     *  Bulk update list resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateList($request) : JsonResponse
    {
        $i = LibLeave::whereIn('id',$request->ids)->select(['id','name'])->get();;
        $dirty = [];
        if (count($i) > 0) {
            foreach ($i as $key => $value) {
                //$value->serial = $request->serial[$value->id];
                if ($value->isDirty()) {
                    $dirty[$key] = "yes";
                }
            }
            if (count($dirty) > 0) {
                DB::beginTransaction();
                try {
                    foreach ($i as $key => $value) {
                        $value->save();
                    }
                    $data['extraData'] = [
                        "inflate" => pxLang($request->lang,'','common.action_update_success')
                    ];
                    $this->saveTractAction($this->getTrackData(title: "LibLeave list was updated by ".$request?->auth?->name, request: $request));
                    DB::commit();
                    return $this->response(['type' => 'success','data' => $data]);
                } catch (\Exception $e) {
                    DB::rollback();
                    $this->saveError($this->getSystemError(['name' => 'LibLeave_bulk_update_error']), $e);
                    return $this->response(['type' => 'wrong', 'lang' => 'server_wrong']);
                }
            } else {
                return $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-success"> '.pxLang($request->lang,'','common.no_change').'  </span>']);
            }

        } else {
            return $this->response(['type' => 'noUpdate', 'title' => pxLang($request->lang,'','common.went_wrong')]);
        }
    }

    /**
     * Bulk delete list resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteList($request) : JsonResponse
    {
        $errors = [];
        $i = LibLeave::whereIn('id',$request->ids)->select(['id'])->get();
        if (count($i) > 0) {
            // $errors = $this->checkInUse([
            //     "rows" => $i,
            //     "search" => ["id","id"],
            //     "denined" => ["name","name"],
            //     "targetModel" => [$this->StudentAdmission,$this->ExamResult],
            //     "targetCol" => ["lib_category_id","lib_category_id"],
            //     "exists" => ["Class Category","Class Category"],
            //     "in" => ["Stduent Table","Result Table"]
            // ]);
            if (count($errors) > 0) {
                return $this->response(['type'=>'bigError','errors'=>$errors]);
            }
            DB::beginTransaction();
            try {
                foreach ($i as $key => $value) {
                    $value->delete();
                }
                $data['extraData'] = [
                    "inflate" => pxLang($request->lang,'','common.action_delete_success'),
                    "redirect" => null
                ];
                $this->saveTractAction($this->getTrackData(title: "LibLeave list was deleted by ".$request?->auth?->name, request: $request));
                DB::commit();
                return $this->response(['type' => 'success',"data"=>$data]);
            } catch (\Exception $e) {
                DB::rollback();
                $this->saveError($this->getSystemError(['name' => 'LibLeave_store_error']), $e);
                return $this->response(['type' => 'wrong', 'lang' => 'server_wrong']);
            }
        } else {
            return $this->response(['type' => 'noUpdate', 'title' =>  pxLang($request->lang,'','common.no_data_selected')]);
        }
    }

}