<?php

use App\Http\Controllers\Employee\Reset\EmployeeResetController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('employee')->group(function(){
    Route::get('reset',[EmployeeResetController::class,'index'])->name('employee.reset');
    Route::post('reset/send-code',[EmployeeResetController::class,'sendCode']);
    Route::post('reset/verify-code',[EmployeeResetController::class,'verifyCode']);
    Route::post('reset/change-pass',[EmployeeResetController::class,'changePass']);
    //vpx_attach
});


