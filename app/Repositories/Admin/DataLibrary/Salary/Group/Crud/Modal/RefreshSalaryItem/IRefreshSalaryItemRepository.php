<?php

namespace App\Repositories\Admin\DataLibrary\Salary\Group\Crud\Modal\RefreshSalaryItem;

use Illuminate\Http\JsonResponse;

interface IRefreshSalaryItemRepository {

    public function display($request) : array;
    public function refresh($request) : JsonResponse;
    public function bulkUpdate($request) : JsonResponse;
    public function delete($request) : JsonResponse;
}
