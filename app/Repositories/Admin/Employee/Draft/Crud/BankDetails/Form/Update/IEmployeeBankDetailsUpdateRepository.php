<?php

namespace App\Repositories\Admin\Employee\Draft\Crud\BankDetails\Form\Update;

use Illuminate\Http\JsonResponse;

interface IEmployeeBankDetailsUpdateRepository {

    public function index($request) : array;
    public function update($request) : JsonResponse;
}
