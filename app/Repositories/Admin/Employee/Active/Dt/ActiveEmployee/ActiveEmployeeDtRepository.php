<?php

namespace App\Repositories\Admin\Employee\Active\Dt\ActiveEmployee;

use App\Models\Employee;
use App\Repositories\BaseRepository;
use App\Traits\BaseTrait;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\JsonResponse;
class ActiveEmployeeDtRepository extends BaseRepository implements IActiveEmployeeDtRepository {

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
    public function index($request) : array
    {
       return [
        'items' => Employee::where([['status','=','Active']])->take(1)->select(['id'])->get()
       ];
    }


    /**
     * Yajra datatbale list resource
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list($request) : JsonResponse
    {
        $model = Employee::where([['status','Active']])->orderBy('id','DESC')->with(['depertment','designation']);
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
}
