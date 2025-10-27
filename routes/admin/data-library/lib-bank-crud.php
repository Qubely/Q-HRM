<?php

use App\Http\Controllers\Admin\DataLibrary\Banks\Crud\LibBankCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/banks',LibBankCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/banks/list',[LibBankCrudController::class,'list']);
    Route::post('data-library/banks/delete-list',[LibBankCrudController::class,'deleteList']);
    Route::post('data-library/banks/update-list',[LibBankCrudController::class,'updateList']);
    //vpx_attach
});
