<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\Dashboard\EmployeeDashboardController;
//vpx_imports
Route::prefix('employee')->group(function(){
    Route::get('dashboard', [EmployeeDashboardController::class,'index'])->name('employee.dashboard.index');
    //vpx_attach
});
//vpx_attach
