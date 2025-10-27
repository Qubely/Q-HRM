<?php

use App\Http\Controllers\Admin\DataLibrary\Board\Crud\LibBoardCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/board',LibBoardCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/board/list',[LibBoardCrudController::class,'list']);
    Route::post('data-library/board/delete-list',[LibBoardCrudController::class,'deleteList']);
    Route::post('data-library/board/update-list',[LibBoardCrudController::class,'updateList']);
    //vpx_attach
});
