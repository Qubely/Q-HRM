<?php

use App\Http\Controllers\Admin\Employee\Draft\Crud\Education\Crud\EmployeeEducationCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('employee/draft/crud/education',EmployeeEducationCrudController::class)->except(['destroy', 'show']);
    Route::get('employee/draft/crud/education/{uuid}',[EmployeeEducationCrudController::class,'index']);
    Route::post('employee/draft/crud/education/list',[EmployeeEducationCrudController::class,'list']);
    Route::post('employee/draft/crud/education/delete-list',[EmployeeEducationCrudController::class,'deleteList']);
    Route::post('employee/draft/crud/education/update-list',[EmployeeEducationCrudController::class,'updateList']);
    //vpx_attach
});
