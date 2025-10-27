<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\Login\EmployeeLoginController;
//vpx_imports
Route::prefix('employee')->group(function(){
    Route::get('login', [EmployeeLoginController::class,'index'])->name('employee.login.index');
    Route::post('login', [EmployeeLoginController::class,'login'])->name('employee.login');
    //vpx_attach
});
//vpx_attach
