<?php

use App\Http\Controllers\Admin\Employee\Draft\Crud\EmployeeCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('employee/draft',EmployeeCrudController::class)->except(['destroy', 'show']);
    Route::post('employee/draft/list',[EmployeeCrudController::class,'list']);
    Route::post('employee/draft/delete-list',[EmployeeCrudController::class,'deleteList']);
    Route::post('employee/draft/update-list',[EmployeeCrudController::class,'updateList']);
    //vpx_attach
});
