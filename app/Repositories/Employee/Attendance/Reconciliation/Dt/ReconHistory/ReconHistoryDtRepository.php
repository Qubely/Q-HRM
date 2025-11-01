<?php

namespace App\Repositories\Employee\Attendance\Reconciliation\Dt\ReconHistory;

use App\Models\EmployeeAttendanceRecon;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\JsonResponse;
use Auth;
class ReconHistoryDtRepository extends BaseRepository implements IReconHistoryDtRepository {

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
       $where = [['employee_id','=',Auth::user()->id]];
       return $this->getPageDefault(model: $this->EmployeeAttendanceRecon, id: null,where: $where);
    }


    /**
     * Yajra datatbale list resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list($request) : JsonResponse
    {
        $model = EmployeeAttendanceRecon::where([['employee_id','=',$request?->auth?->id]])->with(['att'])->orderBy('id','DESC');
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
        ->escapeColumns([])
        ->make(true);
    }

}
