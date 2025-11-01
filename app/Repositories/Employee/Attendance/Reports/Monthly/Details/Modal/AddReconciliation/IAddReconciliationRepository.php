<?php

namespace App\Repositories\Employee\Attendance\Reports\Monthly\Details\Modal\AddReconciliation;

use Illuminate\Http\JsonResponse;

interface IAddReconciliationRepository {

    public function display($request) : array;
}
