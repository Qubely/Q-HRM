<?php

use App\Http\Controllers\Admin\DataLibrary\Department\Crud\LibDepartmentCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/department',LibDepartmentCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/department/list',[LibDepartmentCrudController::class,'list']);
    Route::post('data-library/department/delete-list',[LibDepartmentCrudController::class,'deleteList']);
    Route::post('data-library/department/update-list',[LibDepartmentCrudController::class,'updateList']);
    //vpx_attach
});
