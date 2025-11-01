<?php

namespace App\Repositories\Admin\Attendance\Reconciliation\Dt\EmployeeRecon;

use Illuminate\Http\JsonResponse;

interface IEmployeeReconDtRepository {

    public function index($request) : array;
    public function list($request) : JsonResponse;
    public function ban($request) : JsonResponse;
    public function aprove($request) : JsonResponse;
}
