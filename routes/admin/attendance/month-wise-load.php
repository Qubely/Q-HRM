<?php

use App\Http\Controllers\Admin\Attendance\Report\Employee\Load\MonthWise\MonthWiseLoadController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::get('attendance/report/employee/month-wise',[MonthWiseLoadController::class,'index']);
    Route::post('attendance/report/employee/month-wise/display',[MonthWiseLoadController::class,'display']);
    //vpx_attach
});
