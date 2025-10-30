<?php

use App\Http\Controllers\Employee\Attendance\Reports\Mothly\Details\AttendanceDetailsController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('employee')->group(function(){
    Route::get('attendance/report/monthly/details',[AttendanceDetailsController::class,'index']);
    //vpx_attach
});
