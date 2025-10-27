<?php

use App\Http\Controllers\Admin\Employee\Draft\Crud\SalarySetup\Form\Update\EmployeeSalarySalarySetupUpdateController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::get('employee/draft/crud/salary-setup/update/{uuid}',[EmployeeSalarySalarySetupUpdateController::class,'index']);
    Route::post('employee/draft/crud/salary-setup/update',[EmployeeSalarySalarySetupUpdateController::class,'update']);
    //vpx_attach
});
