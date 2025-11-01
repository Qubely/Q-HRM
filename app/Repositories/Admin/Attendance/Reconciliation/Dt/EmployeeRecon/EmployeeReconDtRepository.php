<?php

namespace App\Repositories\Admin\Attendance\Reconciliation\Dt\EmployeeRecon;

use App\Models\EmployeeAttendanceRecon;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\JsonResponse;
use DB;
class EmployeeReconDtRepository extends BaseRepository implements IEmployeeReconDtRepository {

    use BaseTrait;
    public function __construct() {
        $this->LoadModels(['EmployeeAttendanceRecon']);
    }
    /**
     * Get the page default resource
     *
     * @param Request $request
     * @param integer|string $id
     * @return array
     */
    public function index($request) : array
    {
       return $this->getPageDefault(model: $this->EmployeeAttendanceRecon, id: null);
    }


    /**
     * Yajra datatbale list resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list($request) : JsonResponse
    {
        $model = EmployeeAttendanceRecon::orderBy('id','DESC');
        $this->saveTractAction(
            $this->getTrackData(
                title: 'EmployeeAttendanceRecon was viewed by '.$request?->auth?->name.' at '.Carbon::now()->format('d M Y H:i:s A'),
                request: $request,
                onlyTitle: true
            )
        );
        return DataTables::of($model)
        ->editColumn('status', function($item) {
           return getReconStatus($item);
        })
        ->editColumn('created_at', function($item) {
            return  Carbon::parse($item->created_at)->format('d-m-Y');
        })
        ->editColumn('att.in_time', function($item) {
            return  ($item?->att?->in_time == null) ? '-' : Carbon::parse($item?->att?->in_time)->format('h:i A');;
        })
         ->editColumn('att.out_time', function($item) {
            return  ($item?->att?->out_time == null) ? '-' : Carbon::parse($item?->att?->out_time)->format('h:i A');
        })
        ->editColumn('in_time', function($item) {
            return ($item?->in_time == null) ? '-' : Carbon::parse($item?->in_time)->format('h:i A');
        })
        ->editColumn('out_time', function($item) {
            return  ($item?->out_time == null) ? '-' : Carbon::parse($item?->out_time)->format('h:i A');
        })
        ->addColumn('status_raw',function($item){
            return $item?->status;
        })
        ->escapeColumns([])
        ->make(true);
    }

     /**
     * Ban the reconciliated
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function ban($request) : JsonResponse
    {
        $req = EmployeeAttendanceRecon::find($request->id);
        if(empty($req)) {
            return $this->response(['type'=>'noUpdate','title'=> pxLang('','','common.page_not_found')]);
        }
        DB::beginTransaction();
        try {
            $req->status = 'Declined';
            $req->save();
            $this->saveTractAction($this->getTrackData(title: "EmployeeAttendanceRecon was declined by ".$request?->auth?->name,request: $request));
            $response['extraData'] = [ 'inflate' => pxLang('','','common.action_success') ];
            DB::commit();
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->saveError($this->getSystemError(['name' => 'UqProfession_store_error']), $e);
            return $this->response(['type' => 'wrong', 'lang' => 'server_wrong']);
        }

    }


    /**
     * Approve reconciliated
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function aprove($request) : JsonResponse
    {
        $req = EmployeeAttendanceRecon::find($request->id);
        if(empty($req)) {
            return $this->response(['type'=>'noUpdate','title'=> pxLang('','','common.page_not_found')]);
        }
        DB::beginTransaction();
        try {
            $req->status = 'Approved';
            $req->save();
            $req->att->in_time = $req->in_time;
            $req->att->out_time = $req->out_time;
            $req->att->save();
            $this->saveTractAction($this->getTrackData(title: "EmployeeAttendanceRecon was approved by ".$request?->auth?->name,request: $request));
            DB::commit();
            $response['extraData'] = [ 'inflate' => pxLang('','','common.action_success') ];
            return $this->response(['type' => 'success', 'data' => $response]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->saveError($this->getSystemError(['name' => 'UqProfession_store_error']), $e);
            return $this->response(['type' => 'wrong', 'lang' => 'server_wrong']);
        }
    }


}
