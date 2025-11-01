<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    protected $fillable = [
        'employee_id',
        'att_date',
        'in_time',
        'device_id',
        'out_time',
        'status',
        'att_remarks',
        'in_image',
        'out_image',
        'longitude_in',
        'latitude_in',
        'longitude_out',
        'latitude_out',
        'sent_sms',
    ];

    public function reqRequest()
    {
        return $this->hasOne(EmployeeAttendanceRecon::class,'employee_attendance_id','id');
    }
}
