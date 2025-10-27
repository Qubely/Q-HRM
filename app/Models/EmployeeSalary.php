<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;
//vpx_imports
class EmployeeSalary extends Model
{
    use BaseTrait;
    protected $table = "employee_salaries";
    protected $fillable = [
        'lib_salary_group_id'
    ];
    //vpx_attach

    public function salaryGroup()
    {
        return $this->hasOne(LibSalaryGroup::class,'id','lib_salary_group_id');
    }
}
