<?php

use App\Http\Controllers\Admin\Employee\Draft\Crud\UpdateBasic\Form\Update\EmployeeUpdateController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::get('employee/draft/crud/update-basic/update/{uuid}',[EmployeeUpdateController::class,'index']);
    Route::post('employee/draft/crud/update-basic/update',[EmployeeUpdateController::class,'update']);
    //vpx_attach
});
