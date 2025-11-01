<?php

use App\Http\Controllers\Admin\Attendance\Reconciliation\Dt\EmployeeRecon\EmployeeReconDtController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::get('attendance/reconciliation/employee-recon/list',[EmployeeReconDtController::class,'index']);
    Route::post('attendance/reconciliation/employee-recon/list',[EmployeeReconDtController::class,'list']);
    Route::post('attendance/reconciliation/employee-recon/list/ban',[EmployeeReconDtController::class,'ban']);
    Route::post('attendance/reconciliation/employee-recon/list/aprove',[EmployeeReconDtController::class,'aprove']);

    //vpx_attach
});
