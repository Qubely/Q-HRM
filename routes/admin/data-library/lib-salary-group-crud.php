<?php

use App\Http\Controllers\Admin\DataLibrary\Salary\Group\Crud\LibSalaryGroupCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/salary/group',LibSalaryGroupCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/salary/group/list',[LibSalaryGroupCrudController::class,'list']);
    Route::post('data-library/salary/group/delete-list',[LibSalaryGroupCrudController::class,'deleteList']);
    Route::post('data-library/salary/group/update-list',[LibSalaryGroupCrudController::class,'updateList']);
    //vpx_attach
});
