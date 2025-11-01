<?php

namespace App\Repositories\Employee\Attendance\Reports\Monthly\Details\Modal\AddReconciliation;

use App\Models\EmployeeAttendance;
use App\Repositories\BaseRepository;

class AddReconciliationRepository extends BaseRepository implements IAddReconciliationRepository
{

    /**
     * Modal  data
     *
     * @param Request $request
     * @return array
     */
    public function display($request) : array
    {
        $data['item'] = EmployeeAttendance::with(['reqRequest'=>function($q){$q->where([['status','=','Pending']]);}])->find($request->id);
        return $data;
    }
}
