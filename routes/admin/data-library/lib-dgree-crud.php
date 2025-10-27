<?php

use App\Http\Controllers\Admin\DataLibrary\Dgree\Crud\LibDgreeCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/dgree',LibDgreeCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/dgree/list',[LibDgreeCrudController::class,'list']);
    Route::post('data-library/dgree/delete-list',[LibDgreeCrudController::class,'deleteList']);
    Route::post('data-library/dgree/update-list',[LibDgreeCrudController::class,'updateList']);
    //vpx_attach
});
