<?php

use App\Http\Controllers\Admin\DataLibrary\Inventory\Category\CategoryItem\Crud\LibInventoryCatItemCrudController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::resource('data-library/inventory/category/category-item',LibInventoryCatItemCrudController::class)->except(['destroy', 'show']);
    Route::get('data-library/inventory/category/category-item/{cat_item_id}',[LibInventoryCatItemCrudController::class,'index']);
    Route::post('data-library/inventory/category/category-item/list',[LibInventoryCatItemCrudController::class,'list']);
    Route::post('data-library/inventory/category/category-item/delete-list',[LibInventoryCatItemCrudController::class,'deleteList']);
    Route::post('data-library/inventory/category/category-item/update-list',[LibInventoryCatItemCrudController::class,'updateList']);
    //vpx_attach
});
