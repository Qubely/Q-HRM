<?php

use App\Http\Controllers\Admin\Employee\Draft\Crud\Modal\ViewDraftEmployee\ViewDraftEmployeeModalController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::post('employee/draft/crud/view-draft-employee/display',[ViewDraftEmployeeModalController::class,'display']);
    Route::post('employee/draft/crud/view-draft-employee/entry',[ViewDraftEmployeeModalController::class,'entry']);
    //vpx_attach
});
