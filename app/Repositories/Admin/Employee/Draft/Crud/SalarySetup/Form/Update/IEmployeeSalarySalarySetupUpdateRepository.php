<?php

namespace App\Repositories\Admin\Employee\Draft\Crud\SalarySetup\Form\Update;

use Illuminate\Http\JsonResponse;

interface IEmployeeSalarySalarySetupUpdateRepository {

    public function index($request) : array;
    public function update($request) : JsonResponse;
}
