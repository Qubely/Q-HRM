<?php

use App\Http\Controllers\Admin\Employee\Draft\Crud\BankDetails\Form\Update\EmployeeBankDetailsUpdateController;
use Illuminate\Support\Facades\Route;
//vpx_imports
Route::prefix('admin')->group(function(){
    Route::get('employee/draft/crud/bank-details/update/{uuid}',[EmployeeBankDetailsUpdateController::class,'index']);
    Route::post('employee/draft/crud/bank-details/update',[EmployeeBankDetailsUpdateController::class,'update']);
    //vpx_attach
});
