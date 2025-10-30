<?php

namespace App\Repositories\Employee\Attendance\Reconciliation\Dt\ReconHistory;

use Illuminate\Http\JsonResponse;

interface IReconHistoryDtRepository {

    public function index($request) : array;
    public function list($request) : JsonResponse;
}
