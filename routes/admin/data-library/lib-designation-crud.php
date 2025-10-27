<?php

use App\Http\Controllers\Admin\DataLibrary\Designation\Crud\LibDesignationCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/designation',LibDesignationCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/designation/list',[LibDesignationCrudController::class,'list']);
    Route::post('data-library/designation/delete-list',[LibDesignationCrudController::class,'deleteList']);
    Route::post('data-library/designation/update-list',[LibDesignationCrudController::class,'updateList']);
    //vpx_attach
});
