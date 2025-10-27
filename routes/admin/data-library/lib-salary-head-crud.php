<?php

use App\Http\Controllers\Admin\DataLibrary\Salary\Heads\Crud\LibSalaryHeadCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/salary/heads',LibSalaryHeadCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/salary/heads/list',[LibSalaryHeadCrudController::class,'list']);
    Route::post('data-library/salary/heads/delete-list',[LibSalaryHeadCrudController::class,'deleteList']);
    Route::post('data-library/salary/heads/update-list',[LibSalaryHeadCrudController::class,'updateList']);
    //vpx_attach
});
