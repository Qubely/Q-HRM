<?php

namespace App\Repositories\Admin\Attendance\Report\Employee\Load\MonthWise;

use Illuminate\Http\JsonResponse;

interface IMonthWiseLoadRepository {

    public function index($request) : array;
    public function display($request) : array;
}
