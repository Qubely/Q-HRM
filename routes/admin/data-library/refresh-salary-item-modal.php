<?php

use App\Http\Controllers\Admin\DataLibrary\Salary\Group\Crud\Modal\RefreshSalaryItem\RefreshSalaryItemModalController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::post('data-library/salary/group/crud/refresh-salary-item/display',[RefreshSalaryItemModalController::class,'display']);
    Route::post('data-library/salary/group/crud/refresh-salary-item/refresh',[RefreshSalaryItemModalController::class,'refresh']);
    Route::post('data-library/salary/group/crud/refresh-salary-item/update-bulk',[RefreshSalaryItemModalController::class,'bulkUpdate']);
    Route::post('data-library/salary/group/crud/refresh-salary-item/delete',[RefreshSalaryItemModalController::class,'delete']);
    //vpx_attach
});
