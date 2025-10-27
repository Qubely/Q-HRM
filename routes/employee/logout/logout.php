<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\Logout\EmployeeLogoutController;
//vpx_imports
Route::prefix('employee')->group(function(){
    Route::get('logout', [EmployeeLogoutController::class,'logout'])->name('employee.logout');
    //vpx_attach
});
//vpx_attach
