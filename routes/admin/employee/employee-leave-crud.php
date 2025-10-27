<?php

use App\Http\Controllers\Admin\Employee\Draft\Crud\Leave\Crud\EmployeeLeaveCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('employee/draft/crud/leave',EmployeeLeaveCrudController::class)->except(['destroy', 'show']);
    Route::get('employee/draft/crud/leave/{uuid}',[EmployeeLeaveCrudController::class,'index']);
    Route::post('employee/draft/crud/leave/list',[EmployeeLeaveCrudController::class,'list']);
    Route::post('employee/draft/crud/leave/delete-list',[EmployeeLeaveCrudController::class,'deleteList']);
    Route::post('employee/draft/crud/leave/update-list',[EmployeeLeaveCrudController::class,'updateList']);
    //vpx_attach
});
