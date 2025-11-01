<?php

use App\Http\Controllers\Admin\DataLibrary\Inventory\Category\Crud\LibInventoryCatCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/inventory/category',LibInventoryCatCrudController::class)->except(['destroy', 'show']);
    Route::post('data-library/inventory/category/list',[LibInventoryCatCrudController::class,'list']);
    Route::post('data-library/inventory/category/delete-list',[LibInventoryCatCrudController::class,'deleteList']);
    Route::post('data-library/inventory/category/update-list',[LibInventoryCatCrudController::class,'updateList']);
    //vpx_attach
});
