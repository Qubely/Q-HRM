<?php

use App\Http\Controllers\Employee\Attendance\Reports\Mothly\Details\Modal\AddReconciliation\AddReconciliationModalController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('employee')->group(function(){
    Route::post('attendance/reports/monthly/details/add-reconciliation/display',[AddReconciliationModalController::class,'display']);
    Route::post('attendance/reports/monthly/details/add-reconciliation/send',[AddReconciliationModalController::class,'send']);
    //vpx_attach
});
