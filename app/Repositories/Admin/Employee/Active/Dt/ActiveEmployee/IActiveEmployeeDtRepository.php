<?php

namespace App\Repositories\Admin\Employee\Active\Dt\ActiveEmployee;

use Illuminate\Http\JsonResponse;

interface IActiveEmployeeDtRepository {

    public function index($request) : array;
    public function list($request) : JsonResponse;
}
