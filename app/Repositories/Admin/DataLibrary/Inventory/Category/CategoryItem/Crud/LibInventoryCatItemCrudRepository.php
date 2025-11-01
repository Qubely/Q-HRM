<?php

namespace App\Repositories\Admin\DataLibrary\Inventory\Category\CategoryItem\Crud;

use App\Http\Requests\Admin\DataLibrary\Inventory\Category\CategoryItem\Crud\ValidateUpdateLibInventoryCatItem;
use App\Models\LibInventoryCatItem;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Auth;
use DB;
use Webpatser\Uuid\Uuid;

class  LibInventoryCatItemCrudRepository extends BaseRepository implements ILibInventoryCatItemCrudRepository {

    use BaseTrait;
    public function __construct() {
        $this->LoadModels(['LibInventoryCatItem']);
        $this->sizes =  [
            ['width'=> 400, 'height'=> 400,'com'=> 100],
            ['width'=> 80, 'height'=> 80,'com'=> 100],
        ];
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
       $where = [['lib_inventory_cat_id','=',$request->cat_item_id]];
       return $this->getPageDefault(model: $this->LibInventoryCatItem, id: $id,where:$where);
    }


    /**
     * Yajra datatbale list resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list($request) : JsonResponse
    {
        $model = LibInventoryCatItem::with(['assigned'])->where([['lib_inventory_cat_id','=',$request->lib_inventory_cat_id]]);
        $this->saveTractAction(
            $this->getTrackData(
                title: 'LibInventoryCatItem was viewed by '.$request?->auth?->name.' at '.Carbon::now()->format('d M Y H:i:s A'),
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
            return  getReconStatus($item);
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
            $path = imagePaths()['dyn_image'];
            $image = $request->file('image');
            $image_link = null;
            $extension = null;
            if ($request->hasFile('image')) {
                $image_link = (string) Uuid::generate(4);
                $extension = $image->getClientOriginalExtension();
                $image = $this->imageVersioning([
                    'image' => $image, 'path' => $path, 'image_link' => $image_link, 'extension' => $extension,
                    'appendSize' => true,
                    'onlyAppend' => $this->sizes
                ]);
            }
            LibInventoryCatItem::create([
                ...$request->all(),
                'image' => $image_link,
                'extension' => $extension,
                'serial' => $this->facSrWc($this->LibInventoryCatItem,['where'=>[[['lib_inventory_cat_id','=',$request->lib_inventory_cat_id]]]])
            ]);
            $response['extraData'] = ['inflate' => pxLang($request->lang,'','common.action_success') ];
            $this->saveTractAction($this->getTrackData(title: "LibInventoryCatItem was created by ".$request?->auth?->name,request: $request));
            DB::commit();
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->saveError($this->getSystemError(['name' => 'LibInventoryCatItem_store_error']), $e);
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
        $row = LibInventoryCatItem::find($id);
        if(empty($row)){
            return  $this->response(['type' => 'noUpdate', 'title' =>  '<span class="text-danger">'.pxLang($request->lang,'','common.no_resourse').'</span>']);
        }
        $rowRef = [...$row->toArray()];
        $row->fill($request->all());
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
            $validator = Validator::make($request->all(), (new ValidateUpdateLibInventoryCatItem())->rules($request,$row));
            if ($validator->fails()) {
                return $this->response(['type' => 'validation','errors' => $validator->errors()]);
            }
            DB::beginTransaction();
            try {
                $row->save();
                $data['extraData'] = ["inflate" =>  pxLang($request->lang,'','common.action_success')];
                $this->saveTractAction($this->getTrackData(title: " LibInventoryCatItem ".$row?->name.' was updated by '.$request?->auth?->name,request: $request, row: $rowRef, type: 'to'));
                DB::commit();
                return $this->response(['type' => 'success','data' => $data]);
            } catch (\Exception $e) {
                DB::rollback();
                $this->saveError($this->getSystemError(['name'=>'LibInventoryCatItem_update_error']), $e);
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
        $i = LibInventoryCatItem::whereIn('id',$request->ids)->select(['id','serial'])->get();;
        $dirty = [];
        if (count($i) > 0) {
            foreach ($i as $key => $value) {
                 $value->serial = $request->serial[$value->id];
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
                    $this->saveTractAction($this->getTrackData(title: "LibInventoryCatItem list was updated by ".$request?->auth?->name, request: $request));
                    DB::commit();
                    return $this->response(['type' => 'success','data' => $data]);
                } catch (\Exception $e) {
                    DB::rollback();
                    $this->saveError($this->getSystemError(['name' => 'LibInventoryCatItem_bulk_update_error']), $e);
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
        $i = LibInventoryCatItem::whereIn('id',$request->ids)->select(['id'])->get();
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
                $this->saveTractAction($this->getTrackData(title: "LibInventoryCatItem list was deleted by ".$request?->auth?->name, request: $request));
                DB::commit();
                return $this->response(['type' => 'success',"data"=>$data]);
            } catch (\Exception $e) {
                DB::rollback();
                $this->saveError($this->getSystemError(['name' => 'LibInventoryCatItem_store_error']), $e);
                return $this->response(['type' => 'wrong', 'lang' => 'server_wrong']);
            }
        } else {
            return $this->response(['type' => 'noUpdate', 'title' =>  pxLang($request->lang,'','common.no_data_selected')]);
        }
    }

}
