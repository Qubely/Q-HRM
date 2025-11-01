<?php

namespace App\Models;

use App\Traits\BaseTrait;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendanceRecon extends Model
{
    use BaseTrait;
    protected $table = "employee_attendance_recons";
    protected $fillable = [];

    public function att()
    {
        return $this->hasOne(EmployeeAttendance::class,'id','employee_attendance_id');
    }
}
