<?php

namespace App\Repositories\Admin\Employee\Draft\Crud\Modal\ViewDraftEmployee;

use Illuminate\Http\JsonResponse;

interface IViewDraftEmployeeRepository {

    public function display($request) : array;
    public function entry($request) : JsonResponse;

}
