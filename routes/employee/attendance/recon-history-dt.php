<?php

use App\Http\Controllers\Employee\Attendance\Reconciliation\Dt\ReconHistory\ReconHistoryDtController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('employee')->group(function(){
    Route::get('attendance/reconciliation/recon-history/list',[ReconHistoryDtController::class,'index']);
    Route::post('attendance/reconciliation/recon-history/list',[ReconHistoryDtController::class,'list']);
    //vpx_attach
});
