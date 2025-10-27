<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
//crudDone
class EmployeeLeave extends Model
{
    use BaseTrait;
    protected $table = "employee_leaves";
    protected $fillable = [
        'serial',
        'employee_id',
        'lib_leave_id',
        'count'
    ];
    //vpx_attach
    public function leave()
    {
        return $this->hasOne(LibLeave::class,'id','lib_leave_id');
    }
}
