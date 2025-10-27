<?php

use App\Http\Controllers\Admin\DataLibrary\Leave\Crud\LibLeaveCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/leave',LibLeaveCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/leave/list',[LibLeaveCrudController::class,'list']);
    Route::post('data-library/leave/delete-list',[LibLeaveCrudController::class,'deleteList']);
    Route::post('data-library/leave/update-list',[LibLeaveCrudController::class,'updateList']);
    //vpx_attach
});
