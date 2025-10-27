<?php

namespace App\Repositories\Admin\DataLibrary\Salary\Group\Crud\Modal\RefreshSalaryItem;

use App\Models\LibSalaryGroup;
use App\Models\LibSalaryGroupItem;
use App\Models\LibSalaryHead;
use App\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;
use DB;
class RefreshSalaryItemRepository extends BaseRepository implements IRefreshSalaryItemRepository
{

    /**
     * Modal  data
     *
     * @param Request $request
     * @return array
     */
    public function display($request) : array
    {
        $data['item'] = LibSalaryGroup::where([['id','=',$request->id]])->first();
        $data['heads'] = LibSalaryHead::select(['id','name'])->get();
        $data['items'] = LibSalaryGroupItem::where([['lib_salary_group_id','=', $data['item']?->id]])->get();
        return $data;
    }

    /**
     * Refresh salalry grade
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function refresh($request) : JsonResponse
    {
        $item = LibSalaryGroup::where([['id','=',$request->id]])->first();
        if(empty($item)){
            return $this->response(['type'=>'noUpdate','title'=>'Salary not found']);
        }
        DB::beginTransaction();
        try {
            LibSalaryGroupItem::where([['lib_salary_group_id','=',$item?->id]])->delete();
            foreach ($request->type as $key => $value) {
                $i = new LibSalaryGroupItem;
                $i->lib_salary_id = $item->id;
                $i->type = $value;
                $i->description = $request->description[$key];
                $i->amount = $request->amount[$key];
                $i->save();
            }
            $response['extraData'] = ['inflate' => pxLang($request->lang,'','common.action_success') ];
            $this->saveTractAction($this->getTrackData(title: "LibSalaryGroupItem was created by ".$request?->auth?->name,request: $request));
            DB::commit();
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->saveError($this->getSystemError(['name' => 'LibSalaryGroupItem_store_error']), $e);
            return $this->response(['type' => 'noUpdate', 'title' => pxLang($request->lang,'','common.server_wrong')]);
        }
    }

    /**
     * Buk update salary items
     *
     * @param  Request $request
     * @return JsonResponse
     */
    public function bulkUpdate($request) : JsonResponse
    {
        $i = LibSalaryGroupItem::whereIn('id',$request->ids)->get();;
        $dirty = [];
        if (count($i) > 0) {
            foreach ($i as $key => $value) {
                $value->type = $request->type[$value->id];
                $value->description = $request->description[$value->id];
                $value->amount = $request->amount[$value->id];
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
                    $this->saveTractAction($this->getTrackData(title: "LibSalaryGroupItem list was updated by ".$request?->auth?->name, request: $request));
                    DB::commit();
                    return $this->response(['type' => 'success','data' => $data]);
                } catch (\Exception $e) {
                    DB::rollback();
                    $this->saveError($this->getSystemError(['name' => 'LibSalaryGroupItem_bulk_update_error']), $e);
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
     * Delete salalry item
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function delete($request) : JsonResponse
    {
        $parent = LibSalaryGroup::where([['id','=',$request->lib_salary_group_id]])->first();
        if(empty($parent)){
            return $this->response(['type'=>'noUpdate','title'=> pxLang($request->lang,'text.no_salary_found')]);
        }
        $total = LibSalaryGroupItem::where([['id','=',$parent?->id]])->count();
        if($total <= 1) {
            return $this->response(['type'=>'noUpdate','title'=>pxLang($request->lang,'text.must_have_item')]);
        }
        $item = LibSalaryGroupItem::where([['id','=',$request->id]])->first();
        if(empty($item)){
            return $this->response(['type'=>'noUpdate','title'=> pxLang($request->lang,'text.salary_item_not_found')]);
        }
        try {
            $item->delete();
            $response['extraData'] = [
                'inflate' => pxLang($request->lang,'','common.action_success'),
                'id' => $request->id
            ];
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            $this->saveError($this->getSystemError(['name' => 'LibSalaryItemGroup_delete_error']), $e);
            return $this->response(['type' => 'wrong', 'lang' => 'server_wrong']);
        }
    }
}
