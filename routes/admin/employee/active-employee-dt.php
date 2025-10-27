<?php

use App\Http\Controllers\Admin\Employee\Active\Dt\ActiveEmployee\ActiveEmployeeDtController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::get('employee/active/active-employee/list',[ActiveEmployeeDtController::class,'index']);
    Route::post('employee/active/active-employee/list',[ActiveEmployeeDtController::class,'list']);
    //vpx_attach
});
