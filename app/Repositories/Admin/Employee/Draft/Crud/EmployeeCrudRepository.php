<?php

namespace App\Repositories\Admin\Employee\Draft\Crud;

use App\Http\Requests\Admin\Employee\Draft\Crud\ValidateUpdateEmployee;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Auth;
use DB;
use Webpatser\Uuid\Uuid;
use Hash;
class  EmployeeCrudRepository extends BaseRepository implements IEmployeeCrudRepository {

    use BaseTrait;
    public function __construct() {
        $this->LoadModels(['Employee']);
        $this->sizes =  [
            ['width'=> 400, 'height'=> 400,'com'=> 100],
            ['width'=> 80, 'height'=> 80,'com'=> 100],
        ];
        $this->baseQuery = [['status','=','Draft']];
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
       return $this->getPageDefault(model: $this->Employee, id: $id,where: $this->baseQuery);
    }


    /**
     * Yajra datatbale list resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list($request) : JsonResponse
    {
        $model = Employee::orderBy('id','DESC')->where([['status','=','Draft']])->with(['depertment','designation']);
        $this->saveTractAction(
            $this->getTrackData(
                title: 'Employee was viewed by '.$request?->auth?->name.' at '.Carbon::now()->format('d M Y H:i:s A'),
                request: $request,
                onlyTitle: true
            )
        );
        return DataTables::of($model)
        ->editColumn('created_at', function($item) {
            return  Carbon::parse($item->created_at)->format('d-m-Y');
        })
        ->addColumn('image', function($item) {
            $image = getRowImage($item);
            return  "<img src='$image'  class='img-fluid'/>";
        })
        ->editColumn('status', function($item) {
            return  ($item?->status == 'Active') ? "<span class='badge bg-success'> Active </span>" : "<span class='badge bg-danger'> Draft </span>";
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
            $m = new  Employee;
            $m->uuid = (string)Uuid::generate(4);
            $m->name = $request->name;
            $m->mobile_number = $request->mobile_number;
            $m->email = $request->email;
            $m->lib_department_id = $request->lib_department_id;
            $m->lib_designation_id = $request->lib_designation_id;
            $m->email = $request->email;
            $m->user_access = ["SA"];
            $m->password = Hash::make('123456789');
            $path = imagePaths()['dyn_image'];
            $image = $request->file('image');
            if ($request->hasFile('image')) {
                $image_link = (string) Uuid::generate(4);
                $extension = $image->getClientOriginalExtension();
                $image = $this->imageVersioning([
                    'image' => $image, 'path' => $path, 'image_link' => $image_link, 'extension' => $extension,
                    'appendSize' => true,
                    'onlyAppend' => $this->sizes
                ]);
                $m->image = $image_link;
                $m->extension = $extension;
            }
            $m->save();
            $s = new EmployeeSalary;
            $s->employee_id = $m->id;
            $s->save();
            $response['extraData'] = ['inflate' => pxLang($request->lang,'','common.action_success') ];
            $this->saveTractAction($this->getTrackData(title: "Employee was created by ".$request?->auth?->name,request: $request));
            DB::commit();
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->saveError($this->getSystemError(['name' => 'Employee_store_error']), $e);
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
        $row = Employee::find($id);
        if(empty($row)){
            return  $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-danger">'.pxLang($request->lang,'','common.no_resourse').'</span>']);
        }
        $rowRef = [...$row->toArray()];
        $row->name = $request->name;
        $row->mobile_number = $request->mobile_number;
        $row->email = $request->email;
        $row->lib_department_id = $request->lib_department_id;
        $row->lib_designation_id = $request->lib_designation_id;
        $path = imagePaths()['dyn_image'];
        $image = $request->file('image');
        if ($request->hasFile('image')) {
            $this->deleteImageVersions([
                'path' => imagePaths()['dyn_image'],
                'image_link' => $row->image,
                'extension' => $row->extension,
                'sizes' =>  $this->sizes
            ]);
            $image_link = (string) Uuid::generate(4);
            $extension = $image->getClientOriginalExtension();
            $image = $this->imageVersioning([
                'image' => $image, 'path' => $path, 'image_link' => $image_link, 'extension' => $extension,
                'appendSize' => true,
                'onlyAppend' => $this->sizes
            ]);
            $row->image =  $image_link;
            $row->extension = $extension;
        }
        if($row->isDirty()){
            $validator = Validator::make($request->all(), (new ValidateUpdateEmployee())->rules($request,$row));
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
                $this->saveError($this->getSystemError(['name'=>'Employee_update_error']), $e);
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
        $i = Employee::whereIn('id',$request->ids)->select(['id','name'])->get();;
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
                    $this->saveTractAction($this->getTrackData(title: "Employee list was updated by ".$request?->auth?->name, request: $request));
                    DB::commit();
                    return $this->response(['type' => 'success','data' => $data]);
                } catch (\Exception $e) {
                    DB::rollback();
                    $this->saveError($this->getSystemError(['name' => 'Employee_bulk_update_error']), $e);
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
        $i = Employee::whereIn('id',$request->ids)->select(['id'])->get();
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
                    $this->deleteImageVersions([
                        'path' => imagePaths()['dyn_image'],
                        'image_link' => $value->image,
                        'extension' => $value->extension,
                        'sizes' =>  $this->sizes
                    ]);
                    $value->delete();
                }
                $data['extraData'] = [
                    "inflate" => pxLang($request->lang,'','common.action_delete_success'),
                    "redirect" => null
                ];
                $this->saveTractAction($this->getTrackData(title: "Employee list was deleted by ".$request?->auth?->name, request: $request));
                DB::commit();
                return $this->response(['type' => 'success',"data"=>$data]);
            } catch (\Exception $e) {
                DB::rollback();
                $this->saveError($this->getSystemError(['name' => 'Employee_store_error']), $e);
                return $this->response(['type' => 'wrong', 'lang' => 'server_wrong']);
            }
        } else {
            return $this->response(['type' => 'noUpdate', 'title' =>  pxLang($request->lang,'','common.no_data_selected')]);
        }
    }

}
