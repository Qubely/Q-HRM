<?php

namespace App\Repositories\Admin\Employee\Draft\Crud\UpdateBasic\Form\Update;

use Illuminate\Http\JsonResponse;

interface IEmployeeUpdateRepository {

    public function index($request) : array;
    public function update($request) : JsonResponse;
}
