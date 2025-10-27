<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\Setup\EmployeeSetupController;
use App\Http\Controllers\Employee\Setup\EmployeeProfileUpdateController;

//vpx_imports
Route::prefix('employee')->group(function(){
    
    Route::get('setup/profile', [EmployeeSetupController::class,'index'])->name('employee.profile.setup');
    Route::post('setup/profile', [EmployeeSetupController::class,'update']);

    Route::get('setup/profile-update', [EmployeeProfileUpdateController::class,'index'])->name('employee.user.setup');
    Route::post('setup/profile-update', [EmployeeProfileUpdateController::class,'updateProfile']);
    Route::get('setup/password-update', [EmployeeProfileUpdateController::class,'password'])->name('employee.user.password');
    Route::post('setup/password-update', [EmployeeProfileUpdateController::class,'updatePassword']);
    //vpx_attach
});




